@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-flex">
        <h2 class="h3 mb-0 text-gray-800">Home CTA Section (Knock Us Banner)</h2>
        <a href="{{ route('admin.home-cta.edit') }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit CTA Settings
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
                <i class="fas fa-bullhorn me-2"></i>Knock Us Section Display Configuration
            </h6>
        </div>
        <div class="card-body">
            @if($section)
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 180px;">Title:</th>
                                <td>{{ $section->title ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $section->description ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($section->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-header bg-light">
                                <span class="fw-bold">Thumbnail / Video Image</span>
                            </div>
                            <div class="card-body">
                                @if($section->image)
                                    <img src="{{ asset($section->image) }}" alt="CTA Image" class="img-thumbnail" style="max-height: 180px; object-fit: contain;">
                                @else
                                    <p class="text-muted mb-0">No image uploaded. Using default butterfly image.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted mb-0">No settings found. <a href="{{ route('admin.home-cta.edit') }}">Configure now</a>.</p>
            @endif
        </div>
    </div>
</div>
@endsection
