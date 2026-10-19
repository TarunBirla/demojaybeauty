<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\ContactMessage;

class FrontendController extends Controller
{
    public function index()
    {
        $recentBlogs = Blog::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.index', compact('recentBlogs'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function service()
    {
        return view('frontend.service');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? 'Website Inquiry',
            'message' => $validated['message'],
            'status' => 'unread',
            'ip_address' => $request->ip(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully. We will get back to you shortly.',
            ]);
        }

        return back()->with('contact_success', 'Thank you! Your message has been sent successfully. We will contact you soon.');
    }

    public function blogs(Request $request)
    {
        $query = Blog::where('status', 'active');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(6);
        $recentBlogs = Blog::where('status', 'active')->orderBy('created_at', 'desc')->take(4)->get();

        return view('frontend.blogs', compact('blogs', 'recentBlogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $blog->increment('views_count');

        $relatedBlogs = Blog::where('status', 'active')
            ->where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.blog-detail', compact('blog', 'relatedBlogs'));
    }
}
