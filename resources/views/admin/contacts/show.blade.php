@extends('admin.layouts.app')

@section('title', 'View Inquiry')
@section('page_title', 'Message Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa-solid fa-envelope-open-text text-warning me-2"></i> Inquiry from {{ $contact->name }}</span>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Messages
                </a>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4 g-3 border-bottom pb-4">
                    <div class="col-sm-6">
                        <small class="text-muted d-block text-uppercase fw-semibold">Sender Name</small>
                        <h5 class="mb-0 text-dark">{{ $contact->name }}</h5>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block text-uppercase fw-semibold">Date Received</small>
                        <div class="text-dark">{{ $contact->created_at->format('l, d F Y \a\t h:i A') }}</div>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block text-uppercase fw-semibold">Email Address</small>
                        <a href="mailto:{{ $contact->email }}" class="text-primary fs-6">{{ $contact->email }}</a>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block text-uppercase fw-semibold">Phone Number</small>
                        <div class="text-dark">{{ $contact->phone ?? 'Not provided' }}</div>
                    </div>
                    @if($contact->ip_address)
                        <div class="col-sm-6">
                            <small class="text-muted d-block text-uppercase fw-semibold">Sender IP</small>
                            <code class="text-dark">{{ $contact->ip_address }}</code>
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <small class="text-muted d-block text-uppercase fw-semibold mb-2">Message Body</small>
                    <div class="p-3 bg-light rounded border" style="white-space: pre-wrap; font-size: 15px; line-height: 1.6;">{{ $contact->message }}</div>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2">
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fa-solid fa-trash-can me-1"></i> Delete Message
                        </button>
                    </form>

                    <a href="mailto:{{ $contact->email }}?subject={{ urlencode('Re: Inquiry at Jay\'s Beauty') }}" class="btn btn-gold">
                        <i class="fa-solid fa-reply me-1"></i> Reply via Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
