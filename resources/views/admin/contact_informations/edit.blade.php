@extends('admin.layouts.app')

@push('styles')
<style>
    .dynamic-row { border: 1px dashed #dee2e6; padding: 15px; border-radius: 5px; margin-bottom: 15px; position: relative; background: #f8f9fa; }
    .remove-btn { position: absolute; top: 15px; right: 15px; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Office Info</h2>
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

    <form action="{{ route('admin.contact-informations.update', $contactInfo->id) }}" method="POST">
        @csrf
        @method('PUT')
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
                            <input type="text" class="form-control" name="office_name" value="{{ old('office_name', $contactInfo->office_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Google Map Embed Code (iframe)</label>
                            <textarea class="form-control" name="map_embed" rows="3">{{ old('map_embed', $contactInfo->map_embed) }}</textarea>
                        </div>
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ (old('is_active') ?? $contactInfo->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active Status</label>
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
                        @if(is_array($contactInfo->addresses) && count($contactInfo->addresses) > 0)
                            @foreach($contactInfo->addresses as $index => $address)
                            <div class="dynamic-row">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-btn" onclick="this.closest('.dynamic-row').remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="row pr-5">
                                    <div class="col-md-4">
                                        <label class="form-label">Icon</label>
                                        <div class="d-flex align-items-center">
                                            <div class="icon-preview-box me-2 border">
                                                <i id="address_preview_{{ $index }}" class="{{ $address['icon'] }}"></i>
                                            </div>
                                            <input type="hidden" id="address_input_{{ $index }}" name="address_icon[]" value="{{ $address['icon'] }}">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openIconPicker(document.getElementById('address_input_{{ $index }}'), document.getElementById('address_preview_{{ $index }}'))">Change</button>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Address Text</label>
                                        <input type="text" class="form-control" name="address_text[]" value="{{ $address['text'] }}">
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
                        @endif
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
                        @if(is_array($contactInfo->phones) && count($contactInfo->phones) > 0)
                            @foreach($contactInfo->phones as $index => $phone)
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

                <!-- Emails -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Email Addresses</h6>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addDynamicRow('email-container', 'email')">
                            <i class="fas fa-plus"></i> Add Email
                        </button>
                    </div>
                    <div class="card-body" id="email-container">
                        @if(is_array($contactInfo->emails) && count($contactInfo->emails) > 0)
                            @foreach($contactInfo->emails as $index => $email)
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

            </div>
            
            <div class="col-md-4">
                <div class="card shadow mb-4 position-sticky" style="top: 20px;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Update your office details below. You can remove existing entries or add new ones dynamically.</p>
                        <button type="submit" class="btn btn-primary w-100 btn-lg shadow-sm">Update Office Info</button>
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
