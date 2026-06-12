<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ get_setting('site_title', 'Admin Panel') }}</title>
    @if(get_setting('favicon'))
        <link rel="icon" type="image/png" href="{{ asset(get_setting('favicon')) }}">
    @endif
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; color: #2c3e50; }
        .sidebar { 
            min-height: 100vh; 
            background: linear-gradient(180deg, #111827 0%, #1f2937 100%); 
            color: #fff; 
            padding-top: 15px; 
            width: 260px; 
            position: fixed; 
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .sidebar-brand {
            padding: 15px 20px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 15px;
            text-align: center;
        }
        .sidebar a { 
            color: #9ca3af; 
            text-decoration: none; 
            padding: 12px 20px; 
            display: flex; 
            align-items: center;
            border-left: 4px solid transparent; 
            transition: all 0.3s ease; 
            font-size: 15px;
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active { 
            color: #ffffff; 
            background-color: rgba(255,255,255,0.05); 
            border-left-color: #3b82f6; 
        }
        .sidebar a i { width: 30px; font-size: 18px; text-align: center; margin-right: 10px; color: #6b7280; transition: color 0.3s ease; }
        .sidebar a:hover i, .sidebar a.active i { color: #3b82f6; }
        .main-content { margin-left: 260px; padding: 30px; }
        .navbar-top { 
            background-color: #ffffff; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); 
            padding: 15px 30px; 
            border-radius: 12px; 
            margin-bottom: 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            @if(get_setting('logo'))
                <img src="{{ asset(get_setting('logo')) }}" alt="Logo" style="max-height: 45px; max-width: 100%; object-fit: contain;">
            @else
                <h5 class="text-white mb-0 fw-bold">{{ get_setting('site_title', 'Admin Panel') }}</h5>
            @endif
        </div>
        
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        
        <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <i class="fas fa-blog"></i> Blogs
        </a>

        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Categories
        </a>

        <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> Pages
        </a>
        
        <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <i class="fas fa-envelope"></i> Inquiries
        </a>

        <a href="{{ route('admin.contact-informations.index') }}" class="{{ request()->routeIs('admin.contact-informations.*') ? 'active' : '' }}">
            <i class="fas fa-map-marked-alt"></i> Office Info
        </a>

        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Users
        </a>

        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="fas fa-cogs"></i> Site Settings
        </a>
    </div>

    <div class="main-content">
        <div class="navbar-top">
            <h5 class="mb-0 text-dark">Global Graphic Giant</h5>
            <div>
                <span class="me-3 text-muted">Welcome, {{ auth()->user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>

        @yield('content')
    </div>

    <!-- Icon Picker Modal -->
    <div class="modal fade" id="iconPickerModal" tabindex="-1" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iconPickerModalLabel">Select an Icon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="iconSearch" class="form-control mb-3" placeholder="Search icons (e.g. facebook, phone)...">
                    <div class="row text-center" id="iconGrid">
                        <!-- Icons populated by JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .icon-option { cursor: pointer; padding: 15px 10px; border-radius: 5px; transition: background 0.2s; color: #495057; }
        .icon-option:hover { background: #e9ecef; color: #0d6efd; }
        .icon-option i { font-size: 24px; }
        .icon-preview-box { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #e9ecef; border-radius: 5px; font-size: 18px; color: #495057; }
    </style>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (required for Summernote and Select2 if used) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Icon Picker Logic -->
    <script>
        const faIcons = [
            'fas fa-phone', 'fas fa-phone-alt', 'fas fa-envelope', 'fas fa-envelope-open', 
            'fas fa-map-marker-alt', 'fas fa-map-pin', 'fas fa-globe', 'fas fa-mobile-alt', 
            'fas fa-fax', 'fas fa-building', 'fas fa-clock', 'fas fa-headset',
            'fab fa-facebook-f', 'fab fa-twitter', 'fab fa-instagram', 'fab fa-linkedin-in',
            'fab fa-youtube', 'fab fa-whatsapp', 'fab fa-telegram-plane', 'fab fa-tiktok',
            'fab fa-pinterest-p', 'fab fa-skype', 'fas fa-link', 'fas fa-info-circle'
        ];

        let currentIconTarget = null;
        let currentIconPreview = null;

        function openIconPicker(targetEl, previewEl) {
            currentIconTarget = targetEl;
            currentIconPreview = previewEl;
            renderIcons(faIcons);
            var myModal = new bootstrap.Modal(document.getElementById('iconPickerModal'));
            myModal.show();
        }

        function renderIcons(icons) {
            let html = '';
            icons.forEach(icon => {
                html += `<div class="col-3 col-md-2 icon-option" onclick="selectIcon('${icon}')" title="${icon}">
                            <i class="${icon}"></i>
                         </div>`;
            });
            document.getElementById('iconGrid').innerHTML = html;
        }

        function selectIcon(iconClass) {
            if(currentIconTarget && currentIconPreview) {
                currentIconTarget.value = iconClass;
                currentIconPreview.className = iconClass;
            }
            bootstrap.Modal.getInstance(document.getElementById('iconPickerModal')).hide();
        }

        document.getElementById('iconSearch').addEventListener('input', function(e) {
            let term = e.target.value.toLowerCase();
            let filtered = faIcons.filter(icon => icon.toLowerCase().includes(term));
            renderIcons(filtered);
        });
    </script>

    @stack('scripts')
</body>
</html>
