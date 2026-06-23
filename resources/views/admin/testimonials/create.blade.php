@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add New Testimonial</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Testimonials
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
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Client Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Eddle Cipolla">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position / Company (Optional)</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" placeholder="e.g. Account Director at St. Joseph Communications, Canada">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="avatar" class="form-label">Avatar / Profile Image (Optional)</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        <small class="text-muted">Recommended square aspect ratio (e.g. 150x150 px).</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="quote" class="form-label">Review / Quote <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="quote" name="quote" rows="4" required placeholder="Type the testimonial content here...">{{ old('quote') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Testimonial
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
