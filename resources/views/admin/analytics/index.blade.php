@extends('admin.layouts.app')

@section('title', 'Analytics & Visitor Intelligence')
@section('page_title', 'Analytics & Visitor Tracking')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">Traffic & Visitor Analytics</h4>
        <p class="text-muted small mb-0">De-duplicated unique visitor tracking, browser/device breakdown & page insights.</p>
    </div>
    <div class="btn-group shadow-sm">
        <a href="{{ route('admin.analytics', ['range' => 7]) }}" class="btn btn-sm {{ $daysRange == 7 ? 'btn-dark' : 'btn-outline-secondary' }}">Last 7 Days</a>
        <a href="{{ route('admin.analytics', ['range' => 14]) }}" class="btn btn-sm {{ $daysRange == 14 ? 'btn-dark' : 'btn-outline-secondary' }}">Last 14 Days</a>
        <a href="{{ route('admin.analytics', ['range' => 30]) }}" class="btn btn-sm {{ $daysRange == 30 ? 'btn-dark' : 'btn-outline-secondary' }}">Last 30 Days</a>
    </div>
</div>

<!-- KPI Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="kpi-card">
            <div class="kpi-icon kpi-gold">
                <i class="fa-solid fa-network-wired"></i>
            </div>
            <div>
                <span class="text-muted small fw-semibold text-uppercase">Unique IP Addresses</span>
                <h3 class="mb-0 fw-bold">{{ number_format($totalUniqueIps) }}</h3>
                <small class="text-muted">Distinct individual visitors</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card">
            <div class="kpi-icon kpi-blue">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div>
                <span class="text-muted small fw-semibold text-uppercase">Total Page Hits</span>
                <h3 class="mb-0 fw-bold">{{ number_format($totalPageHits) }}</h3>
                <small class="text-muted">Across all pages & services</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="kpi-card">
            <div class="kpi-icon kpi-green">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <span class="text-muted small fw-semibold text-uppercase">Duplicate Filter</span>
                <h3 class="mb-0 fw-bold text-success">Active</h3>
                <small class="text-muted">1 visit per IP/Day (no repeat spam)</small>
            </div>
        </div>
    </div>
</div>

