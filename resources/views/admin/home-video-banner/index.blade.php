@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Home Video Banner Section</h2>
        <a href="{{ route('admin.home-video-banner.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Settings
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-film me-2"></i>Video Banner / Second Banner Configuration
            </h6>
        </div>
        <div class="card-body">
            @if($banner)
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 200px;">Title:</th>
                                <td>{{ $banner->title ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Title Highlight:</th>
                                <td><span class="badge bg-warning text-dark">{{ $banner->title_highlight ?? '—' }}</span></td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $banner->description ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Button Text:</th>
                                <td>{{ $banner->btn_text ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Button URL:</th>
                                <td><code>{{ $banner->btn_url ?? '—' }}</code></td>
                            </tr>
                            <tr>
                                <th>Video URL:</th>
                                <td>
                                    @if($banner->video_url)
                                        <a href="{{ $banner->video_url }}" target="_blank" class="text-break">
                                            <i class="fas fa-external-link-alt me-1"></i>{{ $banner->video_url }}
                                        </a>
                                    @else
                                        <span class="text-muted">No video URL (logo or nothing will be shown)</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Logo Display:</th>
                                <td>
                                    @if($banner->logo_source === 'site_logo')
                                        <span class="badge bg-info">Use Site Logo</span>
                                    @elseif($banner->logo_source === 'custom_logo')
                                        <span class="badge bg-secondary">Custom Logo</span>
                                    @else
                                        <span class="badge bg-light text-dark">None</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($banner->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <!-- Background Image Preview -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <span class="fw-bold">Background Image</span>
                            </div>
                            <div class="card-body text-center">
                                @if($banner->background_image)
                                    <img src="{{ asset($banner->background_image) }}" alt="Background" class="img-thumbnail mb-2" style="max-height: 120px; object-fit: cover; width: 100%;">
                                    <form action="{{ route('admin.home-video-banner.remove-background') }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove background image?')">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </form>
                                @else
                                    <p class="text-muted mb-0"><i class="fas fa-image fa-2x d-block mb-2 text-secondary"></i>Using default CSS background</p>
                                @endif
                            </div>
                        </div>

                        <!-- Custom Logo Preview -->
                        @if($banner->logo_source === 'custom_logo' && $banner->custom_logo)
                        <div class="card">
                            <div class="card-header bg-light">
                                <span class="fw-bold">Custom Logo</span>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ asset($banner->custom_logo) }}" alt="Custom Logo" class="img-thumbnail mb-2" style="max-height: 80px; object-fit: contain;">
                                <form action="{{ route('admin.home-video-banner.remove-logo') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove custom logo?')">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-muted mb-0">No settings found. <a href="{{ route('admin.home-video-banner.edit') }}">Configure now</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection
