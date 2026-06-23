@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Services Section Heading</h2>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Services
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-heading me-2"></i>Section Heading — shown on Home Page above service categories
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.section.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $section->subtitle ?? '') }}"
                               placeholder="e.g. Our Services">
                        <small class="text-muted">Small text shown above the main title.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title (main text)</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $section->title ?? '') }}"
                               placeholder="e.g. We run all kinds of Web Development, Image Design & 3D services with 19+ years of">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Title Highlight <small class="text-danger">(colored/italic span)</small></label>
                        <input type="text" class="form-control" name="title_highlight"
                               value="{{ old('title_highlight', $section->title_highlight ?? '') }}"
                               placeholder="e.g. experience">
                        <small class="text-muted">This word appears highlighted/italicized at the end of the title.</small>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                               {{ old('status', $section->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Show this heading on homepage</label>
                    </div>
                </div>

                <div class="alert alert-info py-2">
                    <i class="fas fa-eye me-1"></i> <strong>Preview:</strong>
                    <div class="mt-1">
                        <small class="d-block text-muted" id="preview-subtitle">Our Services</small>
                        <span id="preview-title" class="fw-bold">We run all kinds of Web Development...</span>
                        <span id="preview-highlight" class="text-danger fst-italic ms-1">experience</span>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subtitleInput = document.querySelector('input[name="subtitle"]');
        const titleInput = document.querySelector('input[name="title"]');
        const highlightInput = document.querySelector('input[name="title_highlight"]');

        const previewSubtitle = document.getElementById('preview-subtitle');
        const previewTitle = document.getElementById('preview-title');
        const previewHighlight = document.getElementById('preview-highlight');

        function updatePreview() {
            previewSubtitle.textContent = subtitleInput.value || 'Our Services';
            previewTitle.textContent = titleInput.value || 'We run all kinds of Web Development, Image Design & 3D services with 19+ years of';
            previewHighlight.textContent = highlightInput.value || 'experience';
        }

        subtitleInput.addEventListener('input', updatePreview);
        titleInput.addEventListener('input', updatePreview);
        highlightInput.addEventListener('input', updatePreview);

        // Initial preview update
        updatePreview();
    });
</script>
@endpush

