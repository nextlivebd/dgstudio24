@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Edit Video Banner Settings</h2>
        <a href="{{ route('admin.home-video-banner.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.home-video-banner.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="row">
            {{-- LEFT COLUMN: Text Settings --}}
            <div class="col-lg-8">

                <!-- Text Content -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-align-left me-2"></i>Banner Text Content</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Main Title</label>
                            <input type="text" name="title" id="inp_title" class="form-control" value="{{ old('title', $banner->title) }}" placeholder="We help to create your business identity &">
                            <small class="text-muted">The main heading text (before the highlighted part)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title Highlight <span class="text-danger">*</span></label>
                            <input type="text" name="title_highlight" id="inp_highlight" class="form-control" value="{{ old('title_highlight', $banner->title_highlight) }}" placeholder="stunning on online,">
                            <small class="text-muted">This text will appear highlighted/colored in the title</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="inp_desc" class="form-control" rows="3" placeholder="with Basic Website, Web Application...">{{ old('description', $banner->description) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Button Text</label>
                                <input type="text" name="btn_text" id="inp_btn_text" class="form-control" value="{{ old('btn_text', $banner->btn_text) }}" placeholder="View Portfolio">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Button URL</label>
                                <input type="text" name="btn_url" id="inp_btn_url" class="form-control" value="{{ old('btn_url', $banner->btn_url) }}" placeholder="portfolio">
                                <small class="text-muted">Relative or absolute URL (e.g. <code>portfolio</code>)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Settings -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-play-circle me-2"></i>Play Button / Video Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Video URL</label>
                            <input type="text" name="video_url" id="inp_video_url" class="form-control" value="{{ old('video_url', $banner->video_url) }}" placeholder="https://www.youtube.com/embed/XXXXXXXXX">
                            <small class="text-muted">
                                YouTube embed or direct video link. Leave <strong>empty</strong> to hide the play button — instead a logo will be shown (based on Logo Display setting below).
                            </small>
                        </div>
                        <div class="alert alert-info py-2 mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            <strong>Logic:</strong> If a Video URL is set → play button shows. If empty → logo is shown (site logo or custom, based on Logo Display setting).
                        </div>
                    </div>
                </div>

                <!-- Logo Display -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-image me-2"></i>Logo Display (when no video)</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Logo Source</label>
                            <select name="logo_source" id="logo_source_select" class="form-select">
                                <option value="site_logo"  {{ old('logo_source', $banner->logo_source) === 'site_logo'  ? 'selected' : '' }}>Use Site Logo (from Settings)</option>
                                <option value="custom_logo"{{ old('logo_source', $banner->logo_source) === 'custom_logo' ? 'selected' : '' }}>Upload Custom Logo</option>
                                <option value="none"       {{ old('logo_source', $banner->logo_source) === 'none'        ? 'selected' : '' }}>None (hide logo)</option>
                            </select>
                            <small class="text-muted">Only visible when Video URL is empty.</small>
                        </div>

                        <div id="custom_logo_wrap" style="{{ old('logo_source', $banner->logo_source) === 'custom_logo' ? '' : 'display:none;' }}">
                            <label class="form-label fw-semibold">Upload Custom Logo</label>
                            <input type="file" name="custom_logo" id="inp_custom_logo" class="form-control" accept="image/*">
                            @if($banner->custom_logo)
                                <div class="mt-2 p-2 bg-light rounded d-flex align-items-center gap-3">
                                    <img src="{{ asset($banner->custom_logo) }}" alt="Current Logo" style="max-height: 60px; object-fit: contain;">
                                    <div>
                                        <span class="text-muted small d-block">Current custom logo. Upload new to replace.</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger mt-1"
                                            onclick="if(confirm('Remove custom logo?')) document.getElementById('remove-logo-form').submit()">
                                            <i class="fas fa-trash"></i> Remove Logo
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN: Background & Status --}}
            <div class="col-lg-4">

                <!-- Status -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-toggle-on me-2"></i>Section Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
                                {{ old('status', $banner->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Section Active (visible on frontend)</label>
                        </div>
                    </div>
                </div>

                <!-- Background Image -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-photo-video me-2"></i>Background Image</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Upload Background</label>
                            <input type="file" name="background_image" id="inp_bg_image" class="form-control" accept="image/*">
                            <small class="text-muted">Replaces the default dark CSS background. Recommended: 1920×600px.</small>
                        </div>
                        @if($banner->background_image)
                            <div class="mb-2">
                                <p class="fw-semibold mb-1 small">Current Background:</p>
                                <img src="{{ asset($banner->background_image) }}" alt="Background" class="img-thumbnail w-100" style="max-height: 120px; object-fit: cover;">
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger w-100"
                                onclick="if(confirm('Remove background image?')) document.getElementById('remove-bg-form').submit()">
                                <i class="fas fa-trash"></i> Remove Background
                            </button>
                        @else
                            <div class="text-center p-3 bg-light rounded border border-dashed">
                                <i class="fas fa-image fa-2x text-secondary mb-1 d-block"></i>
                                <span class="text-muted small">No custom background.<br>Default dark style will be used.</span>
                            </div>
                            <div id="bg_preview_wrap" class="mt-2" style="display:none;">
                                <img id="bg_preview" src="" class="img-thumbnail w-100" style="max-height:120px; object-fit:cover;" alt="Preview">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Live Preview -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-eye me-2"></i>Preview</h6>
                    </div>
                    <div class="card-body p-0">
                        <div id="banner_preview" style="background:#263045; min-height:160px; padding:24px; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; border-radius:0 0 .35rem .35rem;">
                            <div id="prev_play" style="width:40px;height:40px;border-radius:50%;background:#ff5722;display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                                <i class="fa fa-play" style="color:#fff;font-size:14px;margin-left:3px;"></i>
                            </div>
                            <div id="prev_title" style="color:#fff;font-size:16px;font-weight:600;margin-bottom:6px;">
                                {{ $banner->title ?? '' }} <span style="color:#ff5722;">{{ $banner->title_highlight ?? '' }}</span>
                            </div>
                            <div id="prev_desc" style="color:#aaa;font-size:12px;margin-bottom:10px;">{{ $banner->description ?? '' }}</div>
                            <a id="prev_btn" href="#" style="border:1px solid #fff;color:#fff;padding:5px 16px;font-size:12px;text-decoration:none;">{{ $banner->btn_text ?? 'View Portfolio' }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Save Video Banner Settings
            </button>
            <a href="{{ route('admin.home-video-banner.index') }}" class="btn btn-outline-secondary btn-lg ms-2">Cancel</a>
        </div>
    </form>

    {{-- Hidden DELETE forms placed OUTSIDE the main form to avoid nested form issues --}}
    <form id="remove-bg-form" action="{{ route('admin.home-video-banner.remove-background') }}" method="POST" style="display:none;">
        @csrf @method('DELETE')
    </form>
    <form id="remove-logo-form" action="{{ route('admin.home-video-banner.remove-logo') }}" method="POST" style="display:none;">
        @csrf @method('DELETE')
    </form>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Logo source toggle
    const logoSelect = document.getElementById('logo_source_select');
    const customLogoWrap = document.getElementById('custom_logo_wrap');
    logoSelect.addEventListener('change', function () {
        customLogoWrap.style.display = this.value === 'custom_logo' ? '' : 'none';
    });

    // Background image preview
    const bgInput = document.getElementById('inp_bg_image');
    if (bgInput) {
        bgInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                document.getElementById('banner_preview').style.backgroundImage = 'url(' + url + ')';
                document.getElementById('banner_preview').style.backgroundSize = 'cover';
                const wrapEl = document.getElementById('bg_preview_wrap');
                const prevEl = document.getElementById('bg_preview');
                if (wrapEl && prevEl) {
                    prevEl.src = url;
                    wrapEl.style.display = '';
                }
            }
        });
    }

    // Live preview for text fields
    const titleInput   = document.getElementById('inp_title');
    const highlightInput = document.getElementById('inp_highlight');
    const descInput    = document.getElementById('inp_desc');
    const btnInput     = document.getElementById('inp_btn_text');
    const videoInput   = document.getElementById('inp_video_url');

    function updatePreview() {
        document.getElementById('prev_title').innerHTML =
            (titleInput.value || '') + ' <span style="color:#ff5722;">' + (highlightInput.value || '') + '</span>';
        document.getElementById('prev_desc').textContent = descInput.value || '';
        document.getElementById('prev_btn').textContent  = btnInput.value || 'View Portfolio';
        // Toggle play button visibility
        const hasVideo = videoInput.value.trim().length > 0;
        document.getElementById('prev_play').style.display = hasVideo ? '' : 'none';
    }

    [titleInput, highlightInput, descInput, btnInput, videoInput].forEach(el => {
        if (el) el.addEventListener('input', updatePreview);
    });
    updatePreview();
});
</script>
@endpush
