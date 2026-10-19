@extends('frontend.layouts.app')

@section('title', 'Beauty Blog & Expert Tips - Jay\'s Beauty London')

@section('content')
<div class="section slider-area slider-active">
   <div class="home-page swiper-container">
      <div class="swiper-wrapper">
         <div class="swiper-slide animation-style-01 single-slider d-flex align-items-center banner-slide">
             <div class="container">
                 <div class="slider-content">
                     <ul class="slider-meta">
                         <li><a href="https://www.fresha.com/a/jays-beauty-ladies-only-hounslow-unit-16-hounslow-market-281-287-high-street-hounslow-fyo7at55" target="_blank" class="btn btn-primary btn-hover-white">Book Appointment</a></li>
                     </ul>
                 </div>
             </div>
         </div>
      </div>
   </div>
</div>

<div class="section section-padding-02" style="padding-top: 50px; padding-bottom: 70px;">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h6 class="sub-title">BEAUTY INSIGHTS & ADVICE</h6>
            <h2 class="title">Our Latest Articles & Spa Tips</h2>
            <p class="text-muted">Discover the secret to healthy skin, lash retention, and professional aesthetic treatments.</p>
        </div>

        <div class="row g-4">
            <!-- Blogs Grid Column -->
            <div class="col-lg-8">
                <!-- Search Bar -->
                <div class="mb-4">
                    <form action="{{ route('blogs') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search beauty tips and articles..." class="form-control" style="padding: 12px 18px; border-radius: 25px; border: 1px solid #ebd3be;">
                        <button type="submit" class="btn btn-primary btn-hover-dark" style="border-radius: 25px; padding: 0 25px;">Search</button>
                    </form>
                    @if(request('search'))
                        <div class="mt-2 small text-muted">
                            Showing search results for: <strong>"{{ request('search') }}"</strong>
                            <a href="{{ route('blogs') }}" class="ms-2 text-danger text-decoration-none">&times; Clear search</a>
                        </div>
                    @endif
                </div>

                <div class="row g-4">
                    @forelse($blogs as $blog)
                        <div class="col-md-6" data-aos="fade-up">
                            <div class="single-blog h-100 d-flex flex-column" style="border: 1px solid #ebd3be; border-radius: 12px; overflow: hidden; background: #fff; transition: transform 0.2s;">
                                <div class="blog-image">
                                    <a href="{{ route('blog.detail', $blog->slug) }}">
                                        @if($blog->image)
                                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width: 100%; height: 230px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('img/shape/about.webp') }}" alt="{{ $blog->title }}" style="width: 100%; height: 230px; object-fit: cover;">
                                        @endif
                                    </a>
                                </div>
                                <div class="blog-content p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center small text-muted mb-2">
                                            <span><i class="fa fa-calendar me-1"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                            <span><i class="fa fa-eye me-1"></i> {{ $blog->views_count }} views</span>
                                        </div>
                                        <h4 class="title mb-3" style="font-size: 19px; line-height: 1.4;">
                                            <a href="{{ route('blog.detail', $blog->slug) }}" class="text-dark text-decoration-none">{{ $blog->title }}</a>
                                        </h4>
                                        <p class="text-muted small mb-3">
                                            {!! Str::limit(strip_tags($blog->description), 110) !!}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="{{ route('blog.detail', $blog->slug) }}" class="btn btn-sm btn-outline-dark" style="border-radius: 20px;">
                                            Read More &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="fa fa-newspaper-o fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Blog Posts Available</h4>
                            <p class="text-muted">Please check back soon for our latest articles and beauty insights.</p>
                        </div>
                    @endforelse
                </div>

                @if($blogs->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-wrapper" style="position: sticky; top: 100px;">
                    <!-- Booking CTA Box -->
                    <div class="card mb-4 text-center p-4" style="background: linear-gradient(135deg, #18181c 0%, #2b2b36 100%); color: white; border-radius: 15px;">
                        <h4 style="color: #c59d5f; font-weight: 700;">Pamper Yourself Today</h4>
                        <p class="small text-white-50">Book your luxury facial, massage or lashes treatment at Jay's Beauty Spa in Hounslow.</p>
                        <a href="https://www.fresha.com/a/jays-beauty-ladies-only-hounslow-unit-16-hounslow-market-281-287-high-street-hounslow-fyo7at55" target="_blank" class="btn btn-primary" style="border-radius: 25px;">Book Direct Appointment</a>
                    </div>

                    <!-- Recent Articles Widget -->
                    @if(isset($recentBlogs) && $recentBlogs->isNotEmpty())
                        <div class="card p-4" style="border: 1px solid #ebd3be; border-radius: 15px; background: white;">
                            <h5 class="fw-bold mb-3" style="color: #c59d5f; border-bottom: 2px solid #ebd3be; padding-bottom: 8px;">Recent Articles</h5>
                            <div class="d-flex flex-column gap-3">
                                @foreach($recentBlogs as $rb)
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="{{ route('blog.detail', $rb->slug) }}" class="flex-shrink-0">
                                            @if($rb->image)
                                                <img src="{{ asset($rb->image) }}" alt="{{ $rb->title }}" class="rounded" style="width: 65px; height: 60px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('img/shape/about.webp') }}" alt="{{ $rb->title }}" class="rounded" style="width: 65px; height: 60px; object-fit: cover;">
                                            @endif
                                        </a>
                                        <div>
                                            <a href="{{ route('blog.detail', $rb->slug) }}" class="text-dark fw-semibold text-decoration-none small d-block mb-1 line-clamp-2">
                                                {{ Str::limit($rb->title, 45) }}
                                            </a>
                                            <small class="text-muted" style="font-size: 11px;"><i class="fa fa-calendar me-1"></i> {{ $rb->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
