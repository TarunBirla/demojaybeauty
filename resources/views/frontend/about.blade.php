@extends('frontend.layouts.app')

@section('title', 'About Us - Jay\'s Beauty London')

@section('content')
<div class="section slider-area slider-active">
   <div class="home-page swiper-container">
      <div class="swiper-wrapper">
         <div class="swiper-slide animation-style-01 single-slider d-flex align-items-center banner-slide">
             <div class="container">
                 <div class="slider-content">
                     <ul class="slider-meta">
                         <li><a href="{{ route('service') }}" class="btn btn-primary btn-hover-white">Service</a></li>
                     </ul>
                 </div>
             </div>
         </div>
      </div>
   </div>
</div>

<div class="section section-padding-02 about-section">
   <div class="container">
       <div class="about-wrapper">
           <div class="row justify-content-center align-items-center">
               <div class="col-lg-6 col-md-8">
                   <div class="about-image" data-aos="fade-up" data-aos-delay="200">
                       <img src="{{ asset('img/jigna.jpeg') }}" width="540" height="565" alt="Jigna Ladwa - Jay's Beauty">
                   </div>
               </div>
               <div class="col-lg-6">
                   <div class="about-content" data-aos="fade-up" data-aos-delay="200">
                       <div class="section-title">
                           <h6 class="sub-title">WELCOME TO JAYS BEAUTY</h6>
                           <h2 class="title">Jigna Ladwa</h2>
                       </div>
                       <p>Jigna Ladwa is a highly skilled beautician and spa specialist at Jay’s Beauty, known for her gentle approach, precision, and deep expertise in skincare and relaxation treatments. With years of professional experience, she delivers personalised facials, spa therapies, and beauty services that leave clients feeling refreshed, confident, and beautifully cared for.</p>
                       <a href="{{ route('service') }}" class="btn btn-primary btn-hover-dark">Our Services</a>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

<div class="section section-padding-02 about-section" style="padding-bottom: 70px;">
   <div class="container">
       <div class="about-wrapper">
           <div class="row justify-content-center align-items-center">
               <div class="col-lg-6">
                   <div class="about-content" data-aos="fade-up" data-aos-delay="200">
                       <div class="section-title">
                           <h2 class="title">The Best Beauty Spa in Hounslow</h2>
                       </div>
                       <p>Jay’s Beauty offers a wide range of professional treatments including facials, microdermabrasion, hydra facials, micro-needling, semi-permanent makeup, hair styling, makeup, and henna. With expert care, relaxing services, and personalised skin treatments, Jay’s Beauty provides a welcoming experience designed to enhance natural beauty and leave clients feeling refreshed and confident.</p>
                       <a href="{{ route('contact') }}" class="btn btn-primary btn-hover-dark">Contact Us</a>
                   </div>
               </div>
               <div class="col-lg-6 col-md-8">
                   <div class="about-image" data-aos="fade-up" data-aos-delay="200">
                       <img src="{{ asset('img/shape/about.webp') }}" width="540" height="565" alt="Jay's Beauty Spa">
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
