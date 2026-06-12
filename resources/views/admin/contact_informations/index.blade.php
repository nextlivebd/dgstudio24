@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Office Information</h2>
        <a href="{{ route('admin.contact-informations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Office
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
                            <th>Office Name</th>
                            <th>Status</th>
                            <th>Addresses</th>
                            <th>Phones</th>
                            <th>Emails</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contactInfos as $info)
                            <tr>
                                <td>{{ $info->office_name }}</td>
                                <td>
                                    @if($info->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ is_array($info->addresses) ? count($info->addresses) : 0 }}</td>
                                <td>{{ is_array($info->phones) ? count($info->phones) : 0 }}</td>
                                <td>{{ is_array($info->emails) ? count($info->emails) : 0 }}</td>
                                <td>
                                    <a href="{{ route('admin.contact-informations.edit', $info->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.contact-informations.destroy', $info->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this office info?');">
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
                                <td colspan="6" class="text-center">No office information found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
