@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Sliders</h2>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Slider
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
                            <th>Order</th>
                            <th>Background</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td>{{ $slider->order }}</td>
                                <td>
                                    @if($slider->background_image)
                                        @if(Str::startsWith($slider->background_image, 'frontend/'))
                                            <img src="{{ asset($slider->background_image) }}" alt="Background" width="120" class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('storage/' . $slider->background_image) }}" alt="Background" width="120" class="img-thumbnail">
                                        @endif
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    {!! $slider->title_1 !!} <br>
                                    {!! $slider->title_2 !!}
                                </td>
                                <td>
                                    @if($slider->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-info text-white" title="Edit">
                                            <i class="fas fa-edit"></i> <span class="btn-label">Edit</span>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this slider?');">
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
                                <td colspan="5" class="text-center">No sliders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