<!-- Interactive Charts Section -->
<div class="row g-4 mb-4">
    <!-- Daily Trend Line Chart -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa-solid fa-chart-line text-warning me-2"></i> Visitor Traffic Trend (Last {{ $daysRange }} Days)</span>
            </div>
            <div class="card-body">
                <canvas id="trafficTrendChart" height="130"></canvas>
            </div>
        </div>
    </div>

    <!-- Browser Breakdown Doughnut Chart -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header fw-bold">
                <i class="fa-brands fa-chrome text-warning me-2"></i> Browser Breakdown
            </div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div style="width: 230px; height: 230px;">
                    <canvas id="browserChart"></canvas>
                </div>
                <div class="mt-3 w-100">
                    <ul class="list-group list-group-flush small">
                        @foreach($browsers as $b)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                                <span><i class="fa-solid fa-circle text-warning me-1" style="font-size: 8px;"></i> {{ $b->browser ?? 'Unknown' }}</span>
                                <span class="badge bg-light text-dark border">{{ $b->count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Top Visited Pages Bar Chart -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header fw-bold">
                <i class="fa-solid fa-file-lines text-warning me-2"></i> Most Visited Pages
            </div>
            <div class="card-body">
                <canvas id="topPagesChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <!-- Device & OS Breakdown -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header fw-bold">
                <i class="fa-solid fa-mobile-screen-button text-warning me-2"></i> Device & OS Distribution
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-sm-6 text-center">
                        <div style="width: 170px; height: 170px; margin: 0 auto;">
                            <canvas id="deviceChart"></canvas>
                        </div>
                        <span class="small text-muted d-block mt-2">Device Type</span>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="small fw-bold text-uppercase text-muted mb-2">Operating Systems:</h6>
                        <ul class="list-group list-group-flush small">
                            @foreach($operatingSystems as $os)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                                    <span>{{ $os->os ?? 'Other' }}</span>
                                    <span class="badge bg-secondary">{{ $os->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Visitors Logs Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-bold"><i class="fa-solid fa-table-list text-warning me-2"></i> Detailed Visitor Logs (De-duplicated)</span>
        <span class="badge bg-light text-dark border">{{ $visitorsList->total() }} Total Recorded Visits</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>IP Address</th>
                        <th>Browser</th>
                        <th>OS & Device</th>
                        <th>Latest Page</th>
                        <th>Day Visits</th>
                        <th>Date</th>
                        <th>Last Active</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitorsList as $visitor)
                        <tr>
                            <td>
                                <span class="badge bg-dark font-monospace">{{ $visitor->ip_address }}</span>
                            </td>
                            <td>
                                <span class="fw-semibold">{{ $visitor->browser }}</span>
                            </td>
                            <td>
                                <div><small class="text-dark">{{ $visitor->os }}</small></div>
                                @if($visitor->device === 'Mobile')
                                    <span class="badge bg-info-subtle text-info border" style="font-size: 10px;"><i class="fa-solid fa-mobile-screen"></i> Mobile</span>
                                @elseif($visitor->device === 'Tablet')
                                    <span class="badge bg-warning-subtle text-warning border" style="font-size: 10px;"><i class="fa-solid fa-tablet-screen-button"></i> Tablet</span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border" style="font-size: 10px;"><i class="fa-solid fa-desktop"></i> Desktop</span>
                                @endif
                            </td>
                            <td>
                                @if($visitor->pageViews->isNotEmpty())
                                    <span class="badge bg-light text-primary border">
                                        {{ $visitor->pageViews->first()->page_name ?? $visitor->pageViews->first()->url }}
                                    </span>
                                    <div class="text-muted text-truncate" style="font-size: 11px; max-width: 180px;">{{ $visitor->pageViews->first()->url }}</div>
                                @else
                                    <span class="text-muted small">Home</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border fw-bold">{{ $visitor->views_count }}</span>
                            </td>
                            <td>
                                <span class="small">{{ $visitor->visit_date ? $visitor->visit_date->format('d M, Y') : $visitor->created_at->format('d M, Y') }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $visitor->last_activity ? $visitor->last_activity->format('h:i A') : $visitor->created_at->format('h:i A') }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-chart-line fa-3x mb-3 text-secondary"></i>
                                <p class="mb-0">No visitor records yet. When users visit your website, their data will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($visitorsList->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $visitorsList->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // 1. Traffic Trend Line Chart
    new Chart(document.getElementById('trafficTrendChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($chartDates) !!},
            datasets: [
                {
                    label: 'Unique Visitors',
                    data: {!! json_encode($chartVisitors) !!},
                    borderColor: '#c59d5f',
                    backgroundColor: 'rgba(197, 157, 95, 0.15)',
                    tension: 0.35,
                    fill: true,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#c59d5f'
                },
                {
                    label: 'Page Views',
                    data: {!! json_encode($chartPageViews) !!},
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.05)',
                    tension: 0.35,
                    fill: true,
                    borderWidth: 2,
                    pointBackgroundColor: '#0d6efd'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 2. Browser Doughnut Chart
    new Chart(document.getElementById('browserChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($browsers->pluck('browser')) !!},
            datasets: [{
                data: {!! json_encode($browsers->pluck('count')) !!},
                backgroundColor: ['#c59d5f', '#0d6efd', '#198754', '#ffc107', '#6f42c1', '#6c757d'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // 3. Top Visited Pages Bar Chart
    new Chart(document.getElementById('topPagesChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($topPages->map(function($p) { return $p->page_name ?: $p->url; })) !!},
            datasets: [{
                label: 'Page Views',
                data: {!! json_encode($topPages->pluck('total')) !!},
                backgroundColor: '#c59d5f',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 4. Device Pie Chart
    new Chart(document.getElementById('deviceChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($devices->pluck('device')) !!},
            datasets: [{
                data: {!! json_encode($devices->pluck('count')) !!},
                backgroundColor: ['#198754', '#0d6efd', '#ffc107'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush
