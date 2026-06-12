@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800 fw-bold">Edit User</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger shadow-sm border-0">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-white py-3 border-bottom-0">
            <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-medium">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bg-light border-0" name="name" value="{{ old('name', $user->name) }}" required placeholder="Enter full name">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-medium">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control bg-light border-0" name="email" value="{{ old('email', $user->email) }}" required placeholder="Enter email address">
                    </div>

                    <div class="col-12 mt-3 mb-2">
                        <h6 class="fw-bold text-muted border-bottom pb-2">Change Password <span class="fw-normal fs-6 text-warning">(Leave blank if you don't want to change)</span></h6>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-medium">New Password</label>
                        <input type="password" class="form-control bg-light border-0" name="password" placeholder="Enter new password">
                        <small class="text-muted">Password must be at least 8 characters long.</small>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-medium">Confirm New Password</label>
                        <input type="password" class="form-control bg-light border-0" name="password_confirmation" placeholder="Re-enter new password">
                    </div>
                </div>

                <div class="text-end mt-2">
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
