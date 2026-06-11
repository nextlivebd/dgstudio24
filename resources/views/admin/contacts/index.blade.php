@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Contact Inquiries</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email & Phone</th>
                            <th>Business / Services</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $contact->name }}</strong>
                            </td>
                            <td>
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a><br>
                                <small class="text-muted">{{ $contact->phone ?? 'N/A' }}</small>
                            </td>
                            <td>
                                {{ $contact->businessname ?? 'N/A' }}<br>
                                <small class="text-muted">{{ $contact->services ?? 'N/A' }}</small><br>
                                @if($contact->website)
                                    <a href="{{ Str::startsWith($contact->website, 'http') ? $contact->website : 'http://'.$contact->website }}" target="_blank" style="font-size: 12px;">Visit Site</a>
                                @endif
                            </td>
                            <td>
                                <div style="max-height: 80px; overflow-y: auto; font-size: 0.9rem;">
                                    {{ $contact->message }}
                                </div>
                            </td>
                            <td>{{ $contact->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No contact inquiries found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
