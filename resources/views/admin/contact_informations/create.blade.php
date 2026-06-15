@extends('admin.layouts.app')

@push('styles')
<style>
    .dynamic-row { border: 1px dashed #dee2e6; padding: 15px; border-radius: 5px; margin-bottom: 15px; position: relative; background: #f8f9fa; }
    .remove-btn { position: absolute; top: 15px; right: 15px; }
    .icon-preview-box {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        background-color: #fff;
        border-radius: 6px;
    }
    
    @media (max-width: 767.98px) {
        .dynamic-row {
            padding: 10px;
        }
        .dynamic-row .row > [class*="col-md-"] {
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
        .icon-preview-box {
            width: 35px;
            height: 35px;
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add New Office</h2>
        <a href="{{ route('admin.contact-informations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.contact-informations.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <!-- Basic Info -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Office Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Office Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="office_name" required placeholder="e.g. Headquarters, NY Branch">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Google Map Embed Code (iframe)</label>
                            <textarea class="form-control" name="map_embed" rows="3" placeholder='<iframe src="..."></iframe>'></textarea>
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">Active Status</label>
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" id="is_corporate" name="is_corporate">
                            <label class="form-check-label" for="is_corporate">Main Office / Corporate Office</label>
                        </div>
                    </div>
                </div>

                <!-- Addresses -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Addresses</h6>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addDynamicRow('address-container', 'address')">
                            <i class="fas fa-plus"></i> Add Address
                        </button>
                    </div>
                    <div class="card-body" id="address-container">
                        <div class="dynamic-row">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Icon</label>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-preview-box me-2 border">
                                            <i id="address_preview_init" class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <input type="hidden" id="address_input_init" name="address_icon[]" value="fas fa-map-marker-alt">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('address_input_init'), document.getElementById('address_preview_init'))">Change</button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Address Text</label>
                                    <input type="text" class="form-control" name="address_text[]" placeholder="Enter address details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phones -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Phone Numbers</h6>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addDynamicRow('phone-container', 'phone')">
                            <i class="fas fa-plus"></i> Add Phone
                        </button>
                    </div>
                    <div class="card-body" id="phone-container">
                        <div class="dynamic-row">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Icon</label>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-preview-box me-2 border">
                                            <i id="phone_preview_init" class="fas fa-phone-alt"></i>
                                        </div>
                                        <input type="hidden" id="phone_input_init" name="phone_icon[]" value="fas fa-phone-alt">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('phone_input_init'), document.getElementById('phone_preview_init'))">Change</button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_text[]" placeholder="Enter phone number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emails -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Email Addresses</h6>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addDynamicRow('email-container', 'email')">
                            <i class="fas fa-plus"></i> Add Email
                        </button>
                    </div>
                    <div class="card-body" id="email-container">
                        <div class="dynamic-row">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Icon</label>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-preview-box me-2 border">
                                            <i id="email_preview_init" class="fas fa-envelope"></i>
                                        </div>
                                        <input type="hidden" id="email_input_init" name="email_icon[]" value="fas fa-envelope">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('email_input_init'), document.getElementById('email_preview_init'))">Change</button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email_text[]" placeholder="Enter email address">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="col-md-4">
                <div class="card shadow mb-4 position-sticky" style="top: 20px;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">You can add unlimited addresses, phones, and emails to this office. Use FontAwesome classes for icons (e.g. <code>fas fa-phone</code>).</p>
                        <button type="submit" class="btn btn-primary w-100 btn-lg shadow-sm">Save Office Info</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function addDynamicRow(containerId, type) {
        let defaultIcon = '';
        let placeholderText = '';
        
        if (type === 'address') { defaultIcon = 'fas fa-map-marker-alt'; placeholderText = 'Enter address details'; }
        if (type === 'phone') { defaultIcon = 'fas fa-phone-alt'; placeholderText = 'Enter phone number'; }
        if (type === 'email') { defaultIcon = 'fas fa-envelope'; placeholderText = 'Enter email address'; }

        const uniqueId = Date.now() + Math.floor(Math.random() * 1000);

        const row = `
            <div class="dynamic-row">
                <button type="button" class="btn btn-sm btn-outline-danger remove-btn" onclick="this.closest('.dynamic-row').remove()">
                    <i class="fas fa-times"></i>
                </button>
                <div class="row pr-5">
                    <div class="col-md-4">
                        <label class="form-label">Icon</label>
                        <div class="d-flex align-items-center">
                            <div class="icon-preview-box me-2 border">
                                <i id="${type}_preview_${uniqueId}" class="${defaultIcon}"></i>
                            </div>
                            <input type="hidden" id="${type}_input_${uniqueId}" name="${type}_icon[]" value="${defaultIcon}">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('${type}_input_${uniqueId}'), document.getElementById('${type}_preview_${uniqueId}'))">Change</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Details</label>
                        <input type="${type==='email' ? 'email' : 'text'}" class="form-control" name="${type}_text[]" placeholder="${placeholderText}">
                    </div>
                </div>
            </div>
        `;
        document.getElementById(containerId).insertAdjacentHTML('beforeend', row);
    }
</script>
@endpush
