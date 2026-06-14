@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Portfolios</h2>
        <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Portfolio
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($portfolios as $portfolio)
                            <tr>
                                <td>
                                    @if($portfolio->image)
                                        <img src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}" style="width: 80px; height: 50px; object-fit: cover;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $portfolio->title }}</td>
                                <td>{{ $portfolio->category->name ?? 'N/A' }}</td>
                                <td>
                                    @if($portfolio->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this portfolio?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No portfolios found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
