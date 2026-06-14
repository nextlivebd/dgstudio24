@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Inbox</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light text-muted">
                        <tr>
                            <th class="ps-4 border-bottom-0">Sender</th>
                            <th class="border-bottom-0">Email / Phone</th>
                            <th class="border-bottom-0">Subject / Services</th>
                            <th class="border-bottom-0">Date</th>
                            <th class="text-end pe-4 border-bottom-0">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr class="{{ !$contact->is_read ? 'bg-light font-weight-bold' : '' }}" style="{{ !$contact->is_read ? 'font-weight: 700;' : '' }}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: bold;">
                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-dark">{{ $contact->name }}</div>
                                        <div class="text-muted small" style="{{ !$contact->is_read ? 'font-weight: 600;' : 'font-weight: normal;' }}">{{ $contact->businessname ?? 'No Business' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div><a href="mailto:{{ $contact->email }}" class="text-decoration-none text-dark">{{ $contact->email }}</a></div>
                                <div class="text-muted small" style="{{ !$contact->is_read ? 'font-weight: 600;' : 'font-weight: normal;' }}">{{ $contact->phone ?? 'N/A' }}</div>
                            </td>
                            <td>
                                <div class="text-dark text-truncate" style="max-width: 250px;">{{ $contact->services ?? 'General Inquiry' }}</div>
                                <div class="text-muted small text-truncate" style="max-width: 250px; {{ !$contact->is_read ? 'font-weight: 600;' : 'font-weight: normal;' }}">{{ Str::limit($contact->message, 50) }}</div>
                            </td>
                            <td>
                                <span class="{{ !$contact->is_read ? 'text-primary' : 'text-muted' }}">{{ $contact->created_at->diffForHumans() }}</span>
                                <div class="text-muted small" style="{{ !$contact->is_read ? 'font-weight: 600;' : 'font-weight: normal;' }}">{{ $contact->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-outline-primary shadow-sm" title="View Message">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" onclick="return confirm('Are you sure you want to delete this message?')" title="Delete Message">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <div class="mb-3"><i class="fas fa-inbox fa-3x text-light"></i></div>
                                <h5>Your inbox is empty</h5>
                                <p>No contact inquiries have been received yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($contacts->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $contacts->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa !important;
        transition: background-color 0.2s ease-in-out;
    }
    .avatar {
        font-size: 1.2rem;
    }
</style>
@endsection
