@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Tab: {{ $tab->title }}</h2>
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
            <form action="{{ route('admin.home-different.tabs.update', $tab->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Tab Title / Label</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $tab->title) }}" placeholder="e.g. Reduce your costs" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="icon" class="form-label">Tab Icon (Flaticon/FontAwesome)</label>
                        <div class="input-group">
                            <span class="input-group-text icon-preview-box">
                                <i id="icon-preview" class="flaticon {{ $tab->icon ?? 'flaticon-code' }}"></i>
                            </span>
                            <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon', $tab->icon) }}" placeholder="e.g. flaticon-code">
                            <button type="button" class="btn btn-outline-secondary" onclick="openIconPicker(document.getElementById('icon'), document.getElementById('icon-preview'))">
                                Pick Icon
                            </button>
                        </div>
                        <small class="text-muted">Pick or type an icon class name.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content_title" class="form-label">Tab Content Title</label>
                    <input type="text" class="form-control" id="content_title" name="content_title" value="{{ old('content_title', $tab->content_title) }}" placeholder="e.g. Reduce your project costs">
                </div>

                <div class="mb-3">
                    <label for="content_description" class="form-label">Tab Content Description</label>
                    <textarea class="form-control" id="content_description" name="content_description" rows="5" placeholder="Enter content detailed text description...">{{ old('content_description', $tab->content_description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="order" class="form-label">Display Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $tab->order) }}" min="0">
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $tab->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Show this tab</label>
                        </div>
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
