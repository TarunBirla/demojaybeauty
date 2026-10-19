@extends('admin.layouts.app')

@section('title', 'Manage Blogs')
@section('page_title', 'Blog Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">All Blogs</h4>
        <p class="text-muted small mb-0">Create, edit, and control visibility of your beauty blog posts.</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-gold">
        <i class="fa-solid fa-plus me-1"></i> Add New Blog
    </a>
</div>

<div class="card">
    <div class="card-header bg-white py-3">
        <form method="GET" action="{{ route('admin.blogs.index') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active (Visible on Frontend)</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive (Hidden)</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-secondary w-100">Filter</button>
            </div>
            @if(request()->hasAny(['search', 'status']))
                <div class="col-md-2">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-link text-muted text-decoration-none">Reset</a>
                </div>
            @endif
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Blog Title</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Created Date</th>
                        <th class="text-end" style="width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr>
                            <td>
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="rounded" style="width: 60px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border" style="width: 60px; height: 50px;">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $blog->title }}</div>
                                <small class="text-muted"><a href="{{ route('blog.detail', $blog->slug) }}" target="_blank" class="text-decoration-none text-muted"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i>/blog/{{ $blog->slug }}</a></small>
                            </td>
                            <td>
                                @if($blog->status === 'active')
                                    <span class="badge bg-success-subtle text-success border px-2 py-1"><i class="fa-solid fa-circle-check me-1"></i> Active</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border px-2 py-1"><i class="fa-solid fa-eye-slash me-1"></i> Inactive</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $blog->views_count }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $blog->created_at->format('d M, Y') }}</small>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.blogs.toggle', $blog->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $blog->status === 'active' ? 'btn-outline-warning' : 'btn-outline-success' }}" title="Toggle Status">
                                        <i class="fa-solid {{ $blog->status === 'active' ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
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
                                <i class="fa-solid fa-newspaper fa-3x mb-3 text-secondary"></i>
                                <h5>No Blog Posts Found</h5>
                                <p class="mb-3">Get started by creating your first beauty article!</p>
                                <a href="{{ route('admin.blogs.create') }}" class="btn btn-gold btn-sm"><i class="fa-solid fa-plus me-1"></i> Create Blog</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($blogs->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
@endsection
