@extends('frontend.layouts.app')

@section('title', 'Services & Treatments - Jay\'s Beauty London')

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

<div class="section section-padding-02" style="padding-top: 50px;">
    <div class="container">
        <div class="section-title text-center">
            <h1 class="title">Our Services</h1>
            <p>&nbsp;</p>
        </div>
        <div class="blog-wrapper">
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="single-blog">
                        <div class="blgo-image">
                            <a href="#"><img src="{{ asset('img/shape/massage.jpg') }}" width="315" height="240" alt="Beauty Massage"></a>
                        </div>
                        <div class="blgo-content">
                            <h3 class="title"><a href="#">Beauty Massage</a></h3>
                        </div>
                        <img src="{{ asset('img/shape/shape-42.webp') }}" class="shape" alt="Massage">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="single-blog">
                        <div class="blgo-image">
                            <a href="#"><img src="{{ asset('img/shape/facial.jpg') }}" width="315" height="240" alt="Hydra Facial"></a>
                        </div>
                        <div class="blgo-content">
                            <h3 class="title"><a href="#">Hydra Facial​</a></h3>
                        </div>
                        <img src="{{ asset('img/shape/shape-42.webp') }}" class="shape" alt="Facial​">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="single-blog">
                        <div class="blgo-image">
                            <a href="#"><img src="{{ asset('img/shape/facial-threading.jpg') }}" width="315" height="240" alt="Facial Threading"></a>
                        </div>
                        <div class="blgo-content">
                            <h3 class="title"><a href="#">Facial Threading</a></h3>
                        </div>
                        <img src="{{ asset('img/shape/shape-42.webp') }}" class="shape" alt="Facial Threading">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="single-blog">
                        <div class="blgo-image">
                            <a href="#"><img src="{{ asset('img/shape/eyelash-extensions.jpg') }}" width="315" height="240" alt="Eyelash Extensions"></a>
                        </div>
                        <div class="blgo-content">
                            <h3 class="title"><a href="#">Eyelash Extensions</a></h3>
                        </div>
                        <img src="{{ asset('img/shape/shape-42.webp') }}" class="shape" alt="Eyelash Extensions">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="single-blog">
                        <div class="blgo-image">
                            <a href="#"><img src="{{ asset('img/shape/waxing.jpg') }}" width="315" height="240" alt="Waxing"></a>
                        </div>
                        <div class="blgo-content">
                            <h3 class="title"><a href="#">Waxing</a></h3>
                        </div>
                        <img src="{{ asset('img/shape/shape-42.webp') }}" class="shape" alt="Waxing">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="single-blog">
                        <div class="blgo-image">
                            <a href="#"><img src="{{ asset('img/shape/manicure-pedicure.jpg') }}" width="315" height="240" alt="Tinting"></a>
                        </div>
                        <div class="blgo-content">
                            <h3 class="title"><a href="#">Tinting</a></h3>
                        </div>
                        <img src="{{ asset('img/shape/shape-42.webp') }}" class="shape" alt="Tinting">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Price List Section -->
