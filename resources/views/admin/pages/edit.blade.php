@extends('admin.layouts.app')

@push('styles')
<!-- Include Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<!-- Include Frontend CSS for styling in editor (excluding Bootstrap to avoid Admin layout conflict) -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/themify-icons.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flaticon.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/rs6.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/prettyPhoto.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/shortcodes.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}" />

<style>
    /* Clean text alignment and styles in the Summernote editor */
    .note-editable {
        background: #fff !important;
        color: #222 !important;
        text-align: left !important;
        font-family: 'Inter', sans-serif;
    }
</style>
@endpush

@section('content')


<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2>Edit Page: {{ $page->title ?? ucwords(str_replace('-', ' ', $page->slug)) }}</h2>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Back to List</a>
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

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Page Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $page->title ?? ucwords(str_replace('-', ' ', $page->slug))) }}" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug (URL)</label>
                    <input type="text" class="form-control" id="slug" value="{{ $page->slug }}" disabled readonly>
                    <small class="text-muted">The URL slug cannot be changed to prevent breaking links.</small>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label for="summernote" class="form-label mb-0">Page Content</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="toggleEditor" checked>
                            <label class="form-check-label" for="toggleEditor">Use Rich Text Editor (Summernote)</label>
                        </div>
                    </div>
                    <textarea id="summernote" name="content" class="form-control" rows="15">{{ old('content', $page->content) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Include Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- Include Frontend Layout & JS components (excluding jQuery/Bootstrap to avoid conflicts) -->
<script src="{{ asset('frontend/js/tether.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.easing.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-waypoints.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-validate.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('frontend/js/numinate.min6959.js') }}"></script>
<script src="{{ asset('frontend/js/lazysizes.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/revolution.tools.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/rs6.min.js') }}"></script>

<script>
    $(document).ready(function() {
        function initSummernote() {
            $('#summernote').summernote({
                placeholder: 'Write your page content here...',
                tabsize: 2,
                height: 500,
                codeviewFilter: false,
                codeviewIframeFilter: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }

        // Initialize editor
        initSummernote();

        // Handle toggling of Summernote Editor
        $('#toggleEditor').on('change', function() {
            if ($(this).is(':checked')) {
                initSummernote();
            } else {
                $('#summernote').summernote('destroy');
            }
        });
    });
</script>
@endpush
