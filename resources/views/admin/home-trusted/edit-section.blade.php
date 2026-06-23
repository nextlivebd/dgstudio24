@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Trusted Section Settings</h2>
        <a href="{{ route('admin.home-trusted.index') }}" class="btn btn-secondary">
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
            <h6 class="m-0 font-weight-bold text-primary">Section Heading & Content</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home-trusted.section.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle"
                               value="{{ old('subtitle', $section->subtitle ?? '') }}"
                               placeholder="e.g. About Global Graphic Giant">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Title (main text)</label>
                        <input type="text" class="form-control" name="title"
                               value="{{ old('title', $section->title ?? '') }}"
                               placeholder="e.g. Trusted by 5,000+">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Title Highlight <small class="text-danger">(colored span)</small></label>
                        <input type="text" class="form-control" name="title_highlight"
                               value="{{ old('title_highlight', $section->title_highlight ?? '') }}"
                               placeholder="e.g. Happy Clients">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description / Paragraph</label>
                    <textarea class="form-control" name="description" rows="4" placeholder="Enter paragraph text...">{{ old('description', $section->description ?? '') }}</textarea>
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
