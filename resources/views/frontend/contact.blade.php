@extends('frontend.layouts.app')

@section('title', 'Contact Us - Jay\'s Beauty London')

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

<div class="section section-padding-02" style="padding-bottom: 70px;">
    <div class="container">
        <!-- Contact Information Top -->
        <div class="contact-wrapper mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-image">
                        <img src="{{ asset('img/Contact.jpeg') }}" width="541" height="520" alt="Jay's Beauty" class="img-fluid rounded shadow-sm">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h1 class="title">Contact Jay's Beauty</h1>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="single-info">
                                    <h4 class="info-title">Jay's Beauty</h4>
                                    <p class="address" style="font-size: 20px; line-height: 39px;">Hounslow Market, Hounslow, UK</p>
                                    <p class="phone"><a style="font-size: 24px; line-height: 37px;" href="tel:07399001499">07399 001 499</a></p>
                                    <p class="email"><a href="mailto:info@jaysbeauty.co.uk">info@jaysbeauty.co.uk</a></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h4 style="margin-top: 15px;">Opening Hours</h4>
                                <ul style="list-style: none; padding-left: 0;">
                                    <li style="margin-top: 5px;"><b style="display: inline-block;width: 165px;">Monday - Saturday :</b> 10AM–6:30PM</li>
                                    <li style="margin-top: 5px;"><b style="display: inline-block;width: 165px;">Sunday :</b> 11:00AM–5:00PM</li>
                                    <li style="margin-top: 5px;"><b style="display: inline-block;width: 165px;">Bank Holidays :</b> 11:00AM–4:00PM</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Live Contact Form Section -->
        <div class="contact-form-wrapper" style="background: #fff; padding: 40px; border-radius: 15px; border: 1px solid #ebd3be; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h3 style="color: #c59d5f; font-weight: 700;">Send Us a Message</h3>
                        <p class="text-muted">Have a question or want to inquire about a treatment? Leave a message below and our team will get back to you promptly.</p>
                    </div>

                    @if(session('contact_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #e6f4ea; border-color: #34a853; color: #1e4620;">
                            <i class="fa fa-check-circle me-2"></i> {{ session('contact_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-semibold">Your Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Sarah Jenkins" required style="padding: 12px 15px; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-semibold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="sarah@example.com" required style="padding: 12px 15px; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-semibold">Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="07399 000 000" style="padding: 12px 15px; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-semibold">Subject / Treatment Interested In</label>
                                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="e.g. Hydra Facial Appointment" style="padding: 12px 15px; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark fw-semibold">Your Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="5" placeholder="How can we assist you with our beauty and spa services?" required style="padding: 12px 15px; border-radius: 8px; border: 1px solid #ddd;">{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-hover-dark px-5 py-3" style="border-radius: 30px; font-weight: 600; font-size: 15px;">
                                    Send Message Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
