@extends('admin.layouts.app')

@section('title', 'Analytics & Visitor Intelligence')
@section('page_title', 'Analytics & Visitor Tracking')

@push('styles')
<style>
    .journey-timeline {
        position: relative;
        padding-left: 38px;
    }
    .journey-timeline::before {
        content: '';
        position: absolute;
        top: 16px;
        bottom: 16px;
        left: 17px;
        width: 2px;
        background: #e2e8f0;
    }
    .journey-step-item {
        position: relative;
        margin-bottom: 20px;
    }
    .journey-step-item:last-child {
        margin-bottom: 0;
    }
    .journey-step-badge {
        position: absolute;
        left: -38px;
        top: 2px;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #c59d5f;
        color: #1e1e24;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.06);
        z-index: 2;
    }
    .journey-step-item:first-child .journey-step-badge {
        background: #198754;
        border-color: #198754;
        color: #ffffff;
    }
    .journey-step-item:last-child:not(:first-child) .journey-step-badge {
        background: #c59d5f;
        border-color: #c59d5f;
        color: #ffffff;
    }
    .journey-step-card {
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 12px;
        padding: 14px 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .journey-step-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .journey-page-title {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
    }
    .journey-url-link {
        font-size: 12px;
        color: #64748b;
        word-break: break-all;
        text-decoration: none;
    }
    .journey-url-link:hover {
        color: #0d6efd;
        text-decoration: underline;
    }
    .journey-meta-tag {
        font-size: 11px;
        background: #f1f5f9;
        color: #475569;
        padding: 3px 8px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
</style>
@endpush

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
                        <th class="text-end" style="width: 150px;">Action</th>
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
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-dark" onclick="openVisitorJourney({{ $visitor->id }})" title="View complete path/journey of this IP">
                                    <i class="fa-solid fa-route text-warning me-1"></i> View Journey
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
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
        <div class="card-footer bg-white border-top py-3">
            {{ $visitorsList->links() }}
        </div>
    @endif
</div>

<!-- Visitor Journey Modal -->
<div class="modal fade" id="visitorJourneyModal" tabindex="-1" aria-labelledby="visitorJourneyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #18181c 0%, #2b2b36 100%); border-bottom: 2px solid #c59d5f;">
                <div>
                    <h5 class="modal-title fw-bold mb-1" id="visitorJourneyModalLabel">
                        <i class="fa-solid fa-route text-warning me-2"></i> Visitor Navigation Journey
                    </h5>
                    <small class="text-white-50">Complete sequence of pages visited by this visitor / IP</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4" style="background-color: #fdfaf7;">
                <!-- Visitor Info Summary Strip -->
                <div class="p-3 bg-white rounded border shadow-sm mb-4">
                    <div class="row g-3 align-items-center text-center text-sm-start">
                        <div class="col-sm-3 border-end">
                            <span class="text-muted small d-block">IP Address</span>
                            <span class="badge bg-dark font-monospace fs-6" id="modalVisitorIp">-</span>
                        </div>
                        <div class="col-sm-3 border-end">
                            <span class="text-muted small d-block">Browser & System</span>
                            <div class="fw-semibold small text-dark" id="modalVisitorBrowser">-</div>
                        </div>
                        <div class="col-sm-3 border-end">
                            <span class="text-muted small d-block">Device</span>
                            <div id="modalVisitorDevice">-</div>
                        </div>
                        <div class="col-sm-3">
                            <span class="text-muted small d-block">Total Pages</span>
                            <span class="badge bg-success-subtle text-success border fw-bold fs-6" id="modalTotalPages">0</span>
                        </div>
                    </div>
                </div>

                <!-- Loading Spinner -->
                <div id="journeyLoadingSpinner" class="text-center py-5">
                    <div class="spinner-border text-warning" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading journey...</span>
                    </div>
                    <div class="mt-3 text-muted fw-semibold">Fetching visitor navigation steps...</div>
                </div>

                <!-- Empty State -->
                <div id="journeyEmptyState" class="text-center py-5 d-none">
                    <i class="fa-solid fa-map-location-dot fa-3x text-muted mb-3"></i>
                    <h6 class="text-muted">No navigation steps recorded yet for this session.</h6>
                </div>

                <!-- Timeline Container -->
                <div id="journeyTimelineContainer" class="d-none">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="fa-solid fa-shoe-prints text-warning me-1"></i> Navigation Path (Step-by-Step):
                        </h6>
                        <span class="badge bg-light text-muted border" id="modalJourneyDuration">Duration: Single visit</span>
                    </div>

                    <div class="journey-timeline" id="journeyTimelineItems">
                        <!-- Items injected dynamically via JS -->
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-white border-top">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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

    // 5. Visitor Journey Modal Handler
    function openVisitorJourney(visitorId) {
        const modalEl = document.getElementById('visitorJourneyModal');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        
        // Reset modal state
        document.getElementById('modalVisitorIp').innerText = '...';
        document.getElementById('modalVisitorBrowser').innerText = '...';
        document.getElementById('modalVisitorDevice').innerHTML = '...';
        document.getElementById('modalTotalPages').innerText = '0';
        document.getElementById('modalJourneyDuration').innerText = 'Duration: Calculating...';
        
        document.getElementById('journeyLoadingSpinner').classList.remove('d-none');
        document.getElementById('journeyEmptyState').classList.add('d-none');
        document.getElementById('journeyTimelineContainer').classList.add('d-none');
        document.getElementById('journeyTimelineItems').innerHTML = '';
        
        modal.show();
        
        const fetchUrl = "{{ url('/admin/analytics/visitor-journey') }}/" + visitorId;
        
        fetch(fetchUrl, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Failed to fetch visitor journey');
            return response.json();
        })
        .then(data => {
            document.getElementById('journeyLoadingSpinner').classList.add('d-none');
            
            if (!data.success || !data.journey || data.journey.length === 0) {
                document.getElementById('journeyEmptyState').classList.remove('d-none');
                if (data.visitor) {
                    document.getElementById('modalVisitorIp').innerText = data.visitor.ip_address || '-';
                    document.getElementById('modalVisitorBrowser').innerText = `${data.visitor.browser} on ${data.visitor.os}`;
                    document.getElementById('modalVisitorDevice').innerHTML = renderDeviceBadge(data.visitor.device);
                    document.getElementById('modalTotalPages').innerText = data.visitor.total_views || '0';
                }
                return;
            }
            
            const visitor = data.visitor;
            document.getElementById('modalVisitorIp').innerText = visitor.ip_address;
            document.getElementById('modalVisitorBrowser').innerText = `${visitor.browser} on ${visitor.os}`;
            document.getElementById('modalVisitorDevice').innerHTML = renderDeviceBadge(visitor.device);
            document.getElementById('modalTotalPages').innerText = visitor.total_views;
            document.getElementById('modalJourneyDuration').innerText = `Session Duration: ${visitor.duration}`;
            
            let timelineHtml = '';
            data.journey.forEach((item, index) => {
                const isFirst = index === 0;
                const isLast = index === (data.journey.length - 1);
                
                let stageBadge = '';
                if (isFirst && isLast) {
                    stageBadge = '<span class="badge bg-secondary-subtle text-secondary border ms-2">Single Visit</span>';
                } else if (isFirst) {
                    stageBadge = '<span class="badge bg-success-subtle text-success border ms-2"><i class="fa-solid fa-right-to-bracket me-1"></i>Landing Page</span>';
                } else if (isLast) {
                    stageBadge = '<span class="badge bg-danger-subtle text-danger border ms-2"><i class="fa-solid fa-arrow-right-from-bracket me-1"></i>Exit Page</span>';
                }

                timelineHtml += `
                    <div class="journey-step-item">
                        <div class="journey-step-badge">${item.step}</div>
                        <div class="journey-step-card">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                <div>
                                    <div class="journey-page-title">
                                        <i class="fa-regular fa-file-lines text-warning me-1"></i> ${escapeHtml(item.page_name)}
                                        ${stageBadge}
                                    </div>
                                    <a href="${item.url}" target="_blank" class="journey-url-link">
                                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>${escapeHtml(item.url)}
                                    </a>
                                </div>
                                <div class="text-sm-end text-muted small">
                                    <span class="badge bg-light text-dark border">
                                        <i class="fa-regular fa-clock me-1 text-primary"></i> ${item.time}
                                    </span>
                                    <div class="text-muted" style="font-size: 11px; margin-top: 2px;">${item.human_time}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 pt-2 border-top mt-2">
                                <span class="journey-meta-tag">
                                    <i class="fa-solid fa-compass text-muted"></i> Source: <strong>${escapeHtml(item.referer)}</strong>
                                </span>
                                <span class="journey-meta-tag ms-auto">
                                    <i class="fa-regular fa-calendar text-muted"></i> ${item.date}
                                </span>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            document.getElementById('journeyTimelineItems').innerHTML = timelineHtml;
            document.getElementById('journeyTimelineContainer').classList.remove('d-none');
        })
        .catch(err => {
            console.error('Failed to load journey:', err);
            document.getElementById('journeyLoadingSpinner').classList.add('d-none');
            document.getElementById('journeyEmptyState').classList.remove('d-none');
            document.getElementById('journeyEmptyState').innerHTML = `
                <i class="fa-solid fa-circle-exclamation fa-3x text-danger mb-3"></i>
                <h6 class="text-danger">Unable to load visitor journey. Please try again.</h6>
            `;
        });
    }

    function renderDeviceBadge(device) {
        if (!device) return '<span class="badge bg-secondary">Unknown</span>';
        const d = device.toLowerCase();
        if (d.includes('mobile')) {
            return '<span class="badge bg-info-subtle text-info border"><i class="fa-solid fa-mobile-screen-button me-1"></i> Mobile</span>';
        } else if (d.includes('tablet')) {
            return '<span class="badge bg-warning-subtle text-warning border"><i class="fa-solid fa-tablet-screen-button me-1"></i> Tablet</span>';
        } else {
            return '<span class="badge bg-primary-subtle text-primary border"><i class="fa-solid fa-laptop me-1"></i> Desktop</span>';
        }
    }

    function escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
    }
</script>
@endpush
