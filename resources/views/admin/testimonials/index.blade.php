@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Home — Testimonial Section</h2>
        <a href="{{ route('admin.testimonials.section.edit') }}" class="btn btn-primary">
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
                <i class="fas fa-sliders-h me-2"></i>Section Settings
            </h6>
            <a href="{{ route('admin.testimonials.section.edit') }}" class="btn btn-sm btn-info text-white">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
        <div class="card-body">
            @if($section)
            <div class="row">
                <div class="col-md-3 text-center">
                    @if($section->right_image)
                        <img src="{{ asset($section->right_image) }}" class="img-fluid img-thumbnail" style="max-height:160px;" alt="Right Image">
                        <small class="d-block text-muted mt-1">Right Side Image</small>
                    @else
                        <div class="p-4 bg-light rounded text-muted"><i class="fas fa-image fa-2x"></i><br>No image</div>
                    @endif
                </div>
                <div class="col-md-9">
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th style="width:180px">Subtitle:</th><td>{{ $section->subtitle ?? '—' }}</td></tr>
                        <tr><th>Title:</th><td>{{ $section->title ?? '—' }} <span class="text-danger">{{ $section->title_highlight ?? '' }}</span></td></tr>
                        <tr><th>CTA Text:</th><td>{{ $section->cta_text ?? '—' }}</td></tr>
                        <tr><th>CTA Phone:</th><td><strong>{{ $section->cta_phone ?? '—' }}</strong></td></tr>
                        <tr><th>Experience:</th><td><strong>{{ $section->experience_count }}</strong> — {{ $section->experience_label ?? '—' }}</td></tr>
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
                <p class="text-muted mb-0">No section settings found. <a href="{{ route('admin.testimonials.section.edit') }}">Configure now</a>.</p>
            @endif
        </div>
    </div>

    {{-- ── Testimonials List ──────────────────────────────────────────────── --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-quote-left me-2"></i>Testimonials ({{ $testimonials->count() }})
            </h6>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add Testimonial
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px">Order</th>
                            <th style="width:80px">Avatar</th>
                            <th>Name / Position</th>
                            <th>Review</th>
                            <th style="width:100px">Rating</th>
                            <th style="width:90px">Status</th>
                            <th style="width:130px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $t)
                            <tr>
                                <td class="text-center">{{ $t->order }}</td>
                                <td class="text-center">
                                    @if($t->avatar)
                                        <img src="{{ asset($t->avatar) }}" class="rounded-circle" width="50" height="50" style="object-fit:cover;" alt="{{ $t->name }}">
                                    @else
                                        <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $t->name }}</strong>
                                    @if($t->position)
                                        <br><small class="text-muted">{{ $t->position }}</small>
                                    @endif
                                </td>
                                <td><small>{{ Str::limit($t->quote, 100) }}</small></td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star{{ $i <= $t->rating ? '' : '-o' }}" style="color:#f5a623;font-size:12px;"></i>
                                    @endfor
                                    <br><small class="text-muted">{{ $t->rating }}/5</small>
                                </td>
                                <td>
                                    @if($t->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.testimonials.edit', $t->id) }}"
                                           class="btn btn-sm btn-info text-white" title="Edit">
                                            <i class="fas fa-edit"></i> <span class="btn-label">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $t->id) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Delete this testimonial?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> <span class="btn-label">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-quote-left fa-2x mb-2 d-block"></i>
                                    No testimonials yet. <a href="{{ route('admin.testimonials.create') }}">Add one now</a>.
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
