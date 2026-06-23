@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Home "Why Different" Section</h2>
        <a href="{{ route('admin.home-different.section.edit') }}" class="btn btn-outline-secondary">
            <i class="fas fa-cog"></i> Edit Section Header
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Section Header Preview Card --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-heading me-2"></i>Section Heading Settings (Why Different)
            </h6>
        </div>
        <div class="card-body">
            @if($section)
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <th style="width: 180px;">Subtitle:</th>
                        <td>{{ $section->subtitle ?? '—' }}</td>
                    </tr>
                    <tr>
                        <th>Main Title:</th>
                        <td>
                            {{ $section->title ?? '—' }} 
                            @if($section->title_highlight)
                                <span class="text-danger fw-bold">{{ $section->title_highlight }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($section->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </table>
            @else
                <p class="text-muted mb-0">No settings found. <a href="{{ route('admin.home-different.section.edit') }}">Configure now</a>.</p>
            @endif
        </div>
    </div>

    {{-- Tabs List Card --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-folder me-2"></i>Tabs & Tab Contents ({{ $tabs->count() }})
            </h6>
            <a href="{{ route('admin.home-different.tabs.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add New Tab
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="vertical-align: middle;">
                    <thead>
                        <tr>
                            <th style="width: 60px;">Order</th>
                            <th>Icon</th>
                            <th>Tab Name</th>
                            <th>Content Title</th>
                            <th>Content Description</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 140px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tabs as $tab)
                            <tr>
                                <td>{{ $tab->order }}</td>
                                <td>
                                    @if($tab->icon)
                                        <i class="flaticon {{ $tab->icon }} text-primary fs-4" title="{{ $tab->icon }}"></i>
                                        <small class="d-block text-muted">{{ $tab->icon }}</small>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td><strong>{{ $tab->title }}</strong></td>
                                <td>{{ $tab->content_title ?? '—' }}</td>
                                <td><small class="text-muted">{{ Str::limit($tab->content_description ?? '—', 100) }}</small></td>
                                <td>
                                    @if($tab->status)
                                        <span class="badge bg-success">Show</span>
                                    @else
                                        <span class="badge bg-secondary">Hide</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group table-actions">
                                        <a href="{{ route('admin.home-different.tabs.edit', $tab->id) }}" class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.home-different.tabs.destroy', $tab->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tab?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No tabs created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
