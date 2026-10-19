@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="kpi-card">
            <div class="kpi-icon kpi-gold">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span class="text-muted small fw-semibold text-uppercase">Total Visitors</span>
                <h3 class="mb-0 fw-bold">{{ number_format($totalVisitors) }}</h3>
                <small class="text-success fw-semibold"><i class="fa-solid fa-calendar-day"></i> {{ $todayVisitors }} today</small>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="kpi-card">
            <div class="kpi-icon kpi-blue">
                <i class="fa-solid fa-eye"></i>
            </div>
            <div>
                <span class="text-muted small fw-semibold text-uppercase">Total Page Views</span>
                <h3 class="mb-0 fw-bold">{{ number_format($totalPageViews) }}</h3>
                <small class="text-primary fw-semibold"><i class="fa-solid fa-bolt"></i> {{ $todayPageViews }} views today</small>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="kpi-card">
            <div class="kpi-icon kpi-green">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div>
                <span class="text-muted small fw-semibold text-uppercase">Published Blogs</span>
                <h3 class="mb-0 fw-bold">{{ $totalBlogs }}</h3>
                <small class="text-success fw-semibold">{{ $activeBlogs }} Active</small>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="kpi-card">
            <div class="kpi-icon kpi-purple">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
                <span class="text-muted small fw-semibold text-uppercase">Contact Inquiries</span>
                <h3 class="mb-0 fw-bold">{{ $totalMessages }}</h3>
                <small class="text-danger fw-semibold">{{ $unreadMessages }} Unread</small>
            </div>
        </div>
    </div>
</div>

<!-- 7 Days Traffic Trend Chart -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-chart-area me-2 text-warning"></i> 7 Days Traffic Overview</span>
                <a href="{{ route('admin.analytics') }}" class="btn btn-sm btn-outline-secondary">Detailed Analytics</a>
            </div>
            <div class="card-body">
                <canvas id="overviewChart" height="130"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <span><i class="fa-solid fa-bolt me-2 text-warning"></i> Quick Actions</span>
            </div>
            <div class="card-body d-flex flex-column gap-3 justify-content-center">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-gold p-3 text-start d-flex align-items-center gap-3">
                    <i class="fa-solid fa-plus-circle fa-2x"></i>
                    <div>
                        <div class="fw-bold">Add New Blog Post</div>
                        <small class="text-white-50">Publish articles with rich media</small>
                    </div>
                </a>
                <a href="{{ route('admin.analytics') }}" class="btn btn-outline-dark p-3 text-start d-flex align-items-center gap-3">
                    <i class="fa-solid fa-chart-pie fa-2x text-warning"></i>
                    <div>
                        <div class="fw-bold">View Visitors & Graphs</div>
                        <small class="text-muted">Explore IP tracking, devices & pages</small>
                    </div>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-dark p-3 text-start d-flex align-items-center gap-3">
                    <i class="fa-solid fa-inbox fa-2x text-primary"></i>
                    <div>
                        <div class="fw-bold">View Inquiries ({{ $unreadMessages }} New)</div>
                        <small class="text-muted">Respond to contact form submissions</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Visitors and Messages -->
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-user-clock me-2 text-warning"></i> Recent Live Visitors</span>
                <a href="{{ route('admin.analytics') }}" class="text-decoration-none small text-warning fw-semibold">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>IP Address</th>
                                <th>Browser / OS</th>
                                <th>Device</th>
                                <th>Hits</th>
                                <th>Last Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVisitors as $v)
                                <tr>
                                    <td>
                                        <code class="text-dark fw-bold">{{ $v->ip_address }}</code>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold">{{ $v->browser }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $v->os }}</div>
                                    </td>
                                    <td>
                                        @if($v->device === 'Mobile')
                                            <span class="badge bg-info-subtle text-info border"><i class="fa-solid fa-mobile-screen"></i> Mobile</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary border"><i class="fa-solid fa-desktop"></i> Desktop</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $v->views_count }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $v->last_activity ? $v->last_activity->diffForHumans() : $v->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No visitors tracked yet. Visit the public site to record traffic.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-envelope-open-text me-2 text-warning"></i> Recent Contact Inquiries</span>
                <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none small text-warning fw-semibold">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($recentMessages as $msg)
                        <li class="list-group-item p-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong class="text-dark">{{ $msg->name }}</strong>
                                <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="small text-muted mb-1">
                                <i class="fa-solid fa-envelope me-1"></i> {{ $msg->email }}
                                @if($msg->phone) | <i class="fa-solid fa-phone me-1"></i> {{ $msg->phone }} @endif
                            </div>
                            <p class="mb-0 text-secondary small text-truncate">{{ $msg->message }}</p>
                        </li>
                    @empty
                        <li class="list-group-item text-center py-4 text-muted">No messages received yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('overviewChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($days) !!},
            datasets: [
                {
                    label: 'Unique Visitors',
                    data: {!! json_encode($visitorCounts) !!},
                    borderColor: '#c59d5f',
                    backgroundColor: 'rgba(197, 157, 95, 0.1)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 2,
                    pointBackgroundColor: '#c59d5f'
                },
                {
                    label: 'Page Views',
                    data: {!! json_encode($pageViewCounts) !!},
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.05)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 2,
                    pointBackgroundColor: '#0d6efd'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endpush
