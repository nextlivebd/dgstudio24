@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Home CTA Settings</h2>
        <a href="{{ route('admin.home-cta.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Settings
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
            <form action="{{ route('admin.home-cta.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">CTA Title</label>
                    <input type="text" class="form-control" id="title" name="title" 
                           value="{{ old('title', $section->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">CTA Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $section->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Thumbnail / Video Image (Left Side)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @if(isset($section) && $section->image)
                        <div class="mt-2">
                            <img src="{{ asset($section->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 140px;">
                            <small class="d-block text-muted mt-1">Current image preview.</small>
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                               {{ old('status', $section->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Show this section on homepage</label>
                    </div>
                </div>

                <div class="alert alert-info py-2 mb-4">
                    <i class="fas fa-eye me-1"></i> <strong>Live Preview:</strong>
                    <div class="mt-2 p-3 bg-danger text-white rounded">
                        <h4 id="preview-title" class="mb-2 fw-bold">Knock Us if you need...</h4>
                        <p id="preview-desc" class="mb-0 small text-white-50">Global Graphic Giant is...</p>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save CTA Settings
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const descInput = document.getElementById('description');

        const previewTitle = document.getElementById('preview-title');
        const previewDesc = document.getElementById('preview-desc');

        function updatePreview() {
            previewTitle.textContent = titleInput.value || 'Knock Us if you need to create an awesome website & web application!';
            previewDesc.textContent = descInput.value || 'Global Graphic Giant is one of the fastest growing and forward thinking IT solution companies in Bangladesh...';
        }

        titleInput.addEventListener('input', updatePreview);
        descInput.addEventListener('input', updatePreview);

        updatePreview();
    });
</script>
@endpush
