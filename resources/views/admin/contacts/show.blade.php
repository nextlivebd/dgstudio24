@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Inquiry Details</h2>
        <div>
            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger shadow-sm me-2" onclick="return confirm('Are you sure you want to delete this message?')">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-arrow-left"></i> Back to Inbox
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Message -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex align-items-center">
                    <div class="avatar me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-weight: bold; font-size: 1.5rem;">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="mb-0 font-weight-bold text-dark">{{ $contact->name }}</h5>
                        <div class="text-muted small">
                            <i class="fas fa-envelope me-1"></i> <a href="mailto:{{ $contact->email }}" class="text-decoration-none">{{ $contact->email }}</a> &bull; 
                            <i class="fas fa-clock me-1"></i> {{ $contact->created_at->format('F d, Y h:i A') }} ({{ $contact->created_at->diffForHumans() }})
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 bg-light">
                    <h6 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Message:</h6>
                    <p class="text-dark" style="white-space: pre-wrap; font-size: 1.05rem; line-height: 1.6;">{{ $contact->message }}</p>
                </div>
                <div class="card-footer bg-white py-3">
                    <a href="mailto:{{ $contact->email }}" class="btn btn-outline-primary">
                        <i class="fas fa-reply"></i> Reply via Email
                    </a>
                </div>
            </div>
        </div>

        <!-- Sender Details -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4 position-sticky" style="top: 20px;">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sender Information</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 border-top-0">
                            <span class="text-muted d-block small">Name</span>
                            <span class="font-weight-bold text-dark">{{ $contact->name }}</span>
                        </li>
                        <li class="list-group-item px-0">
                            <span class="text-muted d-block small">Email</span>
                            <a href="mailto:{{ $contact->email }}" class="text-decoration-none">{{ $contact->email }}</a>
                        </li>
                        <li class="list-group-item px-0">
                            <span class="text-muted d-block small">Phone</span>
                            <span class="font-weight-bold text-dark">{{ $contact->phone ?? 'Not provided' }}</span>
                        </li>
                        <li class="list-group-item px-0">
                            <span class="text-muted d-block small">Business Name</span>
                            <span class="font-weight-bold text-dark">{{ $contact->businessname ?? 'Not provided' }}</span>
                        </li>
                        <li class="list-group-item px-0">
                            <span class="text-muted d-block small">Services Requested</span>
                            <span class="font-weight-bold text-dark">{{ $contact->services ?? 'Not specified' }}</span>
                        </li>
                        <li class="list-group-item px-0 border-bottom-0">
                            <span class="text-muted d-block small">Website</span>
                            @if($contact->website)
                                <a href="{{ Str::startsWith($contact->website, 'http') ? $contact->website : 'http://'.$contact->website }}" target="_blank" class="text-decoration-none">
                                    {{ $contact->website }} <i class="fas fa-external-link-alt small"></i>
                                </a>
                            @else
                                <span class="font-weight-bold text-dark">Not provided</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
