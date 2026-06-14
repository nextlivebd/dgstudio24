@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add New Service Category</h2>
        <a href="{{ route('admin.service-categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Categories
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
            <form action="{{ route('admin.service-categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Category (Optional)</label>
                    <select class="form-select" id="parent_id" name="parent_id">
                        <option value="">None (Top Level)</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon Class (FontAwesome)</label>
                    <div class="input-group">
                        <span class="input-group-text" id="icon-preview"><i class="fas fa-sitemap"></i></span>
                        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}" placeholder="e.g. fas fa-sitemap">
                        <button class="btn btn-outline-secondary" type="button" onclick="openIconPicker(document.getElementById('icon'), document.getElementById('icon-preview').firstElementChild)">Choose Icon</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
