@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')
@section('page_title', 'Contact Messages & Inquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">Customer Inquiries</h4>
        <p class="text-muted small mb-0">Messages submitted through the website contact form.</p>
    </div>
    @if($unreadCount > 0)
        <span class="badge bg-danger fs-6 px-3 py-2">
            <i class="fa-solid fa-bell me-1"></i> {{ $unreadCount }} Unread {{ Str::plural('Message', $unreadCount) }}
        </span>
    @endif
</div>

<div class="card">
    <div class="card-header bg-white py-3">
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, phone or message..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Messages</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread Messages Only</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read Messages</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-secondary w-100">Filter</button>
            </div>
            @if(request()->hasAny(['search', 'status']))
                <div class="col-md-2">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-link text-muted text-decoration-none">Reset</a>
                </div>
            @endif
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Status</th>
                        <th>Sender Name</th>
                        <th>Contact Info</th>
                        <th>Message Preview</th>
                        <th>Received Date</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr class="{{ $msg->status === 'unread' ? 'table-warning-subtle fw-semibold' : '' }}">
                            <td>
                                @if($msg->status === 'unread')
                                    <span class="badge bg-danger"><i class="fa-solid fa-envelope me-1"></i> New</span>
                                @else
                                    <span class="badge bg-light text-muted border"><i class="fa-solid fa-envelope-open me-1"></i> Read</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-dark">{{ $msg->name }}</div>
                            </td>
                            <td>
                                <div><a href="mailto:{{ $msg->email }}" class="text-decoration-none text-primary">{{ $msg->email }}</a></div>
                                @if($msg->phone)
                                    <div><small class="text-muted"><i class="fa-solid fa-phone me-1"></i> {{ $msg->phone }}</small></div>
                                @endif
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 320px;">
                                    {{ $msg->message }}
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">{{ $msg->created_at->format('d M, Y h:i A') }}</small>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.contacts.show', $msg->id) }}" class="btn btn-sm btn-outline-primary" title="View & Reply">
                                    <i class="fa-solid fa-eye"></i> View
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox fa-3x mb-3 text-secondary"></i>
                                <h5>No Messages Found</h5>
                                <p class="mb-0">When visitors fill out the contact form on your website, inquiries will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($messages->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
