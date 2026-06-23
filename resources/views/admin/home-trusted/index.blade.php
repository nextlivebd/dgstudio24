@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Home — Trusted Section Settings</h2>
        <a href="{{ route('admin.home-trusted.section.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Section Settings
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ── Section Settings Preview ──────────────────────────────────────── --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-sliders-h me-2"></i>Section Heading & Text
            </h6>
            <a href="{{ route('admin.home-trusted.section.edit') }}" class="btn btn-sm btn-info text-white">
                <i class="fas fa-edit"></i> Edit Settings
            </a>
        </div>
        <div class="card-body">
            @if($section)
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th style="width:180px">Subtitle:</th><td>{{ $section->subtitle ?? '—' }}</td></tr>
                        <tr><th>Title:</th><td>{{ $section->title ?? '—' }} <span class="text-danger">{{ $section->title_highlight ?? '' }}</span></td></tr>
                        <tr><th>Description:</th><td>{{ $section->description ?? '—' }}</td></tr>
                        <tr><th>Status:</th><td>
                            @if($section->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td></tr>
                    </table>
                </div>
            </div>
            @else
                <p class="text-muted mb-0">No section settings found. <a href="{{ route('admin.home-trusted.section.edit') }}">Configure now</a>.</p>
            @endif
        </div>
    </div>

    <div class="row">
        {{-- ── Feature Boxes ────────────────────────────────────────────────── --}}
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-check-circle me-2"></i>Features ({{ $features->count() }}/3)
                    </h6>
                    <a href="{{ route('admin.home-trusted.features.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Feature
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px">Order</th>
                                    <th style="width:80px">Icon</th>
                                    <th>Title</th>
                                    <th style="width:90px">Status</th>
                                    <th style="width:130px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($features as $f)
                                    <tr>
                                        <td class="text-center">{{ $f->order }}</td>
                                        <td class="text-center">
                                            @if($f->icon)
                                                <span class="badge bg-secondary p-2"><i class="{{ $f->icon }}"></i></span>
                                            @else
                                                <small class="text-muted">None</small>
                                            @endif
                                        </td>
                                        <td><strong>{{ $f->title }}</strong></td>
                                        <td>
                                            @if($f->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="{{ route('admin.home-trusted.features.edit', $f->id) }}"
                                                   class="btn btn-sm btn-info text-white" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.home-trusted.features.destroy', $f->id) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Delete this feature?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No features added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Counter Boxes ────────────────────────────────────────────────── --}}
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calculator me-2"></i>Counters ({{ $counters->count() }}/4)
                    </h6>
                    <a href="{{ route('admin.home-trusted.counters.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Counter
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px">Order</th>
                                    <th style="width:80px">Icon</th>
                                    <th>Label / Value</th>
                                    <th style="width:90px">Status</th>
                                    <th style="width:130px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($counters as $c)
                                    <tr>
                                        <td class="text-center">{{ $c->order }}</td>
                                        <td class="text-center">
                                            @if($c->icon)
                                                <span class="badge bg-secondary p-2"><i class="{{ $c->icon }}"></i></span>
                                            @else
                                                <small class="text-muted">None</small>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $c->label }}</strong>
                                            <br><span class="badge bg-primary">{{ number_format($c->count) }}</span>
                                        </td>
                                        <td>
                                            @if($c->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="{{ route('admin.home-trusted.counters.edit', $c->id) }}"
                                                   class="btn btn-sm btn-info text-white" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.home-trusted.counters.destroy', $c->id) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Delete this counter?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No counters added yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
