<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\PageView;
use App\Models\Blog;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::where('visit_date', $today)->count();
        $totalPageViews = PageView::count();
        $todayPageViews = PageView::whereDate('created_at', $today)->count();

        $totalBlogs = Blog::count();
        $activeBlogs = Blog::where('status', 'active')->count();

        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('status', 'unread')->count();

        $recentVisitors = Visitor::with('pageViews')
            ->orderBy('last_activity', 'desc')
            ->take(8)
            ->get();

        $recentMessages = ContactMessage::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 7 days trend for overview
        $days = [];
        $visitorCounts = [];
        $pageViewCounts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $label = Carbon::today()->subDays($i)->format('D, d M');
            $days[] = $label;
            $visitorCounts[] = Visitor::where('visit_date', $date)->count();
            $pageViewCounts[] = PageView::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', compact(
            'totalVisitors',
            'todayVisitors',
            'totalPageViews',
            'todayPageViews',
            'totalBlogs',
            'activeBlogs',
            'totalMessages',
            'unreadMessages',
            'recentVisitors',
            'recentMessages',
            'days',
            'visitorCounts',
            'pageViewCounts'
        ));
    }

    public function analytics(Request $request)
    {
        $daysRange = (int) $request->get('range', 14);
        if (!in_array($daysRange, [7, 14, 30, 90])) {
            $daysRange = 14;
        }

        $startDate = Carbon::today()->subDays($daysRange - 1)->toDateString();

        // 1. Daily Trend Data
        $chartDates = [];
        $chartVisitors = [];
        $chartPageViews = [];

        for ($i = $daysRange - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $chartDates[] = Carbon::today()->subDays($i)->format('d M');
            $chartVisitors[] = Visitor::where('visit_date', $date)->count();
            $chartPageViews[] = PageView::whereDate('created_at', $date)->count();
        }

        // 2. Top Visited Pages
        $topPages = PageView::select('url', 'page_name', DB::raw('count(*) as total'))
            ->groupBy('url', 'page_name')
            ->orderByDesc('total')
            ->take(10)
            ->get();

        // 3. Browser Distribution
        $browsers = Visitor::select('browser', DB::raw('count(*) as count'))
            ->groupBy('browser')
            ->orderByDesc('count')
            ->get();

        // 4. Device Distribution
        $devices = Visitor::select('device', DB::raw('count(*) as count'))
            ->groupBy('device')
            ->orderByDesc('count')
            ->get();

        // 5. OS Distribution
        $operatingSystems = Visitor::select('os', DB::raw('count(*) as count'))
            ->groupBy('os')
            ->orderByDesc('count')
            ->get();

        // 6. Paginated Visitors List with latest page viewed
        $visitorsList = Visitor::with(['pageViews' => function ($q) {
                $q->latest()->take(1);
            }])
            ->orderBy('last_activity', 'desc')
            ->paginate(15);

        $totalUniqueIps = Visitor::distinct('ip_address')->count('ip_address');
        $totalPageHits = PageView::count();

        return view('admin.analytics.index', compact(
            'daysRange',
            'chartDates',
            'chartVisitors',
            'chartPageViews',
            'topPages',
            'browsers',
            'devices',
            'operatingSystems',
            'visitorsList',
            'totalUniqueIps',
            'totalPageHits'
        ));
    }
}
