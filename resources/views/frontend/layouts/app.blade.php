<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('css/plugins/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/nouislider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/nice-select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/style1.min.css') }}" type="text/css" media="all" />

    <title>@yield('title', 'Jays Beauty - A World Class Beauty Spa in London')</title>

    <style>
        img:is([sizes="auto" i], [sizes^="auto," i]) { contain-intrinsic-size: 3000px 1500px }
        .banner1 { background-image: url("{{ asset('img/banner1.jpg') }}"); }
        .banner2 { background-image: url("{{ asset('img/banner3.jpg') }}"); }
        .banner3 { background-image: url("{{ asset('img/banner5.jpg') }}"); }
        @media (max-width: 767px) {
          .banner1 { background-image: url("{{ asset('img/16.png') }}"); }
          .banner2 { background-image: url("{{ asset('img/17.png') }}"); }
          .banner3 { background-image: url("{{ asset('img/18.png') }}"); }
        }
        .banner-slide {
            background-image: url("{{ asset('img/Contact.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 500px;
        }
        @media (max-width: 768px) {
            .banner-slide {
                background-image: url("{{ asset('img/19.png') }}");
                height: 300px;
            }
        }
        .header-navbar .navbar-menu li a.active,
        .mobile-menu .navbar-menu li a.active {
            color: #d4a373 !important;
            font-weight: 700;
        }
    </style>
    @stack('styles')
</head>
<body class="home wp-singular page-template page-template-template page-template-template-homepage page-template-templatetemplate-homepage-php page page-id-2 wp-theme-dimplesbeauty">
    <div class="main-wrapper">
        <!-- Header Section -->
        <div id="header" class="section header-area">
            <div class="container">
                <div class="header-wrapper">
                    <div class="header-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" width="175" height="45" alt="Jays Beauty"></a>
                    </div>
                    <div class="header-navbar d-none d-lg-block">
                        <ul class="navbar-menu">
                            <li class="menu-item {{ request()->routeIs('home') ? 'current-menu-item active' : '' }}">
                                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('about') ? 'current-menu-item active' : '' }}">
                                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('service') ? 'current-menu-item active' : '' }}">
                                <a href="{{ route('service') }}" class="{{ request()->routeIs('service') ? 'active' : '' }}">Services</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('blogs*') ? 'current-menu-item active' : '' }}">
                                <a href="{{ route('blogs') }}" class="{{ request()->routeIs('blogs*') ? 'active' : '' }}">Blogs</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://www.fresha.com/a/jays-beauty-ladies-only-hounslow-unit-16-hounslow-market-281-287-high-street-hounslow-fyo7at55" target="_blank">Book Appointment</a>
                            </li>
                            <li class="menu-item {{ request()->routeIs('contact') ? 'current-menu-item active' : '' }}">
                                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
                            </li>
                        </ul>    
                    </div>
                    <div class="header-meta">
                        <div class="header-toggle d-lg-none">
                            <button class="toggle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Offcanvas Menu -->
        <div class="offcanvas offcanvas-start" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}" width="175" height="45" alt="Jays Beauty">
                    </a>
                </div>
                <button type="button" class="close" data-bs-dismiss="offcanvas">
                    <span></span>
                    <span></span>
                </button>
            </div>
            <div class="offcanvas-body">
                <div class="mobile-menu offcanvas-menu">
                    <ul class="navbar-menu">
                        <li class="menu-item {{ request()->routeIs('home') ? 'current-menu-item' : '' }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('about') ? 'current-menu-item' : '' }}">
                            <a href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('service') ? 'current-menu-item' : '' }}">
                            <a href="{{ route('service') }}">Services</a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('blogs*') ? 'current-menu-item' : '' }}">
                            <a href="{{ route('blogs') }}">Blogs</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://www.fresha.com/a/jays-beauty-ladies-only-hounslow-unit-16-hounslow-market-281-287-high-street-hounslow-fyo7at55" target="_blank">Book Appointment</a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('contact') ? 'current-menu-item' : '' }}">
                            <a href="{{ route('contact') }}">Contact Us</a>
                        </li>
                    </ul>              
                </div>
            </div>
        </div>

        <!-- Dynamic Main Content -->
        @yield('content')

        <!-- Footer Section -->
        <div class="footer-section section">
            <div class="footer-top">
                <div class="container">
                    <div class="newsletter-wrapper text-center" data-aos="fade-up" data-aos-delay="200">
                        <a class="logo" href="{{ route('home') }}"><img src="{{ asset('img/Lagonew.png') }}" alt="Jay's Beauty" style="width: 200px;"></a>
                    </div>
                    <div class="footer-widget-wrapper">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <div class="footer-widget" data-aos="fade-up" data-aos-delay="150">
                                    <h4 class="widget-title">About Us</h4>
                                    <div class="footer-widget-info">
                                        <div class="single-widget-info">
                                            <p>Jays beauty has always had a passion for health and beauty with our main aim being to help others enhance their natural beauty.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <div class="footer-widget" data-aos="fade-up" data-aos-delay="300">
                                    <h4 class="widget-title">Opening Hours</h4>
                                    <div class="footer-widget-link">
                                        <ul>
                                            <li style="margin-top: 5px;"><b>Mon</b> 10AM–6:30PM</li>
                                            <li style="margin-top: 5px;"><b>Tue</b> 10AM–6:30PM </li>
                                            <li style="margin-top: 5px;"><b>Wed</b> 10AM–6:30PM</li>
                                            <li style="margin-top: 5px;"><b>Thu</b> 10AM–6:30PM</li>
                                            <li style="margin-top: 5px;"><b>Fri</b> 10AM–6:30PM</li>
                                            <li style="margin-top: 5px;"><b>Sat</b> 10AM–6:30PM</li>
                                            <li style="margin-top: 5px;"><b>Sun</b> 11AM–5:00PM</li>
                                            <li style="margin-top: 5px;"><b>Bank Holidays</b> 11AM–4:00PM</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <div class="footer-widget" data-aos="fade-up" data-aos-delay="150">
                                    <h4 class="widget-title">Hounslow</h4>
                                    <div class="footer-widget-info">
                                        <div class="single-widget-info">
                                            <p>Hounslow Market<br />Hounslow, UK</p>
                                            <p><a href="mailto:info@jaysbeauty.co.uk">info@jaysbeauty.co.uk</a></p>
                                            <p><a href="tel:07399001499">07399 001 499</a></p>
                                        </div>
                                        <div class="single-widget-info">
                                            <div class="page-social">
                                                <div class="container" style="padding: 0;">
                                                    <ul class="social">
                                                        <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100076831596108"><i class="fa fa-facebook-f"></i></a></li>
                                                        <li><a target="_blank" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                                                        <li><a target="_blank" href="https://wa.me/447399001499"><i class="fa fa-whatsapp"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-copyright">
                <div class="container">
                    <div class="copyright-wrapper">
                        <div class="copyright-text">
                            <p>Copyright &copy; {{ date('Y') }} Jay's Beauty | All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button id="backBtn" class="back-to-top"><i class="icofont-simple-up"></i></button>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('script/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('script/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('script/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('script/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('script/js/plugins/nouislider.js') }}"></script>
    <script src="{{ asset('script/js/plugins/star-rating.js') }}"></script>
    <script src="{{ asset('script/js/plugins/nice-select2.js') }}"></script>
    <script src="{{ asset('script/js/plugins/glightbox.min.js') }}"></script>
    <script src="{{ asset('script/js/plugins/aos.js') }}"></script>
    <script src="{{ asset('script/js/plugins/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <!-- Beauty Bot Widget -->
    <style>
        :root { --beauty-gold: #d4a373; --dark: #1a1a1a; --bg: #fffaf5; --text-muted: #8d8d8d; }
        #beauty-bot { 
            position: fixed; bottom: 100px; right: 20px; width: 380px; height: 620px; 
            background: white; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); 
            display: none; flex-direction: column; z-index: 10000; overflow: hidden; border: 1px solid #f0e1d2;
        }
        .bot-header { background: white; padding: 18px; border-bottom: 1px solid #f9f1e8; display: flex; align-items: center; gap: 15px; }
        .header-img { width: 45px; height: 45px; border-radius: 50%; border: 2px solid var(--beauty-gold); }
        #chat-logs { flex: 1; padding: 20px; overflow-y: auto; background: var(--bg); display: flex; flex-direction: column; gap: 12px; scroll-behavior: smooth; }
        .msg { padding: 12px 16px; border-radius: 20px; font-size: 14px; max-width: 85%; line-height: 1.5; animation: fadeIn 0.4s ease; }
        .bot { background: white; align-self: flex-start; box-shadow: 0 4px 10px rgba(212, 163, 115, 0.1); color: var(--dark); border-bottom-left-radius: 2px; }
        .user { background: var(--beauty-gold); color: white; align-self: flex-end; border-bottom-right-radius: 2px; }
        .expertise-highlight { 
            background: linear-gradient(135deg, #fffcf9 0%, #fdf3e7 100%); 
            border: 1.5px solid var(--beauty-gold); 
            padding: 15px; border-radius: 18px; margin: 10px 0; 
            box-shadow: 0 4px 15px rgba(212, 163, 115, 0.15); 
            animation: slideUp 0.5s ease;
            font-weight: 500; color: var(--dark);
        }
        .bot-footer-panel { padding: 15px; background: white; border-top: 1px solid #f9f1e8; }
        .btn-choice { border: 1.5px solid var(--beauty-gold); background: white; color: var(--beauty-gold); padding: 12px; border-radius: 25px; cursor: pointer; font-weight: 600; width: 100%; margin-bottom: 8px; transition: 0.3s; text-align: center; text-decoration: none; display: block; font-size: 13px; }
        .btn-choice:hover { background: var(--beauty-gold); color: white; }
        .voucher-pop { background: #fff5f5; border: 2px dashed #ff8787; padding: 15px; border-radius: 15px; text-align: center; animation: pulse 2s infinite; margin-top: 10px; }
        #gdpr-gate { position: absolute; inset: 0; background: white; z-index: 101; padding: 40px; display: flex; flex-direction: column; justify-content: center; text-align: center; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.02); } 100% { transform: scale(1); } }
    </style>

    <div id="beauty-bot">
        <div id="gdpr-gate">
            <h3 style="color:var(--dark); margin-bottom: 10px;">Jay's Luxury Beauty</h3>
            <p style="font-size:13px; color:var(--text-muted); line-height: 1.5;">Premium results at affordable prices. Start your consultation below.</p>
            <label style="font-size:12px; display:flex; gap:10px; margin: 20px 0; text-align: left; align-items: flex-start; cursor: pointer;">
                <input type="checkbox" id="consent"> <span>I consent to this beauty consultation and real-time lead processing.</span>
            </label>
            <button class="btn-choice" style="background:var(--beauty-gold); color:white;" onclick="acceptGDPR()">Begin Consultation</button>
        </div>

        <div class="bot-header">
            <img src="https://ui-avatars.com/api/?name=Jays+Expert&background=d4a373&color=fff" class="header-img" alt="Jay">
            <div>
                <div style="font-weight:700; font-size: 14px;">Jay's Beauty Concierge</div>
                <div style="font-size:11px; color:#22c55e;">● YOUR AI Partner, Chat with me for more discounts and offers</div>
            </div>
        </div>
        <div id="chat-logs"></div>
        <div id="bot-footer" class="bot-footer-panel"></div>
    </div>

    <div onclick="toggleChat()" style="position:fixed; bottom:20px; right:20px; background:var(--beauty-gold); width:65px; height:65px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow: 0 10px 25px rgba(212,163,115,0.4); color:white; font-size:30px; z-index:10001;" title="Chat with Concierge">✨</div>

    <script>
        const WEBHOOK_URL = "https://script.google.com/macros/s/AKfycbz8f8qx9kLhnrdNTsmk3-arNb4ADk3br21RbbT8MwQaddJMXDaBpWbU1RV9tkePa4UZ/exec"; 
        const BOOKING_LINK = "https://www.fresha.com/a/jays-beauty-ladies-only-hounslow-unit-16-hounslow-market-281-287-high-street-hounslow-fyo7at55";
        const GOOGLE_REVIEWS = "https://www.google.com/search?q=jays+beauty+reviews";

        let state = { name: '', email: '', phone: '', service: '', currentKey: '', hasBooked: false, started: false };

        const expertiseData = {
            "Lashes & Brows": "💎 <b>Master Artistry:</b> 5,000+ lash sets perfected. We use premium mink-feel fibers for maximum retention at local prices.",
            "Aesthetics": "💎 <b>Level 7 Expertise:</b> Specialist in natural enhancements. Harley Street quality results without the Harley Street price tag.",
            "Skin Treatments": "💎 <b>Advanced Clinical Care:</b> Medical-grade products used in every session for lasting skin health and a visible glow.",
            "Nails & Body": "💎 <b>Elite Hygiene & Style:</b> Award-winning technicians focusing on premium nail health and total body relaxation."
        };

        function toggleChat() {
            const bot = document.getElementById('beauty-bot');
            bot.style.display = (bot.style.display === 'flex') ? 'none' : 'flex';
        }

        function acceptGDPR() {
            if(!document.getElementById('consent').checked) return alert("Please accept the terms.");
            document.getElementById('gdpr-gate').style.display = 'none';
            renderStep('menu');
        }

        function renderStep(stepKey) {
            const footer = document.getElementById('bot-footer');
            footer.innerHTML = "";
            
            if (stepKey === 'menu') {
                addMessage("Which luxury service are we exploring today?", 'bot');
                ["Lashes & Brows", "Aesthetics", "Skin Treatments", "Nails & Body"].forEach(opt => {
                    const b = document.createElement('button');
                    b.className = 'btn-choice'; b.innerText = opt;
                    b.onclick = () => { state.service = opt; addMessage(opt, 'user'); showExpertise(); };
                    footer.appendChild(b);
                });
            }
        }

        function showExpertise() {
            const logs = document.getElementById('chat-logs');
            const card = document.createElement('div');
            card.className = "expertise-highlight";
            card.innerHTML = `
                <div style="font-size: 11px; color: var(--beauty-gold); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Our Premium Promise</div>
                <div style="font-size: 13px;">${expertiseData[state.service]}</div>
            `;
            logs.appendChild(card);
            logs.scrollTop = 9999;
            setTimeout(() => askInput("To provide an accurate quote, what is your name?", "name"), 1200);
        }

        function askInput(msg, key) {
            state.currentKey = key;
            addMessage(msg, 'bot');
            const footer = document.getElementById('bot-footer');
            footer.innerHTML = `
                <div style="display:flex; gap:5px;">
                    <input type="text" id="u-in" placeholder="Enter here..." style="flex:1; padding:12px; border-radius:20px; border:1px solid #ddd; outline:none;">
                    <button onclick="handleInput()" style="background:var(--beauty-gold); border:none; color:white; border-radius:50%; width:40px; height:40px; cursor:pointer;">➔</button>
                </div>`;
            document.getElementById('u-in').focus();
            document.getElementById('u-in').onkeypress = (e) => { if(e.key === 'Enter') handleInput(); };
        }

        function handleInput() {
            const val = document.getElementById('u-in').value;
            if(val.length < 2) return;
            state[state.currentKey] = val;
            addMessage(val, 'user');

            if(state.currentKey === "name") askInput("Thank you, what is your email?", "email");
            else if(state.currentKey === "email") askInput("And your best phone number?", "phone");
            else if(state.currentKey === "phone") finalize();
        }

        function finalize() {
            document.getElementById('bot-footer').innerHTML = "";
            addMessage("Finalizing your premium package...", "bot");
            
            fetch(WEBHOOK_URL, {
                method: 'POST',
                mode: 'no-cors',
                body: JSON.stringify(state)
            });

            setTimeout(showDashboard, 1500);
        }

        function showDashboard() {
            const logs = document.getElementById('chat-logs');
            const dash = document.createElement('div');
            dash.style = "background: white; border-radius: 20px; padding: 20px; border: 1px solid #f0e1d2; animation: slideUp 0.5s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.05);";
            dash.innerHTML = `
                <div style="font-weight:700; text-align:center; color:var(--beauty-gold); margin-bottom:10px;">✨ CUSTOM SELECTION FOUND</div>
                <p style="font-size:12px; text-align:center; color:#555; margin-bottom:15px;">Priority <b>${state.service}</b> package for ${state.name}.</p>
                <a href="${BOOKING_LINK}" target="_blank" onclick="state.hasBooked=true" class="btn-choice" style="background:var(--beauty-gold); color:white; border:none; margin-bottom:8px;">📅 Book Direct Appointment</a>
                <a href="${GOOGLE_REVIEWS}" target="_blank" style="display:block; text-align:center; font-size:11px; color:var(--beauty-gold); text-decoration:none; margin-bottom:15px; font-weight:700;">⭐⭐⭐⭐⭐ View 100+ Google Reviews</a>
                <a href="https://wa.me/447399001499?text=Hi%20Jay,%20I'm%20${state.name}%20interested%20in%20${state.service}" target="_blank" onclick="state.hasBooked=true" class="btn-choice" style="border-color:#25D366; color:#25D366;">💬 Message on WhatsApp</a>
            `;
            logs.appendChild(dash);
            logs.scrollTop = 9999;
            confetti({ particleCount: 150, spread: 70, origin: { y: 0.6 }, colors: ['#d4a373', '#000000'] });

            setTimeout(() => {
                if(!state.hasBooked) {
                    const voucher = document.createElement('div');
                    voucher.className = "voucher-pop";
                    voucher.innerHTML = `
                        <div style="font-size:11px; color:#e03131; font-weight:700; text-transform:uppercase;">Surprise Gift! 🎁</div>
                        <div style="font-size:14px; font-weight:800; margin:5px 0;">CODE: JAY5OFF</div>
                        <div style="font-size:10px; color:#555;">Get £5 OFF your first booking! Simply mention this code to Jay's Beauty.<br> Applicable when bill amount more than £50</div>
                    `;
                    logs.appendChild(voucher);
                    logs.scrollTop = 9999;
                }
            }, 6000);
        }

        function addMessage(txt, cls) {
            const div = document.createElement('div'); div.className = `msg ${cls}`; div.innerHTML = txt;
            document.getElementById('chat-logs').appendChild(div);
            document.getElementById('chat-logs').scrollTop = 9999;
        }
    </script>
    @stack('scripts')
</body>
</html>
