@extends('admin.layouts.app')

@push('styles')
<style>
    .dynamic-row { border: 1px dashed #dee2e6; padding: 15px; border-radius: 5px; margin-bottom: 15px; position: relative; background: #f8f9fa; }
    .remove-btn { position: absolute; top: 15px; right: 15px; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Site Settings</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <!-- Left Column: General & Media -->
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">General Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Site Title</label>
                                    <input type="text" name="site_title" class="form-control" value="{{ get_setting('site_title', 'Global Graphic Giant') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (SEO)</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ get_setting('meta_title', 'Global Graphic Giant – A Complete IT Solution') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (SEO)</label>
                                    <textarea name="meta_description" class="form-control" rows="3">{{ get_setting('meta_description', 'Global Graphic Giant – A Complete IT Solution') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Media & Branding</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label d-block">Site Logo</label>
                                    @if(get_setting('logo'))
                                        <img src="{{ asset(get_setting('logo')) }}" alt="Logo" class="img-thumbnail mb-2" style="max-height: 80px;">
                                    @endif
                                    <input type="file" name="logo" class="form-control" accept="image/*">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label d-block">Favicon</label>
                                    @if(get_setting('favicon'))
                                        <img src="{{ asset(get_setting('favicon')) }}" alt="Favicon" class="img-thumbnail mb-2" style="max-height: 40px;">
                                    @endif
                                    <input type="file" name="favicon" class="form-control" accept="image/*">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label d-block">Meta OG Image (For Social Sharing)</label>
                                    @if(get_setting('og_image'))
                                        <img src="{{ asset(get_setting('og_image')) }}" alt="OG Image" class="img-thumbnail mb-2" style="max-height: 100px;">
                                    @endif
                                    <input type="file" name="og_image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Main Contacts & Social Links -->
                    <div class="col-md-6">
                        <!-- Main Phones -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Main Phone Numbers</h6>
                                <button type="button" class="btn btn-sm btn-primary" onclick="addDynamicRow('phone-container', 'phone')">
                                    <i class="fas fa-plus"></i> Add Phone
                                </button>
                            </div>
                            <div class="card-body" id="phone-container">
                                @php
                                    $phones = json_decode(get_setting('main_phones', '[]'), true);
                                @endphp
                                @if(is_array($phones) && count($phones) > 0)
                                    @foreach($phones as $index => $phone)
                                    <div class="dynamic-row">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-btn" onclick="this.closest('.dynamic-row').remove()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <div class="row pr-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Icon</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-preview-box me-2 border">
                                                        <i id="phone_preview_{{ $index }}" class="{{ $phone['icon'] }}"></i>
                                                    </div>
                                                    <input type="hidden" id="phone_input_{{ $index }}" name="phone_icon[]" value="{{ $phone['icon'] }}">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('phone_input_{{ $index }}'), document.getElementById('phone_preview_{{ $index }}'))">Change</button>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_text[]" value="{{ $phone['text'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
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
                                @endif
                            </div>
                        </div>

                        <!-- Main Emails -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Main Email Addresses</h6>
                                <button type="button" class="btn btn-sm btn-primary" onclick="addDynamicRow('email-container', 'email')">
                                    <i class="fas fa-plus"></i> Add Email
                                </button>
                            </div>
                            <div class="card-body" id="email-container">
                                @php
                                    $emails = json_decode(get_setting('main_emails', '[]'), true);
                                @endphp
                                @if(is_array($emails) && count($emails) > 0)
                                    @foreach($emails as $index => $email)
                                    <div class="dynamic-row">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-btn" onclick="this.closest('.dynamic-row').remove()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <div class="row pr-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Icon</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-preview-box me-2 border">
                                                        <i id="email_preview_{{ $index }}" class="{{ $email['icon'] }}"></i>
                                                    </div>
                                                    <input type="hidden" id="email_input_{{ $index }}" name="email_icon[]" value="{{ $email['icon'] }}">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('email_input_{{ $index }}'), document.getElementById('email_preview_{{ $index }}'))">Change</button>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email_text[]" value="{{ $email['text'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
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
                                @endif
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Social Media Links</h6>
                                <button type="button" class="btn btn-sm btn-primary" onclick="addDynamicRow('social-container', 'social')">
                                    <i class="fas fa-plus"></i> Add Link
                                </button>
                            </div>
                            <div class="card-body" id="social-container">
                                @php
                                    $socials = json_decode(get_setting('social_links', '[]'), true);
                                @endphp
                                @if(is_array($socials) && count($socials) > 0)
                                    @foreach($socials as $index => $social)
                                    <div class="dynamic-row">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-btn" onclick="this.closest('.dynamic-row').remove()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <div class="row pr-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Icon</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-preview-box me-2 border">
                                                        <i id="social_preview_{{ $index }}" class="{{ $social['icon'] }}"></i>
                                                    </div>
                                                    <input type="hidden" id="social_input_{{ $index }}" name="social_icon[]" value="{{ $social['icon'] }}">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('social_input_{{ $index }}'), document.getElementById('social_preview_{{ $index }}'))">Change</button>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">URL</label>
                                                <input type="url" class="form-control" name="social_text[]" value="{{ $social['text'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="dynamic-row">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Icon</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-preview-box me-2 border">
                                                        <i id="social_preview_init" class="fab fa-facebook-f"></i>
                                                    </div>
                                                    <input type="hidden" id="social_input_init" name="social_icon[]" value="fab fa-facebook-f">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('social_input_init'), document.getElementById('social_preview_init'))">Change</button>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">URL</label>
                                                <input type="url" class="form-control" name="social_text[]" placeholder="https://facebook.com/...">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">Save All Settings</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function addDynamicRow(containerId, type) {
        let defaultIcon = '';
        let placeholderText = '';
        let inputType = 'text';
        
        if (type === 'phone') { defaultIcon = 'fas fa-phone-alt'; placeholderText = 'Enter phone number'; }
        if (type === 'email') { defaultIcon = 'fas fa-envelope'; placeholderText = 'Enter email address'; inputType = 'email'; }
        if (type === 'social') { defaultIcon = 'fab fa-facebook-f'; placeholderText = 'https://...'; inputType = 'url'; }

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
                        <input type="${inputType}" class="form-control" name="${type}_text[]" placeholder="${placeholderText}">
                    </div>
                </div>
            </div>
        `;
        document.getElementById(containerId).insertAdjacentHTML('beforeend', row);
    }
</script>
@endpush
