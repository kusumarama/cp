
@extends('layout.fe')
@section('content') 
<style>
    /* Transparent navbar on homepage */
    #mainNav {
        background-color: transparent !important;
        transition: all 0.3s ease;
    }
    
    #mainNav.navbar-shrink {
        background-color: #212529 !important;
    }
    
    /* Better text styling for mobile */
    .masthead {
        position: relative;
        padding: 15.6rem 0 !important;
        min-height: 960px !important;
        overflow: hidden;
    }
    .masthead-slider{position:absolute;inset:0;z-index:0}
    .masthead-slide{position:absolute;inset:0;background-size:cover;background-position:center center;background-repeat:no-repeat;opacity:0;transition:opacity 1s ease-in-out}
    .masthead-slide.show{opacity:1}
    /* Ensure content sits above slides */
    .masthead .container{position:absolute;bottom:4rem;left:3rem;z-index:2;text-align:left;max-width:none}
    .masthead-subheading{
        font-size:1.8rem;
        color:#ffffff;
        margin-bottom:0rem;
        font-style:italic;
        text-shadow:3px 3px 6px rgba(0,0,0,0.9);
        font-weight:400;
    }
    .masthead-heading{
        font-size:2.20rem;
        color:#ffffff;
        font-weight:700;
        line-height:1.2;
        text-shadow:3px 3px 6px rgba(0,0,0,0.9);
    }
    /* Navigation buttons */
    .masthead-nav{position:absolute;inset:0;z-index:3;display:flex;align-items:center;justify-content:space-between;pointer-events:none}
    .masthead-nav button{pointer-events:auto;background:rgba(0,0,0,0.45);border:none;color:#fff;padding:0.6rem 0.9rem;border-radius:4px;margin:0 1rem}
    .masthead-title-wrap{display:none}
    @media (max-width:991px){
        .masthead{
            min-height:600px !important;
            padding:8rem 0 !important;
        }
        .masthead-slide{
            background-size:cover;
            background-position:center center;
        }
        .masthead .container{
            left:1rem;
            right:1rem;
            bottom:2rem;
            padding:0 0.5rem;
        }
        .masthead-subheading{
            font-size:0.85rem;
            line-height:1.5;
            font-weight:300;
            max-width:90%;
        }
        .masthead-heading{
            font-size:1.3rem;
            line-height:1.4;
            word-wrap:break-word;
            font-weight:700;
            max-width:90%;
            margin-bottom:0.5rem;
        }
        
        /* Smaller logo on mobile */
        #mainNav .navbar-brand img {
            height: 50px !important;
        }
        .masthead-nav button{
            padding:0.4rem 0.6rem;
            margin:0 0.5rem;
        }
    }
    @media (max-width:576px){
        .masthead{
            min-height:500px !important;
        }
        .masthead-heading{
            font-size:1.1rem;
            max-width:95%;
        }
        .masthead-subheading{
            font-size:0.75rem;
            max-width:95%;
        }
        .masthead .container{
            bottom:1.5rem;
        }
        
        Even smaller logo on small phones
        #mainNav .navbar-brand img {
            height: 45px !important;
        }
    }

    /* About split layout (full-width section) */
    #about{padding:0} /* remove default section padding so it becomes full-bleed */
    .about-split{display:flex;flex-wrap:nowrap;align-items:stretch;width:100%;margin:0;min-height:420px}
    .about-image{flex:0 0 50%;background-size:cover;background-position:center;min-height:520px;}
    .about-panel{flex:0 0 50%;padding:5rem 4rem;background:#46584d;color:#fff;display:flex;flex-direction:column;justify-content:center}
    .about-panel h2{color:#fff;margin-bottom:1rem}
    .about-panel p.lead{color:rgba(255,255,255,0.95)}
    @media (max-width:991px){
        .about-split{flex-wrap:wrap;flex-direction:column}
        .about-image,.about-panel{flex:1 1 100%;min-height:320px;padding:2.5rem}
    }

    /* Visi & Misi split layout (full-width section) */
    #vns{padding:0} /* remove default section padding so it becomes full-bleed */
    .vns-split{display:flex;flex-wrap:nowrap;align-items:stretch;width:100%;margin:0;min-height:420px}
    /* .vns-image{flex:0 0 50%;background-size:cover;background-position:center;min-height:520px} */
    .vns-panel{flex:0 0 50%;padding:5rem 4rem;background:#46584d;color:#fff;display:flex;flex-direction:column;justify-content:center}
    .vns-panel h2{color:#fff;margin-bottom:1rem}
    .vns-panel p.lead{color:rgba(255,255,255,0.95)}
    @media (max-width:991px){
        .vns-split{flex-wrap:wrap;flex-direction:column}
        /* .vns-image,.vns-panel{flex:1 1 100%;min-height:320px;padding:2.5rem} */
    }

    /* Clients slider */
    .clients-wrap{position:relative;display:flex;align-items:center;justify-content:center;padding:0 60px}
    .clients-slider{width:100%;overflow:hidden}
    .clients-track{display:flex;gap:2rem;transition:transform .35s ease;align-items:center}
    .clients-track .client-item{flex:0 0 15%;display:flex;align-items:center;justify-content:center;padding:1.0rem;height:140px}
    .clients-track .client-item img{max-width:100%;max-height:90px;object-fit:contain}
    .clients-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:4;border-radius:50%;width:44px;height:44px;display:flex;align-items:center;justify-content:center}
    .clients-nav button{pointer-events:auto;background:rgba(0,0,0,0.45);border:none;color:#fff;padding:0.6rem 0.9rem;border-radius:4px;margin:0 1rem}
    .clients-nav#clients-prev{left:8px}
    .clients-nav#clients-next{right:8px}
    @media (max-width:991px){.clients-track .client-item{flex:0 0 23%}}
    @media (max-width:767px){.clients-track .client-item{flex:0 0 30%}}
    /* Core Management section */
    .core-management{padding:5rem 0;background:#ffffff}
    .core-management .section-heading{font-size:3.25rem;color:#173f2e;margin-bottom:2.5rem}
    .core-grid{position:relative;display:grid;grid-template-columns:1fr 1fr;grid-template-rows:auto auto;gap:3rem;align-items:center;text-align:center;max-width:1200px;margin:0 auto;padding:2rem}
    .core-item .title{font-weight:700;color:#16422f;margin-bottom:.75rem}
    .core-item .name{font-size:1.8rem;font-weight:700;color:#16422f}
    /* dotted cross lines */
    .core-grid:before{content:"";position:absolute;left:5%;right:5%;top:50%;border-top:3px dotted rgba(22,66,47,0.5);transform:translateY(-50%);pointer-events:none}
    .core-grid:after{content:"";position:absolute;top:10%;bottom:10%;left:50%;border-left:3px dotted rgba(22,66,47,0.5);transform:translateX(-50%);pointer-events:none}
    @media (max-width:991px){
        .core-grid{grid-template-columns:1fr;grid-template-rows:auto auto auto auto;padding:1.25rem}
        .core-grid:before{left:10%;right:10%}
        .core-grid:after{display:none}
        .core-item{padding:1.5rem 0}
    }
    /* Statistics section */
    .stats-section{padding:4rem 0;background:#ffffff}
    .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem;max-width:1400px;margin:0 auto;justify-items:center}
    .stat-card{background:#46584d;border-radius:18px;padding:2.5rem 2rem;color:#fff;display:flex;align-items:center;gap:1.5rem;box-shadow:0 4px 15px rgba(0,0,0,0.15);transition:transform .3s ease;width:100%;max-width:350px}
    .stat-card:hover{transform:translateY(-5px)}
    .stat-icon{width:80px;height:80px;opacity:0.9;flex-shrink:0;display:flex;align-items:center;justify-content:center}
    .stat-icon img{max-width:100%;max-height:100%;object-fit:contain;filter:brightness(0) invert(1)}
    .stat-content{text-align:left;flex:1}
    .stat-label{font-size:0.95rem;margin-bottom:0.5rem;opacity:0.95;font-weight:500}
    .stat-value{font-size:2.2rem;font-weight:700;line-height:1.1}
    @media (max-width:1200px){
        .stats-grid{padding:0 1.5rem}
    }
    @media (max-width:767px){
        .stats-grid{grid-template-columns:1fr}
        .stat-card{padding:2rem 1.5rem}
    }
    /* Vision & Mission section (split layout) */
    #vision-mission{padding:0}
    .vm-split{display:flex;flex-wrap:nowrap;align-items:stretch;width:100%;margin:0;min-height:520px}
    .vm-panel{flex:0 0 50%;padding:5rem 4rem;display:flex;flex-direction:column;justify-content:center}
    .vm-vision{background:#46584d;color:#fff}
    .vm-mission{background:#fff;color:#46584d}
    .vm-panel h2{margin-bottom:1.5rem;font-weight:600;font-family:Georgia,serif}
    .vm-vision h2{font-size:4rem;color:#fff}
    .vm-mission h2{font-size:3.5rem;color:#46584d}
    .vm-vision .vision-text{font-size:1.15rem;color:#fff}
    .vm-mission ul{list-style:disc;text-align:left;padding-left:2rem;line-height:1.9;color:#46584d}
    .vm-mission ul li{margin-bottom:1rem;font-size:1.05rem}
    @media (max-width:991px){
        .vm-split{flex-wrap:wrap;flex-direction:column}
        .vm-panel{flex:1 1 100%;min-height:320px;padding:3rem 2rem}
        .vm-vision h2{font-size:2.8rem}
        .vm-mission h2{font-size:2.5rem}
    }
    /* Values section */
    .values-section{padding:5rem 0;background:#fff}
    .values-section .section-heading{font-size:3rem;color:#173f2e;margin-bottom:3rem}
    .values-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:2.5rem;max-width:1200px;margin:0 auto;position:relative}
    .value-card{background:#46584d;border-radius:20px;padding:3rem 2.5rem;color:#fff;text-align:center;box-shadow:0 8px 20px rgba(0,0,0,0.12);transition:transform .3s ease,box-shadow .3s ease;position:relative;z-index:1}
    .value-card:hover{transform:translateY(-8px);box-shadow:0 12px 30px rgba(0,0,0,0.18)}
    .value-card.center{grid-column:1 / -1;justify-self:center;max-width:500px;z-index:2}
    .value-icon{font-size:3.5rem;margin-bottom:1.5rem}
    .value-icon img{width:80px;height:80px;object-fit:contain;filter:brightness(0) invert(1)}
    .value-card h3{font-size:2rem;margin-bottom:1rem;font-weight:600}
    @media (max-width:991px){
        .values-grid{grid-template-columns:1fr;padding:0 1.5rem}
        .value-card.center{grid-column:1;max-width:100%}
    }
    /* Contact section */
    #contact{background:#46584d}
    .contact-info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:3rem;margin-bottom:3rem;text-align:left}
    .contact-info-item h4{color:#fff;font-weight:600;margin-bottom:1rem;font-size:1.5rem}
    .contact-info-item p,.contact-info-item a{color:#fff;line-height:1.8;margin:0.25rem 0}
    .contact-info-item a{text-decoration:none}
    .contact-info-item a:hover{color:#173f2e}
    .social-icons{display:flex;gap:1rem;margin-top:0.5rem}
    .social-icons a{width:40px;height:40px;border-radius:50%;background:#173f2e;color:#fff;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:background .3s}
    .social-icons a:hover{background:#46584d}
    .contact-map{width:100%;height:350px;border:0;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.1)}
    @media (max-width:991px){
        .contact-info-grid{grid-template-columns:1fr;gap:2rem;text-align:center}
        .social-icons{justify-content:center}
    }
</style>
      <!-- Masthead-->
        <!--<header class="masthead" id="masthead" style="background-size: cover; background-position: center; background-repeat: no-repeat;">-->
        <header class="masthead">
            <div class="masthead-slider" aria-hidden="true">
                <div class="masthead-slide" id="masthead-slide-0"></div>
                <div class="masthead-slide" id="masthead-slide-1"></div>
            </div>
            <div class="masthead-nav">
                <button id="masthead-prev" aria-label="Previous slide">‹</button>
                <button id="masthead-next" aria-label="Next slide">›</button>
            </div>
            <div class="container">
                <div class="masthead-heading" id="masterhead-title"></div>
                <div class="masthead-subheading" id="masterhead-subtitle"></div>
                
            </div>
            <div class="masthead-title-wrap">
                <h2 id="masthead-rot-title" style="display:none"></h2>
                <p id="masthead-rot-subtitle" style="display:none"></p>
            </div>
        </header>
        <!-- About (split image + panel) -->
        <section class="page-section" id="about">
            <div class="about-split" id="about_content">
                <div class="about-image" id="about_image"></div>
                <div class="about-panel">
                    <h2 id="about_title">About Us</h2>
                    <!-- <p id="about_subtitle" class="lead">Lorem ipsum dolor sit amet consectetur.</p> -->
                    <p id="about_body">We are a design and construction company committed to delivering exceptional results. Our team of architects and engineers collaborates closely with clients to bring visions to life.</p>
                </div>
            </div>
        </section>

        <!-- Statistics -->
        <section class="stats-section" id="statistics">
            <div class="container">
                <div class="stats-grid" id="statistics_content">
                    <!-- Statistics will be loaded dynamically via AJAX -->
                </div>
            </div>
        </section>

        <!-- Vision & Mission (split) -->
        <section class="page-section" id="vision-mission">
            <div class="vm-split">
                <div class="vm-panel vm-vision">
                    <h2>Vision</h2>
                    <p class="vision-text">To Become an Excellent and Sustainable Company</p>
                </div>
                <div class="vm-panel vm-mission">
                    <h2>Mision</h2>
                    <ul>
                        <li>To provide construction and trading services based on Good Corporate Governance, QHSE management, and an environmentally friendly concept</li>
                        <li>To maintain sustainable growth by optimizing Information Technology (IT) innovation, superior resources</li>
                        <li>To provide integrated area development services for a more environmentally friendly living</li>
                        <li>To maintain harmonious relationships with all stakeholders</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Values -->
        <section class="page-section values-section" id="values">
            <div class="container text-center">
                <h2 class="section-heading text-uppercase">OUR VALUES</h2>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <img src="{{asset('template_fe/assets/img/amanah.png')}}" alt="Amanah">
                    </div>
                    <h3>Amanah</h3>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <img src="{{asset('template_fe/assets/img/sidiq.png')}}" alt="Siddiq">
                    </div>
                    <h3>Siddiq</h3>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <img src="{{asset('template_fe/assets/img/fathonah.png')}}" alt="Fatonah">
                    </div>
                    <h3>Fatonah</h3>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <img src="{{asset('template_fe/assets/img/tabligh.png')}}" alt="Tabligh">
                    </div>
                    <h3>Tabligh</h3>
                </div>
            </div>
        </section>

        <!-- Core Management -->
        <section class="page-section core-management" id="core-management">
            <div class="container text-center">
                <h2 class="section-heading text-uppercase">Core Management</h2>
            </div>
            <div class="core-grid" role="list">
                <div class="core-item" role="listitem">
                    <div class="title">President Commissioner</div>
                    <div class="name">Henny Tri Prawanti, S.P.</div>
                </div>
                <div class="core-item" role="listitem">
                    <div class="title">President Director</div>
                    <div class="name">Muhammad Faishal Hafizh,<br>S.PWK, M.RK</div>
                </div>
                <div class="core-item" role="listitem">
                    <div class="title">Director</div>
                    <div class="name">M. Ali Amran, S.T., M.T.</div>
                </div>
                <div class="core-item" role="listitem">
                    <div class="title">Director</div>
                    <div class="name">Agus Erwanto, S.T</div>
                </div>
            </div>
        </section>

        <!-- Services-->
        <section class="page-section" id="service" style="background:#46584d;color:#fff">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading ">Providing Everything You Need</h3>
                </div>
                <div class="row text-center" id="service_content">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">E-Commerce</h4>
                        <h5 class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</h5>
                    </div>
                </div>
            </div>
        </section>
        <!-- Clients (slider) -->
        <section class="page-section bg-light" id="clients">
            <div class="container text-center">
                <h2 class="section-heading text-uppercase">OUR CLIENTS</h2>
                <div class="clients-wrap mt-4">
                    <button class="" id="clients-prev" aria-label="Previous clients">‹</button>
                    <div class="clients-slider">
                        <div class="clients-track" id="clients-track">
                            <!-- client items injected here -->
                        </div>
                    </div>
                    <button class="" id="clients-next" aria-label="Next clients">›</button>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                </div>
                
                <div class="contact-info-grid">
                    <div class="contact-info-item">
                        <h4>Address</h4>
                        <p>Citywalk CW 2-11 Citra Gran,Jati Karya<br> Bekasi,<br>Jawa Barat</p>
                    </div>
                    <div class="contact-info-item">
                        <h4>Contact</h4>
                        <a href="mailto:alhadidarchives@gmail.com">alhadidarchives@gmail.com</a>
                    </div>
                    <div class="contact-info-item">
                        <h4>Our Social Media</h4>
                        <div class="social-icons">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <div>
                    <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.081776276195!2d106.92157657591565!3d-6.383446462440702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699561ec45b8db%3A0x4c452380bef1ad9f!2sPT.%20Harkat%20Digdaya%20Konstruksi%20(PT.%20HDK)!5e0!3m2!1sid!2sid!4v1763543039776!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
            </div>
        </section>

        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{ asset('template_fe/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 id="portofolio_project_name" class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted"></p>
                                    <img id="portofolio_img" class="img-fluid d-block mx-auto" src="{{ asset ('template_fe/assets/img/portfolio/1.jpg')}}" alt="..." />
                                    <p></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Status:</strong>
                                            <span id="portofolio_status"></span>
                                        </li>
                                        <li>
                                            <strong>Location:</strong>
                                            <span id="portofolio_location"></span>
                                        </li>
                                        <li>
                                            <strong>Owner:</strong>
                                            <span id="portofolio_owner_project"></span>
                                        </li>
                                        <li>
                                            <strong>Alamat:</strong>
                                            <span id="portofolio_alamat"></span>
                                        </li>
                                        <li>
                                            <strong>Nilai Kontrak:</strong>
                                            <span id="portofolio_nilai_kontrak"></span>
                                        </li>
                                        <li>
                                            <strong>Jenis Bangunan:</strong>
                                            <span id="portofolio_jenis_bangunan"></span>
                                        </li>
                                        <li>
                                            <strong>Waktu Mulai:</strong>
                                            <span id="portofolio_waktu"></span>
                                        </li>
                                        <li>
                                            <strong>Status Update:</strong>
                                            <span id="portofolio_status_update"></span>
                                        </li>
                                        <li>
                                            <strong>Waktu Update:</strong>
                                            <span id="portofolio_updated_at"></span>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>
    $('document').ready(function(e){
        // Fetch masterhead data from the server
        $.ajax({
            url: "{{ route('public.data') }}",
            method: 'GET',
            // dataType: 'json',
            beforeSend: function() {
                // Show the loader overlay before sending the request
                $('.loader-overlay').css('display', 'flex');
            },
            success: function(response) {
                let masterhead = response.master_head;
                let service = response.service;
                let portofolio = response.portofolio;
                let about = response.about;
                let client = response.client;

                // masterhead can be an array (multiple slides) or a single object
                if (Array.isArray(masterhead) && masterhead.length > 0) {
                    // map images and texts
                    const images = masterhead.map(m => m.image);
                    const titles = masterhead.map(m => m.title || '');
                    const subtitles = masterhead.map(m => m.subtitle || '');

                    // set initial state
                    $('#masthead-slide-0').css('background-image', `url("/storage/${images[0]}")`).addClass('show');
                    $('#masterhead-title').empty().text(titles[0]);
                    $('#masterhead-subtitle').empty().text(subtitles[0]);
                    if (images.length > 1) {
                        $('#masthead-slide-1').css('background-image', `url("/storage/${images[1]}")`);
                    }

                    let currentIndex = 0; // current image index in images array
                    let visible = 0; // which slide element is visible (0 or 1)
                    const slideCount = images.length;
                    const slideDuration = 5000;
                    let slideTimer = null;

                    function startSlideTimer() {
                        slideTimer = setInterval(function() {
                            showSlide((currentIndex + 1) % slideCount);
                        }, slideDuration);
                    }

                    function stopSlideTimer() {
                        if (slideTimer) {
                            clearInterval(slideTimer);
                            slideTimer = null;
                        }
                    }

                    function showSlide(index) {
                        if (index === currentIndex) return;
                        const nextImage = images[index];
                        const showEl = (visible === 0) ? $('#masthead-slide-1') : $('#masthead-slide-0');
                        const hideEl = (visible === 0) ? $('#masthead-slide-0') : $('#masthead-slide-1');
                        showEl.css('background-image', `url("/storage/${nextImage}")`).addClass('show');
                        hideEl.removeClass('show');
                        visible = 1 - visible;
                        currentIndex = index;
                        // update texts
                        $('#masterhead-title').empty().text(titles[index]);
                        $('#masterhead-subtitle').empty().text(subtitles[index]);
                    }

                    // Prev/Next handlers
                    $('#masthead-prev').on('click', function(){
                        stopSlideTimer();
                        let idx = (currentIndex - 1 + slideCount) % slideCount;
                        showSlide(idx);
                        startSlideTimer();
                    });
                    $('#masthead-next').on('click', function(){
                        stopSlideTimer();
                        let idx = (currentIndex + 1) % slideCount;
                        showSlide(idx);
                        startSlideTimer();
                    });

                    // start autoplay
                    startSlideTimer();
                } else if (masterhead) {
                    // fallback: masterhead is a single object
                    $('#masterhead-title').empty().text(masterhead.title || '');
                    $('#masterhead-subtitle').empty().text(masterhead.subtitle || '');
                    $('#masthead-slide-0').css('background-image', `url("/storage/${masterhead.image}")`).addClass('show');
                    // hide nav buttons if only one
                    $('#masthead-prev, #masthead-next').hide();
                }

                if (service && service.length > 0) {
                    $('#service_content').empty();
                    service.forEach(function(service){
                        let serviceItem = `
                        <div class="col-md-4">
                            <img src="/storage/${service.image}" alt="" class="rounded" style="width: 100px; height: 100px;">
                             <h4 class="my-3">${service.title}</h4>
                            <p class="my-3">${service.subtitle}</p>
                        </div>`;
                        $('#service_content').append(serviceItem);
                    });
                }

                if (about && about.length > 0){
                    // Use the first about entry for the split layout
                    const a = Array.isArray(about) ? about[0] : about;
                    if (a && a.image) {
                        $('#about_image').css('background-image', `url("/storage/${a.image}")`);
                    } else {
                        // Fallback to default image if no image in API response
                        $('#about_image').css('background-image', `url("{{asset('template_fe/assets/img/about/1.jpg')}}")`);
                    }
                    $('#about_title').text(a.title || 'About Us');
                    $('#about_subtitle').text(a.subtitle || '');
                    // If there's a longer body/description field use it, otherwise keep subtitle
                    $('#about_body').text(a.body || a.subtitle || '');
                }

                // Statistics section
                if (response.statistics && response.statistics.length > 0) {
                    $('#statistics_content').empty();
                    response.statistics.forEach(function(stat){
                        let iconSrc = stat.icon ? `/storage/${stat.icon}` : '/template_fe/assets/img/medal.png';
                        let statCard = `
                        <div class="stat-card">
                            <div class="stat-icon"><img src="${iconSrc}" alt="${stat.label}" onerror="this.src='/template_fe/assets/img/medal.png'"></div>
                            <div class="stat-content">
                                <div class="stat-label">${stat.label}</div>
                                <div class="stat-value">${stat.value}</div>
                            </div>
                        </div>`;
                        $('#statistics_content').append(statCard);
                    });
                }

                // Clients slider population and controls
                if (client && client.length > 0) {
                    $('#clients-track').empty();
                    client.forEach(function(c){
                        let item = `<div class="client-item"><img src="/storage/${c.image}" alt="${c.title || ''}" /></div>`;
                        $('#clients-track').append(item);
                    });

                    let clientIndex = 0;
                    function visibleCount() {
                        const w = $(window).width();
                        if (w < 576) return 2;
                        if (w < 768) return 3;
                        if (w < 992) return 4;
                        return 5;
                    }

                    function updateClients() {
                        const count = visibleCount();
                        const item = $('#clients-track .client-item').first();
                        if (!item.length) return;
                        const itemWidth = item.outerWidth(true);
                        const maxIndex = Math.max(0, client.length - count);
                        clientIndex = Math.min(clientIndex, maxIndex);
                        const move = clientIndex * itemWidth;
                        $('#clients-track').css('transform', 'translateX(-'+move+'px)');
                    }

                    $(window).on('resize', function(){ updateClients(); });
                    $('#clients-next').on('click', function(){
                        const maxIndex = Math.max(0, client.length - visibleCount());
                        clientIndex = Math.min(clientIndex+1, maxIndex);
                        updateClients();
                    });
                    $('#clients-prev').on('click', function(){
                        clientIndex = Math.max(0, clientIndex-1);
                        updateClients();
                    });

                    // autoplay with pause on hover
                    let clientAuto = setInterval(function(){
                        const maxIndex = Math.max(0, client.length - visibleCount());
                        clientIndex = (clientIndex + 1) > maxIndex ? 0 : clientIndex + 1;
                        updateClients();
                    }, 4000);

                    $('.clients-wrap').on('mouseenter', function(){ clearInterval(clientAuto); }).on('mouseleave', function(){
                        clientAuto = setInterval(function(){
                            const maxIndex = Math.max(0, client.length - visibleCount());
                            clientIndex = (clientIndex + 1) > maxIndex ? 0 : clientIndex + 1;
                            updateClients();
                        }, 4000);
                    });

                    // initial layout adjustment
                    setTimeout(updateClients, 120);
                }
            },
            complete: function() {
                // Hide the loader overlay after the request is complete
                $('.loader-overlay').css('display', 'none');
            }
        });
    });
</script>
@endsection