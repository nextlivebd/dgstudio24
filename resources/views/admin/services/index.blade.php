@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Services</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.services.section.edit') }}" class="btn btn-outline-secondary">
                <i class="fas fa-sliders-h"></i> Section Settings
            </a>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Service
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ── Services Section Header Preview ──────────────────────────────── --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-heading me-2"></i>Services Section Heading (Home Page)
            </h6>
            <a href="{{ route('admin.services.section.edit') }}" class="btn btn-sm btn-info text-white">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
        <div class="card-body">
            @if($section)
                <table class="table table-sm table-borderless mb-0">
                    <tr><th style="width:160px">Subtitle:</th><td>{{ $section->subtitle ?? '—' }}</td></tr>
                    <tr><th>Title:</th><td>{{ $section->title ?? '—' }} <span class="text-danger">{{ $section->title_highlight ?? '' }}</span></td></tr>
                    <tr><th>Status:</th><td>
                        @if($section->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td></tr>
                </table>
            @else
                <p class="text-muted mb-0">No section settings found. <a href="{{ route('admin.services.section.edit') }}">Configure now</a>.</p>
            @endif
        </div>
    </div>

    {{-- ── Services List ─────────────────────────────────────────────────── --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list me-2"></i>All Services ({{ $services->count() }})
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:100px">Thumbnail</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th style="width:90px">Status</th>
                            <th style="width:140px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>
                                    @if($service->thumbnail_image)
                                        <img src="{{ asset($service->thumbnail_image) }}" alt="{{ $service->title }}" style="width: 80px; height: 50px; object-fit: cover;" class="rounded">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>
                                <td><strong>{{ $service->title }}</strong></td>
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
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-concierge-bell fa-2x mb-2 d-block"></i>
                                    No services found. <a href="{{ route('admin.services.create') }}">Add one now</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
