@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add New Counter</h2>
        <a href="{{ route('admin.home-trusted.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.home-trusted.counters.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="label" class="form-label">Counter Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="label" name="label" value="{{ old('label') }}" required placeholder="e.g. Markets, FTE, Jobs Completed">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="count" class="form-label">Counter Value (number) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="count" name="count" value="{{ old('count') }}" required placeholder="e.g. 13214">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="icon" class="form-label">Icon Class</label>
                        <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}" placeholder="e.g. flaticon flaticon-developer">
                        <small class="text-muted">Use theme icon classes (e.g. <code>flaticon flaticon-developer</code>, <code>flaticon flaticon-interaction</code>, <code>flaticon flaticon-global-1</code>).</small>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Counter
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
