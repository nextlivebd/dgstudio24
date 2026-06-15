@extends('admin.layouts.app')

@push('styles')
<style>
    .premium-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    .premium-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .bg-gradient-primary { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); }
    .bg-gradient-success { background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%); }
    .bg-gradient-info { background: linear-gradient(135deg, #36b9cc 0%, #258391 100%); }
    .bg-gradient-warning { background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%); }
    .bg-gradient-danger { background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%); }
    .bg-gradient-dark { background: linear-gradient(135deg, #5a5c69 0%, #373840 100%); }
    
    .card-icon-bg {
        position: absolute;
        right: -10px;
        top: -10px;
        font-size: 5rem;
        opacity: 0.15;
        transform: rotate(-15deg);
        color: #fff;
    }
    .premium-table-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .premium-table-card .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        border-radius: 15px 15px 0 0;
        padding: 20px;
    }
    @media (max-width: 575.98px) {
        .premium-card .card-body {
            padding: 15px 10px !important;
        }
        .premium-card .text-uppercase {
            font-size: 0.7rem !important;
            letter-spacing: 0.5px !important;
        }
        .premium-card .h2 {
            font-size: 1.4rem !important;
        }
        .premium-card .card-icon-bg {
            font-size: 3rem !important;
            right: -5px;
            top: -5px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800 fw-bold">Dashboard Overview</h2>
        <div class="text-muted small d-none d-sm-block">
            <i class="fas fa-calendar-alt me-1"></i> {{ date('l, F j, Y') }}
        </div>
    </div>

    <!-- Traffic & Content Row -->
    <div class="row">
        <!-- Daily Traffic -->
        <div class="col-6 col-md-6 col-xl-4 mb-4">
            <div class="card premium-card bg-gradient-info text-white h-100">
                <div class="card-body position-relative">
                    <div class="text-uppercase mb-1 fw-bold text-white-50" style="letter-spacing: 1px; font-size: 0.8rem;">
                        Daily Visitors
                    </div>
                    <div class="h2 mb-0 fw-bold">{{ number_format($dailyTraffic) }}</div>
                    <i class="fas fa-chart-line card-icon-bg"></i>
                </div>
            </div>
        </div>

        <!-- Total Traffic -->
        <div class="col-6 col-md-6 col-xl-4 mb-4">
            <div class="card premium-card bg-gradient-primary text-white h-100">
                <div class="card-body position-relative">
                    <div class="text-uppercase mb-1 fw-bold text-white-50" style="letter-spacing: 1px; font-size: 0.8rem;">
                        Total Visitors
                    </div>
                    <div class="h2 mb-0 fw-bold">{{ number_format($totalTraffic) }}</div>
                    <i class="fas fa-users card-icon-bg"></i>
                </div>
            </div>
        </div>

        <!-- Total Blogs -->
        <div class="col-6 col-md-6 col-xl-4 mb-4">
            <div class="card premium-card bg-gradient-warning text-white h-100">
                <div class="card-body position-relative">
                    <div class="text-uppercase mb-1 fw-bold text-white-50" style="letter-spacing: 1px; font-size: 0.8rem;">
                        Published Blogs
                    </div>
                    <div class="h2 mb-0 fw-bold">{{ $totalBlogs }}</div>
                    <i class="fas fa-blog card-icon-bg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- General Stats Row -->
    <div class="row">
        <!-- Total Pages -->
        <div class="col-6 col-md-6 col-xl-4 mb-4">
            <div class="card premium-card bg-gradient-dark text-white h-100">
                <div class="card-body position-relative">
                    <div class="text-uppercase mb-1 fw-bold text-white-50" style="letter-spacing: 1px; font-size: 0.8rem;">
                        Total Pages
                    </div>
                    <div class="h2 mb-0 fw-bold">{{ $totalPages }}</div>
                    <i class="fas fa-file-alt card-icon-bg"></i>
                </div>
            </div>
        </div>

        <!-- Total Inquiries -->
        <div class="col-6 col-md-6 col-xl-4 mb-4">
            <div class="card premium-card bg-gradient-success text-white h-100">
                <div class="card-body position-relative">
                    <div class="text-uppercase mb-1 fw-bold text-white-50" style="letter-spacing: 1px; font-size: 0.8rem;">
                        Total Inquiries
                    </div>
                    <div class="h2 mb-0 fw-bold">{{ $totalContacts }}</div>
                    <i class="fas fa-envelope-open-text card-icon-bg"></i>
                </div>
            </div>
        </div>
        
        <!-- Site Status -->
        <div class="col-6 col-md-6 col-xl-4 mb-4">
            <div class="card premium-card bg-gradient-danger text-white h-100">
                <div class="card-body position-relative">
                    <div class="text-uppercase mb-1 fw-bold text-white-50" style="letter-spacing: 1px; font-size: 0.8rem;">
                        Site Status
                    </div>
                    <div class="h2 mb-0 fw-bold d-flex align-items-center">
                        <span class="badge bg-white text-danger fs-6 px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-circle text-success me-1" style="font-size: 10px;"></i> Online
                        </span>
                    </div>
                    <i class="fas fa-globe card-icon-bg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Contacts Table -->
    <div class="row mt-2">
        <div class="col-lg-12 mb-4">
            <div class="card premium-table-card h-100">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-dark">Recent Inquiries</h5>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th class="ps-4 border-0">Name</th>
                                    <th class="border-0">Email</th>
                                    <th class="border-0">Service Required</th>
                                    <th class="border-0 text-end pe-4">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentContacts as $contact)
                                <tr>
                                    <td class="ps-4 py-3 fw-medium text-dark">{{ $contact->name }}</td>
                                    <td><a href="mailto:{{ $contact->email }}" class="text-decoration-none text-primary">{{ $contact->email }}</a></td>
                                    <td>
                                        @if($contact->services)
                                            <span class="badge bg-light text-dark border">{{ $contact->services }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4 text-muted small">{{ $contact->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        <i class="fas fa-inbox fa-3x mb-3 text-light"></i>
                                        <p class="mb-0">No recent inquiries found.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
