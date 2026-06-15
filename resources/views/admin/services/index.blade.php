@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Services</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Service
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
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>
                                    @if($service->thumbnail_image)
                                        <img src="{{ asset($service->thumbnail_image) }}" alt="{{ $service->title }}" style="width: 80px; height: 50px; object-fit: cover;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->category->name ?? 'N/A' }}</td>
                                <td>
                                    @if($service->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-info text-white" title="Edit">
                                            <i class="fas fa-edit"></i> <span class="btn-label">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                                <td colspan="5" class="text-center">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
