@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Site Settings</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>General Information</h5>
                                <hr>
                                
                                <div class="mb-3">
                                    <label class="form-label">Site Title</label>
                                    <input type="text" name="site_title" class="form-control" value="{{ get_setting('site_title', 'Global Graphic Giant') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (SEO)</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ get_setting('meta_title', 'Global Graphic Giant – A Complete IT Solution') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (SEO)</label>
                                    <textarea name="meta_description" class="form-control" rows="3">{{ get_setting('meta_description', 'Global Graphic Giant – A Complete IT Solution') }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5>Media & Branding</h5>
                                <hr>
                                
                                <div class="mb-3">
                                    <label class="form-label d-block">Site Logo</label>
                                    @if(get_setting('logo'))
                                        <img src="{{ asset(get_setting('logo')) }}" alt="Logo" class="img-thumbnail mb-2" style="max-height: 80px;">
                                    @endif
                                    <input type="file" name="logo" class="form-control" accept="image/*">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label d-block">Favicon</label>
                                    @if(get_setting('favicon'))
                                        <img src="{{ asset(get_setting('favicon')) }}" alt="Favicon" class="img-thumbnail mb-2" style="max-height: 40px;">
                                    @endif
                                    <input type="file" name="favicon" class="form-control" accept="image/*">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label d-block">Meta OG Image (For Social Sharing)</label>
                                    @if(get_setting('og_image'))
                                        <img src="{{ asset(get_setting('og_image')) }}" alt="OG Image" class="img-thumbnail mb-2" style="max-height: 100px;">
                                    @endif
                                    <input type="file" name="og_image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-5">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
