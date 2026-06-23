@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Section Heading (Why Different)</h2>
        <a href="{{ route('admin.home-different.index') }}" class="btn btn-secondary">
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

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.home-different.section.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" 
                               value="{{ old('subtitle', $section->subtitle ?? '') }}" placeholder="e.g. Why Are We Different From Others">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="title" class="form-label">Main Heading Text</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="{{ old('title', $section->title ?? '') }}" placeholder="e.g. We are not like traditional outsourcing providers where they only focus on...">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="title_highlight" class="form-label">Highlighted Word/Phrase</label>
                        <input type="text" class="form-control" id="title_highlight" name="title_highlight" 
                               value="{{ old('title_highlight', $section->title_highlight ?? '') }}" placeholder="e.g. affordable cost.">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                               {{ old('status', $section->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Show this section on homepage</label>
                    </div>
                </div>

                <div class="alert alert-info py-2">
                    <i class="fas fa-eye me-1"></i> <strong>Live Preview:</strong>
                    <div class="mt-2 text-center">
                        <span id="preview-subtitle" class="text-danger small fw-bold d-block text-uppercase">Why Are We Different From Others</span>
                        <h2 class="h5 mt-1 text-dark">
                            <span id="preview-title">We are not like traditional outsourcing...</span>
                            <span id="preview-highlight" class="text-danger fst-italic">affordable cost.</span>
                        </h2>
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
        const subtitleInput = document.getElementById('subtitle');
        const titleInput = document.getElementById('title');
        const highlightInput = document.getElementById('title_highlight');

        const previewSubtitle = document.getElementById('preview-subtitle');
        const previewTitle = document.getElementById('preview-title');
        const previewHighlight = document.getElementById('preview-highlight');

        function updatePreview() {
            previewSubtitle.textContent = subtitleInput.value || 'Why Are We Different From Others';
            previewTitle.textContent = titleInput.value || 'We are not like traditional outsourcing providers where they only focus on cost reduction. We focus on quality first followed by other aspects. We do not want to be a cheap provider rather than quality solution provider within ';
            previewHighlight.textContent = highlightInput.value || 'affordable cost.';
        }

        subtitleInput.addEventListener('input', updatePreview);
        titleInput.addEventListener('input', updatePreview);
        highlightInput.addEventListener('input', updatePreview);

        updatePreview();
    });
</script>
@endpush
