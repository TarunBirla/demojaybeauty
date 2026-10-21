@extends('frontend.layouts.app')

@section('title', $blog->title . ' - Jay\'s Beauty London')
@section('meta_description', Str::limit(strip_tags($blog->description), 155))
@section('meta_image', $blog->image ? asset($blog->image) : asset('img/Contact.jpeg'))
@section('og_type', 'article')

@section('content')
<div class="section slider-area slider-active">
   <div class="home-page swiper-container">
      <div class="swiper-wrapper">
         <div class="swiper-slide animation-style-01 single-slider d-flex align-items-center banner-slide">
             <div class="container">
                 <div class="slider-content">
                     <ul class="slider-meta">
                         <li><a href="{{ route('blogs') }}" class="btn btn-primary btn-hover-white">&larr; Back to Blogs</a></li>
                     </ul>
                 </div>
             </div>
         </div>
      </div>
   </div>
</div>

<div class="section section-padding-02" style="padding-top: 50px; padding-bottom: 70px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <article class="blog-details" style="background: white; border: 1px solid #ebd3be; border-radius: 16px; padding: 40px; box-shadow: 0 5px 25px rgba(0,0,0,0.02);">
                    <!-- Breadcrumbs & Meta -->
                    <div class="d-flex justify-content-between align-items-center text-muted small mb-3">
                        <div>
                            <a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a> &gt; 
                            <a href="{{ route('blogs') }}" class="text-muted text-decoration-none">Blogs</a> &gt; 
                            <span class="text-dark">{{ Str::limit($blog->title, 25) }}</span>
                        </div>
                        <div>
                            <span class="me-3"><i class="fa fa-calendar me-1"></i> {{ $blog->created_at->format('F d, Y') }}</span>
                            <span><i class="fa fa-eye me-1"></i> {{ $blog->views_count }} reads</span>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="mb-4" style="font-size: 32px; font-weight: 700; color: #18181c; line-height: 1.3;">
                        {{ $blog->title }}
                    </h1>

                    <!-- Featured Image -->
                    @if($blog->image)
                        <div class="mb-4 text-center">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded shadow-sm" style="max-height: 450px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Content (Rich Text) -->
                    <div class="blog-body mb-5" style="font-size: 16px; line-height: 1.8; color: #444;">
                        {!! $blog->description !!}
                    </div>

                    <!-- Share & Footer -->
                    <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                        <a href="{{ route('blogs') }}" class="btn btn-outline-dark" style="border-radius: 20px;">
                            &larr; Back to All Articles
                        </a>
                        <div class="d-flex align-items-center gap-2">
                            <span class="small text-muted me-2">Share:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa fa-facebook-f"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-circle" style="width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center;"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </article>

                <!-- Related Blogs -->
                @if(isset($relatedBlogs) && $relatedBlogs->isNotEmpty())
                    <div class="mt-5">
                        <h4 class="fw-bold mb-4" style="color: #c59d5f;">You Might Also Enjoy</h4>
                        <div class="row g-4">
                            @foreach($relatedBlogs as $rel)
                                <div class="col-md-4">
                                    <div class="card h-100" style="border: 1px solid #ebd3be; border-radius: 10px; overflow: hidden;">
                                        @if($rel->image)
                                            <img src="{{ asset($rel->image) }}" alt="{{ $rel->title }}" style="height: 160px; object-fit: cover;">
                                        @endif
                                        <div class="card-body p-3">
                                            <h6 class="card-title fw-bold">
                                                <a href="{{ route('blog.detail', $rel->slug) }}" class="text-dark text-decoration-none">
                                                    {{ Str::limit($rel->title, 45) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted"><i class="fa fa-calendar me-1"></i> {{ $rel->created_at->format('M d, Y') }}</small>
                                        </div>
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
@endsection
