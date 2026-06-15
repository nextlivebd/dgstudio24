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
        /* ===== BASE STYLES ===== */
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f4f7f6; 
            color: #2c3e50; 
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar { 
            min-height: 100vh; 
            background: linear-gradient(180deg, #111827 0%, #1f2937 100%); 
            color: #fff; 
            padding-top: 0; 
            width: 260px; 
            position: fixed; 
            top: 0;
            left: 0;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            z-index: 1050;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Sidebar scrollbar styling */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }
        .sidebar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.3); }

        .sidebar-brand {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 64px;
        }
        .sidebar-brand-logo {
            flex: 1;
            text-align: center;
        }

        /* Sidebar collapse toggle (Desktop) */
        .sidebar-collapse-btn {
            background: rgba(255,255,255,0.08);
            border: none;
            color: #9ca3af;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .sidebar-collapse-btn:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        /* Close button (Mobile) */
        .sidebar-close-btn {
            background: rgba(255,255,255,0.08);
            border: none;
            color: #9ca3af;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .sidebar-close-btn:hover {
            background: rgba(239,68,68,0.3);
            color: #ef4444;
        }

        .sidebar-nav { padding: 0 0 20px 0; }

        .sidebar-nav a { 
            color: #9ca3af; 
            text-decoration: none; 
            padding: 12px 20px; 
            display: flex; 
            align-items: center;
            border-left: 4px solid transparent; 
            transition: all 0.25s ease; 
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            position: relative;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active { 
            color: #ffffff; 
            background-color: rgba(255,255,255,0.05); 
            border-left-color: #3b82f6; 
        }
        .sidebar-nav a i { 
            width: 24px; 
            font-size: 16px; 
            text-align: center; 
            margin-right: 12px; 
            color: #6b7280; 
            transition: color 0.25s ease;
            flex-shrink: 0;
        }
        .sidebar-nav a:hover i, .sidebar-nav a.active i { color: #3b82f6; }

        .sidebar-nav a .nav-text {
            transition: opacity 0.2s ease;
            overflow: hidden;
        }

        .sidebar-nav a .nav-badge {
            margin-left: auto;
            transition: opacity 0.2s ease;
        }

        /* Sidebar tooltip for collapsed state */
        .sidebar-nav a .nav-tooltip {
            display: none;
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: #1f2937;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 1060;
            pointer-events: none;
        }
        .sidebar-nav a .nav-tooltip::before {
            content: '';
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: #1f2937;
        }

        /* ===== SIDEBAR OVERLAY (Mobile) ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content { 
            margin-left: 260px; 
            padding: 20px 30px; 
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        /* ===== TOP NAVBAR ===== */
        .navbar-top { 
            background-color: #ffffff; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); 
            padding: 12px 20px; 
            border-radius: 12px; 
            margin-bottom: 25px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            gap: 10px;
        }
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        /* Hamburger button */
        .hamburger-btn {
            display: none;
            background: none;
            border: 1px solid #e5e7eb;
            color: #374151;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .hamburger-btn:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }
        .hamburger-btn i { font-size: 18px; }

        /* ===== DESKTOP: COLLAPSED SIDEBAR ===== */
        @media (min-width: 992px) {
            .sidebar-close-btn { display: none !important; }

            .sidebar.collapsed {
                width: 70px;
            }
            .sidebar.collapsed .sidebar-brand-logo {
                display: none;
            }
            .sidebar.collapsed .sidebar-collapse-btn i::before {
                content: "\f101";
            }
            .sidebar.collapsed .sidebar-nav a {
                justify-content: center;
                padding: 14px 0;
                border-left-width: 3px;
            }
            .sidebar.collapsed .sidebar-nav a i {
                margin-right: 0;
                font-size: 18px;
            }
            .sidebar.collapsed .sidebar-nav a .nav-text,
            .sidebar.collapsed .sidebar-nav a .nav-badge {
                display: none;
            }
            .sidebar.collapsed .sidebar-nav a:hover .nav-tooltip {
                display: block;
            }
            .main-content.expanded {
                margin-left: 70px;
            }
        }

        /* ===== TABLET & MOBILE (< 992px) ===== */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                padding-top: 0;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .sidebar-close-btn {
                display: flex;
            }
            .sidebar-collapse-btn {
                display: none;
            }
            .main-content {
                margin-left: 0 !important;
                padding: 15px;
            }
            .hamburger-btn {
                display: flex;
            }
            body.sidebar-open {
                overflow: hidden;
            }
        }

        /* ===== MOBILE SPECIFIC (< 576px) ===== */
        @media (max-width: 575.98px) {
            .sidebar { width: 260px; }
            .main-content { padding: 10px; }
            .navbar-top { 
                padding: 10px 15px; 
                border-radius: 10px;
                margin-bottom: 15px;
            }
            .navbar-top h5 { font-size: 14px; }
            .navbar-welcome { display: none; }
        }

        /* ===== GLOBAL RESPONSIVE HELPERS ===== */

        /* Page headers - wrap on small screens */
        @media (max-width: 767.98px) {
            .page-header-flex {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 10px;
            }
            .page-header-flex .btn {
                width: 100%;
                text-align: center;
            }
            /* Reduce card padding */
            .card-body { padding: 0.85rem; }
            .card-header { padding: 0.75rem 0.85rem; }
            
            /* Table action buttons stacked */
            .table-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
            }
            .table-actions .btn { 
                padding: 4px 8px; 
                font-size: 12px;
            }
            .table-actions .btn .btn-label { display: none; }

            /* Dynamic row responsive */
            .dynamic-row .row > [class*="col-md-4"],
            .dynamic-row .row > [class*="col-md-8"] {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 10px;
            }
            .dynamic-row .remove-btn {
                position: relative;
                top: auto;
                right: auto;
                margin-bottom: 10px;
                display: block;
                width: fit-content;
                margin-left: auto;
            }

            /* Container fluid smaller padding */
            .container-fluid { padding-left: 10px; padding-right: 10px; }

            /* Settings page icon preview */
            .icon-preview-box {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }
        }

        /* Table responsive improvements */
        @media (max-width: 991.98px) {
            .table th, .table td {
                font-size: 13px;
                padding: 0.5rem 0.4rem;
            }
            .table img { 
                max-width: 60px; 
                height: auto !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <div class="sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <button class="sidebar-close-btn" onclick="closeSidebar()" title="Close Menu">
                <i class="fas fa-times"></i>
            </button>
            <div class="sidebar-brand-logo">
                @if(get_setting('logo'))
                    <img src="{{ asset(get_setting('logo')) }}" alt="Logo" style="max-height: 40px; max-width: 100%; object-fit: contain;">
                @else
                    <h5 class="text-white mb-0 fw-bold" style="font-size: 15px;">{{ get_setting('site_title', 'Admin Panel') }}</h5>
                @endif
            </div>
            <button class="sidebar-collapse-btn" onclick="toggleSidebarCollapse()" title="Toggle Sidebar">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        
        <div class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span class="nav-text">Dashboard</span>
                <span class="nav-tooltip">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="fas fa-blog"></i>
                <span class="nav-text">Blogs</span>
                <span class="nav-tooltip">Blogs</span>
            </a>

            <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span class="nav-text">Sliders</span>
                <span class="nav-tooltip">Sliders</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                <span class="nav-text">Blog Categories</span>
                <span class="nav-tooltip">Blog Categories</span>
            </a>

            <a href="{{ route('admin.service-categories.index') }}" class="{{ request()->routeIs('admin.service-categories.*') ? 'active' : '' }}">
                <i class="fas fa-sitemap"></i>
                <span class="nav-text">Service Categories</span>
                <span class="nav-tooltip">Service Categories</span>
            </a>

            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fas fa-concierge-bell"></i>
                <span class="nav-text">Services</span>
                <span class="nav-tooltip">Services</span>
            </a>

            <a href="{{ route('admin.portfolios.index') }}" class="{{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                <span class="nav-text">Portfolios</span>
                <span class="nav-tooltip">Portfolios</span>
            </a>

            <a href="{{ route('admin.portfolio-categories.index') }}" class="{{ request()->routeIs('admin.portfolio-categories.*') ? 'active' : '' }}">
                <i class="fas fa-project-diagram"></i>
                <span class="nav-text">Portfolio Categories</span>
                <span class="nav-tooltip">Portfolio Categories</span>
            </a>

            <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span class="nav-text">Pages</span>
                <span class="nav-tooltip">Pages</span>
            </a>
            
            <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i>
                <span class="nav-text">Inquiries</span>
                @if(isset($unreadContactsCount) && $unreadContactsCount > 0)
                    <span class="nav-badge badge bg-danger rounded-pill">{{ $unreadContactsCount }}</span>
                @endif
                <span class="nav-tooltip">Inquiries</span>
            </a>

            <a href="{{ route('admin.contact-informations.index') }}" class="{{ request()->routeIs('admin.contact-informations.*') ? 'active' : '' }}">
                <i class="fas fa-map-marked-alt"></i>
                <span class="nav-text">Office Info</span>
                <span class="nav-tooltip">Office Info</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span class="nav-text">Users</span>
                <span class="nav-tooltip">Users</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fas fa-cogs"></i>
                <span class="nav-text">Site Settings</span>
                <span class="nav-tooltip">Site Settings</span>
            </a>
        </div>
    </div>

    <div class="main-content" id="mainContent">
        <div class="navbar-top">
            <div class="navbar-left">
                <button class="hamburger-btn" onclick="toggleSidebar()" title="Toggle Menu" id="hamburgerBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 text-dark" style="font-size: 16px;">{{ get_setting('site_title', 'Admin Panel') }}</h5>
            </div>
            <div class="navbar-right">
                <span class="text-muted navbar-welcome" style="font-size: 14px;">Welcome, {{ auth()->user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="d-none d-sm-inline ms-1">Logout</span>
                    </button>
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
    
    <!-- Sidebar Logic -->
    <script>
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');
        const body = document.body;

        // ===== MOBILE DRAWER =====
        function toggleSidebar() {
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
                body.classList.toggle('sidebar-open');
            }
        }

        function closeSidebar() {
            if (window.innerWidth < 992) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                body.classList.remove('sidebar-open');
            }
        }

        // Auto-close sidebar on nav link click (mobile)
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    closeSidebar();
                }
            });
        });

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });

        // ===== DESKTOP COLLAPSE =====
        function toggleSidebarCollapse() {
            if (window.innerWidth >= 992) {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                // Save state
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            }
        }

        // Restore collapse state on page load (desktop only)
        function restoreSidebarState() {
            if (window.innerWidth >= 992) {
                const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (isCollapsed) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            }
        }

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth >= 992) {
                    // Switching to desktop: close mobile drawer, restore collapse
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    body.classList.remove('sidebar-open');
                    restoreSidebarState();
                } else {
                    // Switching to mobile: remove collapse classes
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            }, 150);
        });

        // Initialize
        restoreSidebarState();

        // ===== SWIPE GESTURE (Mobile) =====
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        document.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeDistance = touchEndX - touchStartX;
            // Swipe right from left edge to open
            if (swipeDistance > 80 && touchStartX < 40) {
                sidebar.classList.add('show');
                overlay.classList.add('show');
                body.classList.add('sidebar-open');
            }
            // Swipe left to close
            if (swipeDistance < -80 && sidebar.classList.contains('show')) {
                closeSidebar();
            }
        }
    </script>

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
