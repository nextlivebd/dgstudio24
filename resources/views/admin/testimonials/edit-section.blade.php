@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Testimonial Section Settings</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Section Heading & CTA</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.testimonials.section.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $section->subtitle ?? '') }}"
                               placeholder="e.g. About us">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title (main text)</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $section->title ?? '') }}"
                               placeholder="e.g. We deal with the aspects of professional">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Title Highlight <small class="text-danger">(colored span)</small></label>
                        <input type="text" class="form-control" name="title_highlight"
                               value="{{ old('title_highlight', $section->title_highlight ?? '') }}"
                               placeholder="e.g. Web Services">
                    </div>
                </div>

                <hr>
                <h6 class="text-muted mb-3"><i class="fas fa-phone me-1"></i> Call-to-Action Bar</h6>
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label class="form-label">CTA Text</label>
                        <input type="text" class="form-control" name="cta_text"
                               value="{{ old('cta_text', $section->cta_text ?? '') }}"
                               placeholder="e.g. Need a service & ready to order? Call us">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">CTA Phone Number</label>
                        <input type="text" class="form-control" name="cta_phone"
                               value="{{ old('cta_phone', $section->cta_phone ?? '') }}"
                               placeholder="e.g. +1 (416) 686-3111">
                    </div>
                </div>

                <hr>
                <h6 class="text-muted mb-3"><i class="fas fa-image me-1"></i> Right Side Image & Experience Counter</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Right Side Image</label>
                        <input type="file" class="form-control" name="right_image" accept="image/*">
                        @if(isset($section) && $section->right_image)
                            <div class="mt-2">
                                <img src="{{ asset($section->right_image) }}" class="img-thumbnail" style="max-height:120px;" alt="Current">
                                <small class="d-block text-muted mt-1">Current image. Upload to replace.</small>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Experience Count (number)</label>
                        <input type="number" class="form-control" name="experience_count" min="0"
                               value="{{ old('experience_count', $section->experience_count ?? 19) }}">
                        <small class="text-muted">The large animated number (e.g. 19)</small>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Experience Label</label>
                        <input type="text" class="form-control" name="experience_label"
                               value="{{ old('experience_label', $section->experience_label ?? '') }}"
                               placeholder="e.g. Years of Experience Web Solution">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                               {{ old('status', $section->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Show this section on homepage</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Settings
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
