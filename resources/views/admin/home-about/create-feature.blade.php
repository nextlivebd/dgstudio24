@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add Feature Box</h2>
        <a href="{{ route('admin.home-about.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.home-about.features.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon Class</label>
                    <input type="text" class="form-control" id="icon" name="icon"
                           value="{{ old('icon') }}" placeholder="e.g. ti ti-medall  or  flaticon flaticon-24h">
                    <small class="text-muted">
                        Use Themify icons (<code>ti ti-medall</code>) or Flaticons (<code>flaticon flaticon-24h</code>).
                        <br>Preview: <span id="icon-preview" class="ms-1"></span>
                    </small>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{ old('title') }}" required placeholder="e.g. 100% Satisfaction">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                              placeholder="Short description for this feature box...">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="order" name="order"
                               value="{{ old('order', 0) }}" min="0">
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                   {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Feature Box
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('icon').addEventListener('input', function () {
        document.getElementById('icon-preview').className = this.value;
    });
</script>
@endsection
