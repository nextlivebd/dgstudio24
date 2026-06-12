@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add New Slider</h2>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Sliders
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
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="background_image" class="form-label">Background Image</label>
                        <input type="file" class="form-control" id="background_image" name="background_image">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="front_image" class="form-label">Front Image (Optional)</label>
                        <input type="file" class="form-control" id="front_image" name="front_image">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title_1" class="form-label">Title Line 1</label>
                        <input type="text" class="form-control" id="title_1" name="title_1" value="{{ old('title_1') }}" placeholder="e.g. We Create Beautiful">
                        <small class="text-muted">HTML tags like &lt;strong&gt; are allowed.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="title_2" class="form-label">Title Line 2</label>
                        <input type="text" class="form-control" id="title_2" name="title_2" value="{{ old('title_2') }}" placeholder='e.g. &lt;strong class="ttm-textcolor-skincolor"&gt;Websites&lt;/strong&gt;'>
                        <small class="text-muted">HTML tags like &lt;strong&gt; are allowed.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_1_text" class="form-label">Button 1 Text</label>
                        <input type="text" class="form-control" id="button_1_text" name="button_1_text" value="{{ old('button_1_text') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="button_1_link" class="form-label">Button 1 Link</label>
                        <input type="text" class="form-control" id="button_1_link" name="button_1_link" value="{{ old('button_1_link') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_2_text" class="form-label">Button 2 Text</label>
                        <input type="text" class="form-control" id="button_2_text" name="button_2_text" value="{{ old('button_2_text') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="button_2_link" class="form-label">Button 2 Link</label>
                        <input type="text" class="form-control" id="button_2_link" name="button_2_link" value="{{ old('button_2_link') }}">
                    </div>
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

                <button type="submit" class="btn btn-primary">Save Slider</button>
            </form>
        </div>
    </div>
</div>
@endsection