<section class="price-list" style="padding:40px 0; font-family: 'Poppins', sans-serif; color:#444;">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title">Our Pricing</h2>
            <p>&nbsp;</p>
        </div>
        <div class="row">
            <!-- Facial Treatments -->
            <div class="col-md-4 mb-4">
                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px;">
                    Facial Treatments
                </h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Mini Facial (20 mins)</strong><br>
                                A quick mini facial designed to help with blackheads and whiteheads. Great visible effects and great value for busy lifestyles.
                            </td>
                            <td style="width:85px;"><strong>£25.00</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Pro 60 (60 mins)</strong><br>
                                A customised facial tailored to your skin needs using products, techniques and technology for a healthy glow.
                            </td>
                            <td><strong>£50.00</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Deep Cleansing Facial (45 mins)</strong><br>
                                A relaxing deep cleansing and detoxifying treatment leaving the skin fresh and healthy.
                            </td>
                            <td><strong>£40.00</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Brightening Facial (45 mins)</strong><br>
                                Improves skin tone for a glowing complexion — ideal before a special occasion or pampering treat.
                            </td>
                            <td><strong>£45.00</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Machine Facial -->
            <div class="col-md-4 mb-4">
                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px;">
                    Machine Facial
                </h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Crystal Clear Microdermabrasion (45 mins)</strong><br>
                                Helps reduce fine lines, wrinkles, dark circles, pigmentation, sun damage and acne scarring while rejuvenating and firming the skin.
                            </td>
                            <td style="width:85px;"><strong>£60.00</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Hydra Facial</strong><br>
                                A non-invasive hydrating treatment that exfoliates, deeply cleanses and removes impurities while giving skin an instant refreshed glow.
                            </td>
                            <td><strong>£85.00</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Micro Needling</strong><br>
                                Uses tiny sterile needles to boost collagen and elastin production. Helps with fine lines, scars, large pores, uneven texture and tone.
                            </td>
                            <td><strong>£90.00</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Hair & Makeup -->
            <div class="col-md-4 mb-4">
                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px;">
                    Hair & Makeup
                </h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <tbody>
                        <tr><td>Hair</td><td><strong>Starting from £45.00</strong></td></tr>
                        <tr><td>Makeup</td><td><strong>Starting from £45.00</strong></td></tr>
                        <tr><td>Henna</td><td><strong>Starting from £5.00</strong></td></tr>
                    </tbody>
                </table>

                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px; margin-top:25px;">
                    Semi-Permanent Makeup
                </h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <tbody>
                        <tr><td>Micro Blading</td><td><strong>£250.00</strong></td></tr>
                        <tr><td>Powder Eyebrow</td><td><strong>£250.00</strong></td></tr>
                        <tr><td>Eye Liner</td><td><strong>£150.00</strong></td></tr>
                        <tr><td>Lip Blush</td><td><strong>£200.00</strong></td></tr>
                        <tr><td>Patch Test required 24 hours prior</td><td><strong>£10.00</strong></td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Threading -->
            <div class="col-md-4 mb-4">
                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px;">Threading</h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Threading</th>
                            <th>Normal Wax</th>
                            <th>Lycon Wax</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Eyebrow Shaping</td><td>£4.50</td><td>£6.00</td><td>£9.00</td></tr>
                        <tr><td>Upper Lip</td><td>£3.00</td><td>£4.00</td><td>£7.00</td></tr>
                        <tr><td>Lower Lip</td><td>£1.50</td><td>£2.00</td><td>£4.00</td></tr>
                        <tr><td>Chin</td><td>£4.00</td><td>£4.50</td><td>£6.50</td></tr>
                        <tr><td>Neck</td><td>£4.00</td><td>£5.00</td><td>£7.00</td></tr>
                        <tr><td>Forehead</td><td>£3.50</td><td>£4.00</td><td>£5.00</td></tr>
                        <tr><td>Cheeks</td><td>£3.50</td><td>£4.00</td><td>£6.00</td></tr>
                        <tr><td>Sides / Nose</td><td>£5.00</td><td>£6.00</td><td>£8.00</td></tr>
                        <tr><td>Full Face</td><td>£15.00</td><td>£18.00</td><td>£30.00</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Body Waxing -->
            <div class="col-md-4 mb-4">
                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px;">Body Waxing</h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <thead>
                        <tr><th></th><th>Normal Wax</th><th>Lycon Wax</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Half Arms</td><td>£8.00</td><td>£15.00</td></tr>
                        <tr><td>Full Arms</td><td>£12.00</td><td>£20.00</td></tr>
                        <tr><td>Half Legs</td><td>£10.00</td><td>£18.00</td></tr>
                        <tr><td>Full Legs</td><td>£16.00</td><td>£25.00</td></tr>
                        <tr><td>Under Arms</td><td>£6.00</td><td>£10.00</td></tr>
                        <tr><td>Bikini Line</td><td>£7.00</td><td>£12.00</td></tr>
                        <tr><td>Extended Bikini</td><td>£10.00</td><td>£20.00</td></tr>
                        <tr><td>Brazilian Wax</td><td>£20.00</td><td>£25.00</td></tr>
                        <tr><td>Hollywood Wax</td><td>£25.00</td><td>£30.00</td></tr>
                        <tr><td>Stomach</td><td>£12.00</td><td></td></tr>
                        <tr><td>Chest</td><td>£12.00</td><td></td></tr>
                        <tr><td>Lower Back</td><td>£12.00</td><td></td></tr>
                        <tr><td>Full Back</td><td>£15.00</td><td></td></tr>
                        <tr><td>Buttocks</td><td>£10.00</td><td></td></tr>
                        <tr><td>Full Body</td><td>£60.00</td><td></td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Massage & Bleach -->
            <div class="col-md-4 mb-4">
                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px;">Massage</h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <tbody>
                        <tr><td>Face Massage</td><td>15 mins</td><td>£15.00</td></tr>
                        <tr><td>Neck & Shoulder Massage</td><td>30 mins</td><td>£30.00</td></tr>
                        <tr><td>Back Massage</td><td>30 mins</td><td>£30.00</td></tr>
                        <tr><td>Full Body Aroma Massage</td><td>45 mins</td><td>£45.00</td></tr>
                        <tr><td>Full Body Aroma Massage</td><td>60 mins</td><td>£60.00</td></tr>
                        <tr><td>Indian Head Massage</td><td>25 mins</td><td>£25.00</td></tr>
                        <tr><td>Hot Stone Massage</td><td>60 mins</td><td>£60.00</td></tr>
                        <tr><td>Full Body Scrub</td><td>60 mins</td><td>£55.00</td></tr>
                        <tr><td>Back Cleansing</td><td>30 mins</td><td>£35.00</td></tr>
                        <tr><td>Full Body Polish</td><td>60 mins</td><td>£80.00</td></tr>
                    </tbody>
                </table>

                <h3 class="section-title" style="background: linear-gradient(90deg, #9c1c86, #d44d91); color:white; padding:10px 15px; font-size:20px; border-radius:4px; margin-top:25px;">Face Bleach</h3>
                <table class="table table-bordered" style="font-size:14px;">
                    <tbody>
                        <tr><td>Face</td><td>£15.00</td></tr>
                        <tr><td>Face & Neck</td><td>£17.00</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
