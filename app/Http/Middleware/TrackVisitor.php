<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use App\Models\PageView;
use Illuminate\Support\Facades\Schema;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET requests and exclude admin/system/asset routes
        if ($request->isMethod('GET') && !$this->shouldSkip($request)) {
            $this->recordVisit($request);
        }

        return $response;
    }

    protected function shouldSkip(Request $request): bool
    {
        $path = $request->path();
        
        return $request->ajax() 
            || $request->wantsJson()
            || $request->is('admin*')
            || $request->is('setup-database*')
            || $request->is('api*')
            || str_starts_with($path, '_')
            || preg_match('/\.(css|js|jpg|jpeg|png|gif|svg|ico|webp|woff|woff2|ttf|map)$/i', $path);
    }

    protected function recordVisit(Request $request): void
    {
        try {
            // Check if tables exist before querying
            if (!Schema::hasTable('visitors') || !Schema::hasTable('page_views')) {
                return;
            }

            $ip = $request->ip() ?? '127.0.0.1';
            $today = now()->toDateString();
            $userAgent = $request->userAgent() ?? '';
            $url = '/' . ltrim($request->path(), '/');

            $browser = $this->detectBrowser($userAgent);
            $device = $this->detectDevice($userAgent);
            $os = $this->detectOS($userAgent);

            // 1. Find or create visitor for today with this IP (Prevents duplicate visitor count)
            $visitor = Visitor::firstOrCreate(
                [
                    'ip_address' => $ip,
                    'visit_date' => $today,
                ],
                [
                    'browser' => $browser,
                    'device' => $device,
                    'os' => $os,
                    'user_agent' => substr($userAgent, 0, 500),
                    'views_count' => 1,
                    'last_activity' => now(),
                ]
            );

            // 2. Record journey step (Debounce 30s for the immediate same page to prevent F5 reload spam, while logging every page visited)
            $recentSamePage = PageView::where('visitor_id', $visitor->id)
                ->where('url', $url)
                ->where('created_at', '>=', now()->subSeconds(30))
                ->exists();

            if (!$recentSamePage) {
                PageView::create([
                    'visitor_id' => $visitor->id,
                    'ip_address' => $ip,
                    'url' => $url,
                    'page_name' => $this->getPageName($url),
                    'referer' => substr($request->headers->get('referer', ''), 0, 500),
                ]);

                if (!$visitor->wasRecentlyCreated) {
                    $visitor->increment('views_count');
                }
                $visitor->update(['last_activity' => now()]);
            } else {
                $visitor->update(['last_activity' => now()]);
            }
        } catch (\Throwable $e) {
            // Silently ignore to avoid breaking user response
        }
    }

    protected function getPageName(string $url): string
    {
        if ($url === '/' || $url === '') return 'Home';
        if (str_starts_with($url, '/about')) return 'About Us';
        if (str_starts_with($url, '/service')) return 'Services';
        if (str_starts_with($url, '/contact')) return 'Contact Us';
        if (str_starts_with($url, '/blog')) return 'Blog';
        return ucfirst(trim($url, '/'));
    }

    protected function detectBrowser(string $userAgent): string
    {
        if (preg_match('/Edg/i', $userAgent)) return 'Edge';
        if (preg_match('/Chrome/i', $userAgent) && !preg_match('/Edg/i', $userAgent)) return 'Chrome';
        if (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) return 'Safari';
        if (preg_match('/Firefox/i', $userAgent)) return 'Firefox';
        if (preg_match('/Opera|OPR/i', $userAgent)) return 'Opera';
        return 'Other';
    }

    protected function detectDevice(string $userAgent): string
    {
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
            return 'Tablet';
        }
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $userAgent)) {
            return 'Mobile';
        }
        return 'Desktop';
    }

    protected function detectOS(string $userAgent): string
    {
        if (preg_match('/windows|win32/i', $userAgent)) return 'Windows';
        if (preg_match('/macintosh|mac os x/i', $userAgent)) return 'macOS';
        if (preg_match('/android/i', $userAgent)) return 'Android';
        if (preg_match('/iphone|ipad|ipod/i', $userAgent)) return 'iOS';
        if (preg_match('/linux/i', $userAgent)) return 'Linux';
        return 'Other';
    }
}
