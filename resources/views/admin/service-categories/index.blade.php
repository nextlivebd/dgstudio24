@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Service Categories</h2>
        <a href="{{ route('admin.service-categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><i class="{{ $category->icon ?? 'fas fa-sitemap' }} text-primary"></i></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent ? $category->parent->name : 'Top Level' }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if($category->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.service-categories.edit', $category->id) }}" class="btn btn-sm btn-info text-white" title="Edit">
                                            <i class="fas fa-edit"></i> <span class="btn-label">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.service-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fas fa-trash"></i> <span class="btn-label">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
