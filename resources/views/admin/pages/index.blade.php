@extends('admin.layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="mt-4">Pages</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Manage Frontend Pages
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug (URL)</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->title ?? ucwords(str_replace('-', ' ', $page->slug)) }}</td>
                            <td>/{{ $page->slug }}</td>
                            <td>{{ $page->updated_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i> <span class="btn-label">Edit</span>
                                    </a>
                                    <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-sm btn-info text-white" title="View">
                                        <i class="fas fa-eye"></i> <span class="btn-label">View</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No pages found. Run the migration script to sync.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
