@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Home — About Section</h2>
        <a href="{{ route('admin.home-about.section.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit About Content
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ── About Section Preview ─────────────────────────────────────── --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">About Section Content</h6>
            <a href="{{ route('admin.home-about.section.edit') }}" class="btn btn-sm btn-info text-white">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
        <div class="card-body">
            @if($section)
                <div class="row">
                    <div class="col-md-3">
                        @if($section->image)
                            <img src="{{ asset($section->image) }}" class="img-fluid img-thumbnail" alt="About Image">
                        @else
                            <span class="text-muted"><i class="fas fa-image fa-3x"></i><br>No image set</span>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <p><strong>Subtitle:</strong> {{ $section->subtitle ?? '—' }}</p>
                        <p><strong>Title:</strong> {{ $section->title ?? '—' }}</p>
                        <p><strong>Description:</strong> {{ Str::limit($section->description, 200) }}</p>
                        <p>
                            <strong>Status:</strong>
                            @if($section->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <p class="text-muted">No about section content found. <a href="{{ route('admin.home-about.section.edit') }}">Add content</a>.</p>
            @endif
        </div>
    </div>

    {{-- ── Feature Boxes ─────────────────────────────────────────────── --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Feature Boxes</h6>
            <a href="{{ route('admin.home-about.features.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add Feature Box
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($features as $feature)
                            <tr>
                                <td>{{ $feature->order }}</td>
                                <td>
                                    @if($feature->icon)
                                        <i class="{{ $feature->icon }} fa-lg"></i>
                                        <br><small class="text-muted">{{ $feature->icon }}</small>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td><strong>{{ $feature->title }}</strong></td>
                                <td>{{ Str::limit($feature->description, 80) }}</td>
                                <td>
                                    @if($feature->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.home-about.features.edit', $feature->id) }}"
                                           class="btn btn-sm btn-info text-white" title="Edit">
                                            <i class="fas fa-edit"></i> <span class="btn-label">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.home-about.features.destroy', $feature->id) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Delete this feature box?');">
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
                                <td colspan="6" class="text-center">No feature boxes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
