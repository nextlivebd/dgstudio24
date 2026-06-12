@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Slider</h2>
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
            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="background_image" class="form-label">Background Image</label>
                        <input type="file" class="form-control" id="background_image" name="background_image">
                        @if($slider->background_image)
                            <div class="mt-2">
                                <p class="mb-1 text-muted">Current Image:</p>
                                @if(Str::startsWith($slider->background_image, 'frontend/'))
                                    <img src="{{ asset($slider->background_image) }}" alt="Background" width="150" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/' . $slider->background_image) }}" alt="Background" width="150" class="img-thumbnail">
                                @endif
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="front_image" class="form-label">Front Image (Optional)</label>
                        <input type="file" class="form-control" id="front_image" name="front_image">
                        @if($slider->front_image)
                            <div class="mt-2">
                                <p class="mb-1 text-muted">Current Image:</p>
                                @if(Str::startsWith($slider->front_image, 'frontend/'))
                                    <img src="{{ asset($slider->front_image) }}" alt="Front Image" width="150" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/' . $slider->front_image) }}" alt="Front Image" width="150" class="img-thumbnail">
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title_1" class="form-label">Title Line 1</label>
                        <input type="text" class="form-control" id="title_1" name="title_1" value="{{ old('title_1', $slider->title_1) }}">
                        <small class="text-muted">HTML tags like &lt;strong&gt; are allowed.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="title_2" class="form-label">Title Line 2</label>
                        <input type="text" class="form-control" id="title_2" name="title_2" value="{{ old('title_2', $slider->title_2) }}">
                        <small class="text-muted">HTML tags like &lt;strong&gt; are allowed.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $slider->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_1_text" class="form-label">Button 1 Text</label>
                        <input type="text" class="form-control" id="button_1_text" name="button_1_text" value="{{ old('button_1_text', $slider->button_1_text) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="button_1_link" class="form-label">Button 1 Link</label>
                        <input type="text" class="form-control" id="button_1_link" name="button_1_link" value="{{ old('button_1_link', $slider->button_1_link) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_2_text" class="form-label">Button 2 Text</label>
                        <input type="text" class="form-control" id="button_2_text" name="button_2_text" value="{{ old('button_2_text', $slider->button_2_text) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="button_2_link" class="form-label">Button 2 Link</label>
                        <input type="text" class="form-control" id="button_2_link" name="button_2_link" value="{{ old('button_2_link', $slider->button_2_link) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $slider->order) }}">
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $slider->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Slider</button>
            </form>
        </div>
    </div>
</div>
@endsection
