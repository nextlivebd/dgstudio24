@extends('admin.layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--multiple { min-height: 38px; border: 1px solid #dee2e6; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Add New Blog</h2>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Blogs
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">General Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Custom Slug (Leave empty to auto-generate)</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea id="summernote" name="content">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">SEO Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="e.g. blog, tech, news">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Publishing</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status') == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish Date (Optional)</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}">
                        </div>

                        <div class="mb-3 form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Mark as Featured</label>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories & Media</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="categories" class="form-label">Categories <span class="text-danger">*</span></label>
                            <select class="form-select select2-multiple" id="categories" name="categories[]" multiple="multiple" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (collect(old('categories'))->contains($category->id)) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Image (Includes webp)</label>
                            <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-lg shadow-sm">Save Blog Post</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: "Select categories",
            allowClear: true
        });

        $('#summernote').summernote({
            placeholder: 'Write your blog content here...',
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    uploadImage(files[0]);
                }
            }
        });

        function uploadImage(file) {
            let data = new FormData();
            data.append("file", file);
            data.append("_token", "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('admin.blogs.uploadImage') }}",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                success: function(response) {
                    $('#summernote').summernote('insertImage', response.url);
                },
                error: function(data) {
                    console.log(data);
                    alert("Error uploading image. Make sure it's an accepted format (including webp).");
                }
            });
        }
        
        // Auto-generate slug from title if slug is empty
        $('#title').on('keyup', function() {
            if ($('#slug').val() === '') {
                let title = $(this).val();
                let slug = title.toLowerCase().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
                $('#slug').attr('placeholder', slug);
            }
        });
    });
</script>
@endpush
