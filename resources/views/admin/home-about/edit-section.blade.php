@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit About Section</h2>
        <a href="{{ route('admin.home-about.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.home-about.section.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle <small class="text-muted">(e.g. "About Global Graphic Giant")</small></label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle"
                           value="{{ old('subtitle', $section->subtitle ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Main Heading (h3)</label>
                    <textarea class="form-control" id="title" name="title" rows="3">{{ old('title', $section->title ?? '') }}</textarea>
                    <small class="text-muted">This is the large title that appears below the subtitle.</small>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description Paragraph</label>
                    <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $section->description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Section Image <small class="text-muted">(left side)</small></label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @if(isset($section) && $section->image)
                        <div class="mt-2">
                            <img src="{{ asset($section->image) }}" alt="Current Image" class="img-thumbnail" style="max-height:140px;">
                            <small class="d-block text-muted mt-1">Current image. Upload a new one to replace it.</small>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                               {{ old('status', $section->status ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Active (show on homepage)</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
