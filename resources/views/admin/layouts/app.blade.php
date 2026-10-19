<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Jay's Beauty</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Summernote Editor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-gold: #c59d5f;
            --primary-dark: #1e1e24;
            --sidebar-width: 260px;
            --bg-light: #f8f9fa;
        }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-light);
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: #18181c;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar-brand {
            padding: 20px;
            background: #111114;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-brand img {
            height: 38px;
            object-fit: contain;
        }
        .sidebar-menu {
            padding: 15px 0;
            list-style: none;
            margin: 0;
        }
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 24px;
            color: #a4a6b3;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            color: #ffffff;
            background: rgba(197, 157, 95, 0.12);
            border-left-color: var(--primary-gold);
        }
        .sidebar-menu li a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        .sidebar-menu .badge {
            margin-left: auto;
        }
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .top-navbar {
            background: #ffffff;
            height: 65px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .content-area {
            padding: 30px;
            flex-grow: 1;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            margin-bottom: 24px;
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #f0f2f5;
            padding: 18px 24px;
            font-weight: 600;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }
        .btn-gold {
            background-color: var(--primary-gold);
            color: #ffffff;
            border: none;
            font-weight: 500;
        }
        .btn-gold:hover {
            background-color: #b0894d;
            color: #ffffff;
        }
        .kpi-card {
            display: flex;
            align-items: center;
            padding: 24px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            transition: transform 0.2s;
        }
        .kpi-card:hover {
            transform: translateY(-2px);
        }
        .kpi-icon {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 18px;
        }
        .kpi-gold { background: rgba(197, 157, 95, 0.15); color: var(--primary-gold); }
        .kpi-blue { background: rgba(13, 110, 253, 0.12); color: #0d6efd; }
        .kpi-green { background: rgba(25, 135, 84, 0.12); color: #198754; }
        .kpi-purple { background: rgba(111, 66, 193, 0.12); color: #6f42c1; }
        .badge-active { background: #d1e7dd; color: #0f5132; }
        .badge-inactive { background: #f8d7da; color: #842029; }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('img/logo.png') }}" alt="Jay's Beauty">
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.analytics') }}" class="{{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span>Analytics & Visitors</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Blogs</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Contact Inquiries</span>
                </a>
            </li>
            <li class="mt-4 border-top border-secondary pt-3">
                <a href="{{ url('/') }}" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>View Website</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Topbar -->
        <header class="top-navbar">
            <h5 class="mb-0 fw-semibold text-secondary">@yield('page_title', 'Dashboard')</h5>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-dark border px-3 py-2">
                    <i class="fa-solid fa-user-shield me-1 text-warning"></i> {{ Auth::user()->name ?? 'Admin' }}
                </span>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @stack('scripts')
</body>
</html>
