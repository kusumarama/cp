
@extends('layout.fe')
@section('content') 
<style>
    /* ==================== NAVBAR STYLES ==================== */
    
    /* Transparent navbar on homepage */
    #mainNav {
        background-color: transparent !important;
        backdrop-filter: none;
        box-shadow: none !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
        z-index: 1030;
    }
    
    /* Gradient overlay for text legibility */
    .navbar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.15) 0%, transparent 100%);
        pointer-events: none;
        z-index: -1;
    }
    
    /* Scrolled navbar state */
    #mainNav.navbar-shrink {
        background-color: #30415f !important;
        background: linear-gradient(180deg, rgba(48, 65, 95, 0.98) 0%, rgba(26, 35, 50, 0.95) 100%) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    
    #mainNav.navbar-shrink .navbar-overlay {
        display: none;
    }
    
    /* Navbar brand */
    #mainNav .navbar-brand {
        transition: all 0.3s ease;
    }
    
    #mainNav .navbar-brand img {
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }
    
    /* Navbar links with text-shadow */
    #mainNav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        transition: all 0.3s ease;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    #mainNav .nav-link:hover {
        color: #ffc800 !important;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
    }
    
    #mainNav .nav-link.active {
        color: #ffc800 !important;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
    }
    
    #mainNav.navbar-shrink .nav-link {
        text-shadow: none;
    }
    
    /* Navbar toggler */
    #mainNav .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.5);
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }
    
    #mainNav .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(255,255,255,0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
    
    /* ==================== MASTHEAD STYLES ==================== */
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
    .about-image{flex:0 0 40%;background-size:cover;background-position:center;min-height:520px;}
    .about-panel{flex:0 0 60%;padding:5rem 4rem;background:#192639;color:#fff;display:flex;flex-direction:column;justify-content:center}
    .about-panel h2{color:#fff;margin-bottom:1rem}
    .about-panel p.lead{color:rgba(255,255,255,0.95);text-align:justify}
    @media (max-width:991px){
        .about-split{flex-wrap:wrap;flex-direction:column}
        .about-image,.about-panel{flex:1 1 100%;min-height:320px;padding:2.5rem}
    }

    /* Visi & Misi split layout (full-width section) */
    #vns{padding:0} /* remove default section padding so it becomes full-bleed */
    .vns-split{display:flex;flex-wrap:nowrap;align-items:stretch;width:100%;margin:0;min-height:420px}
    /* .vns-image{flex:0 0 50%;background-size:cover;background-position:center;min-height:520px} */
    .vns-panel{flex:0 0 50%;padding:5rem 4rem;background:#192639;color:#fff;display:flex;flex-direction:column;justify-content:center}
    .vns-panel h2{color:#fff;margin-bottom:1rem}
    .vns-panel p.lead{color:rgba(255,255,255,0.95)}
    @media (max-width:991px){
        .vns-split{flex-wrap:wrap;flex-direction:column}
        /* .vns-image,.vns-panel{flex:1 1 100%;min-height:320px;padding:2.5rem} */
    }

    /* Clients slider - Increased by 15% */
    .clients-wrap{position:relative;display:flex;align-items:center;justify-content:center;padding:0 60px}
    .clients-slider{width:100%;overflow:hidden}
    .clients-track{display:flex;gap:2rem;transition:transform .35s ease;align-items:center}
    .clients-track .client-item{flex:0 0 17.25%;display:flex;align-items:center;justify-content:center;padding:1.15rem;height:161px}
    .clients-track .client-item img{max-width:100%;max-height:103.5px;object-fit:contain}
    .clients-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:4;border-radius:50%;width:44px;height:44px;display:flex;align-items:center;justify-content:center}
    .clients-nav button{pointer-events:auto;background:rgba(0,0,0,0.45);border:none;color:#fff;padding:0.6rem 0.9rem;border-radius:4px;margin:0 1rem}
    .clients-nav#clients-prev{left:8px}
    .clients-nav#clients-next{right:8px}
    @media (max-width:991px){
        .clients-track .client-item{flex:0 0 37.95%;height:230px;padding:1.725rem}
        .clients-track .client-item img{max-width:90%;max-height:161px}
    }
    @media (max-width:767px){
        .clients-track .client-item{flex:0 0 55.2%;height:253px;padding:2.3rem 1.15rem}
        .clients-track .client-item img{max-width:85%;max-height:184px}
        .clients-wrap{padding:0 50px}
        .clients-track{gap:1rem}
    }
    /* Statistics section */
    .stats-section{padding:4rem 0;background:#ffffff}
    .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem;max-width:1400px;margin:0 auto;justify-items:center}
    .stat-card{background:#192639;border-radius:18px;padding:2.5rem 2rem;color:#fff;display:flex;align-items:center;gap:1.5rem;box-shadow:0 4px 15px rgba(0,0,0,0.15);transition:transform .3s ease;width:100%;max-width:350px}
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
    .vm-vision{background:#192639;color:#fff}
    .vm-mission{background:#fff;color:#192639}
    .vm-panel h2{margin-bottom:1.5rem;font-weight:600;font-family:Georgia,serif}
    .vm-vision h2{font-size:4rem;color:#fff}
    .vm-mission h2{font-size:3.5rem;color:#192639}
    .vm-vision .vision-text{font-size:1.15rem;color:#fff}
    .vm-mission ul{list-style:disc;text-align:left;padding-left:2rem;line-height:1.9;color:#192639}
    .vm-mission ul li{margin-bottom:1rem;font-size:1.05rem}
    @media (max-width:991px){
        .vm-split{flex-wrap:wrap;flex-direction:column}
        .vm-panel{flex:1 1 100%;min-height:320px;padding:3rem 2rem}
        .vm-vision h2{font-size:2.8rem}
        .vm-mission h2{font-size:2.5rem}
    }
    /* Values & Approach Section */
    .values-section {
        position: relative;
        padding: 6.5rem 0;
        background: #ffffff;
        overflow: hidden;
    }
    
    @media (max-width: 991px) {
        .values-section {
            background: #ffffff !important;
            padding: 4rem 0;
        }
    }
    
    .values-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    
    .values-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
    
    /* Left Column: Core Values */
    .values-left-col {
        flex: 0 0 50%;
        max-width: 50%;
        color: #30415f;
        padding-right: 4rem;
        padding-left: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .values-left-col h2 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 3.5rem;
        color: #30415f;
        letter-spacing: -0.5px;
        font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .core-list {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
    }
    
    .core-item {
        display: flex;
        align-items: flex-start;
        gap: 2rem;
    }
    
    .core-letter {
        font-size: 4.8rem;
        font-weight: 800;
        line-height: 0.9;
        color: #30415f;
        min-width: 65px;
        text-align: center;
        text-shadow: none;
    }
    
    .core-content {
        flex: 1;
    }
    
    .core-content h3 {
        font-size: 1.45rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        color: #30415f;
        font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .core-content p {
        font-size: 1.0rem;
        line-height: 1.55;
        color: #4b5563;
        margin: 0;
    }
    
    /* Right Column: Our Approach */
    .values-right-col {
        flex: 0 0 50%;
        max-width: 50%;
        color: #30415f;
        padding-left: 4rem;
        padding-right: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .values-right-col h2 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 3.5rem;
        color: #30415f;
        letter-spacing: -0.5px;
        font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .approach-list {
        display: flex;
        flex-direction: column;
        gap: 2.2rem;
    }
    
    .approach-item {
        display: flex;
        align-items: center;
        gap: 2rem;
    }
    
    .approach-icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 76px;
        height: 76px;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 8px 24px rgba(48, 65, 95, 0.12);
        color: #30415f;
        font-size: 2.0rem;
        flex-shrink: 0;
        transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
    }
    
    .approach-item:hover .approach-icon-wrap {
        transform: translateY(-5px);
        background: #30415f;
        color: #ffffff;
    }
    
    .approach-content {
        flex: 1;
    }
    
    .approach-content h3 {
        font-size: 1.45rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        color: #30415f;
        font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    .approach-content p {
        font-size: 1.0rem;
        line-height: 1.55;
        color: #4b5563;
        margin: 0;
    }
    
    @media (max-width: 991px) {
        .values-left-col, .values-right-col {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 3rem 1rem;
        }
        .values-left-col {
            padding-bottom: 4rem;
        }
        .values-right-col {
            padding-top: 4rem;
        }
    }
    /* Contact section */
    #contact{background:#192639}
    .contact-info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:3rem;margin-bottom:3rem;text-align:left}
    .contact-info-item h4{color:#fff;font-weight:600;margin-bottom:1rem;font-size:1.5rem}
    .contact-info-item p,.contact-info-item a{color:#fff;line-height:1.8;margin:0.25rem 0}
    .contact-info-item a{text-decoration:none}
    .contact-info-item a:hover{color:#0d1929}
    .social-icons{display:flex;gap:1rem;margin-top:0.5rem}
    .social-icons a{width:40px;height:40px;border-radius:50%;background:#0d1929;color:#fff;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:background .3s}
    .social-icons a:hover{background:#192639}
    .contact-map{width:100%;height:350px;border:0;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.1)}
    @media (max-width:991px){
        .contact-info-grid{grid-template-columns:1fr;gap:2rem;text-align:center}
        .social-icons{justify-content:center}
    }
    
    /* ==================== ISO CERTIFICATION GALLERY ==================== */
    .iso-section{padding:5rem 0;background:#fff}
    .iso-gallery-container{display:flex;flex-direction:column;gap:3rem;max-width:1000px;margin:0 auto;padding:0 1rem}
    .iso-gallery-wrapper{position:relative;display:flex;align-items:center;justify-content:center}
    .iso-gallery-main{position:relative;width:100%;max-width:900px;height:700px;background:#f5f5f5;border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.1);cursor:pointer;display:flex;align-items:center;justify-content:center}
    .iso-gallery-image{width:100%;height:100%;object-fit:contain;padding:2rem;display:block}
    .iso-gallery-nav{position:absolute;width:100%;height:100%;display:flex;align-items:center;justify-content:space-between;padding:0 2rem;pointer-events:none;z-index:10}
    .iso-btn{pointer-events:auto;background:rgba(26,82,118,0.85);border:none;color:#fff;padding:0.8rem 1.2rem;border-radius:4px;font-size:1.5rem;cursor:pointer;transition:background .3s;z-index:11}
    .iso-btn:hover{background:rgba(26,82,118,1)}
    .iso-gallery-thumbnails{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:2rem}
    .iso-thumbnail{width:100px;height:100px;border-radius:8px;overflow:hidden;cursor:pointer;border:3px solid transparent;transition:all .3s;object-fit:cover;display:block}
    .iso-thumbnail:hover{border-color:#30415f;transform:scale(1.05)}
    .iso-thumbnail.active{border-color:#30415f;box-shadow:0 4px 12px rgba(26,82,118,0.4)}
    @media (max-width:991px){
        .iso-gallery-main{height:500px}
        .iso-thumbnail{width:80px;height:80px}
    }
    @media (max-width:767px){
        .iso-gallery-main{height:350px;max-width:100%}
        .iso-btn{padding:0.6rem 1rem;font-size:1.2rem}
        .iso-thumbnail{width:60px;height:60px}
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
                    <h2>{{ app()->getLocale() == 'id' ? 'Visi' : 'Vision' }}</h2>
                    <p class="vision-text">{{ app()->getLocale() == 'id' ? 'Menjadi Perusahaan yang Unggul dan Berkelanjutan' : 'To Become an Excellent and Sustainable Company' }}</p>
                </div>
                <div class="vm-panel vm-mission">
                    <h2>{{ app()->getLocale() == 'id' ? 'Misi' : 'Mission' }}</h2>
                    @if(app()->getLocale() == 'id')
                    <ul>
                        <li>Menyediakan layanan konstruksi dan perdagangan berdasarkan Tata Kelola Perusahaan yang Baik, manajemen QHSE, dan konsep ramah lingkungan</li>
                        <li>Menjaga pertumbuhan berkelanjutan dengan mengoptimalkan inovasi Teknologi Informasi (TI), sumber daya unggul</li>
                        <li>Menyediakan layanan pengembangan kawasan terpadu untuk kehidupan yang lebih ramah lingkungan</li>
                        <li>Menjaga hubungan harmonis dengan semua pemangku kepentingan</li>
                    </ul>
                    @else
                    <ul>
                        <li>To provide construction and trading services based on Good Corporate Governance, QHSE management, and an environmentally friendly concept</li>
                        <li>To maintain sustainable growth by optimizing Information Technology (IT) innovation, superior resources</li>
                        <li>To provide integrated area development services for a more environmentally friendly living</li>
                        <li>To maintain harmonious relationships with all stakeholders</li>
                    </ul>
                    @endif
                </div>
            </div>
        </section>

        <!-- Core Values & Approach Section -->
        <section class="page-section values-section" id="values">
              
            <div class="values-container">
                <div class="values-row">
                    <!-- Left Column: Core Values (C O R E) -->
                    <div class="values-left-col">
                        <h2>Core Values</h2>
                        <div class="core-list">
                            <!-- C - Collaboration -->
                            <div class="core-item">
                                <div class="core-letter">C</div>
                                <div class="core-content">
                                    <h3>Collaboration</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Membangun sinergi yang kuat dengan klien, mitra, dan tim untuk mencapai hasil terbaik.' : 'Building strong synergies with clients, partners, and teams to achieve the best results.' }}</p>
                                </div>
                            </div>
                            <!-- O - Optimization -->
                            <div class="core-item">
                                <div class="core-letter">O</div>
                                <div class="core-content">
                                    <h3>Optimization</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Mengutamakan efisiensi, ketepatan strategi, dan solusi yang bernilai tinggi.' : 'Prioritizing efficiency, strategic accuracy, and high-value solutions.' }}</p>
                                </div>
                            </div>
                            <!-- R - Reliability -->
                            <div class="core-item">
                                <div class="core-letter">R</div>
                                <div class="core-content">
                                    <h3>Reliability</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Menjadi mitra yang dapat dipercaya melalui konsistensi kualitas dan ketepatan pelaksanaan.' : 'Being a trusted partner through quality consistency and execution precision.' }}</p>
                                </div>
                            </div>
                            <!-- E - Excellence -->
                            <div class="core-item">
                                <div class="core-letter">E</div>
                                <div class="core-content">
                                    <h3>Excellence</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Berkomitmen menghadirkan standar kerja dan hasil yang unggul di setiap proyek.' : 'Committed to delivering outstanding work standards and superior results in every project.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Our Approach -->
                    <div class="values-right-col">
                        <h2>Our Approach</h2>
                        <div class="approach-list">
                            <!-- Integrated Process -->
                            <div class="approach-item">
                                <div class="approach-icon-wrap">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <div class="approach-content">
                                    <h3>Integrated Process</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Perencanaan hingga konstruksi dalam satu koordinasi terpadu.' : 'Planning to construction in a single integrated coordination.' }}</p>
                                </div>
                            </div>
                            <!-- Client-Centered -->
                            <div class="approach-item">
                                <div class="approach-icon-wrap">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <div class="approach-content">
                                    <h3>Client-Centered</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Solusi disesuaikan dengan kebutuhan dan tujuan klien.' : 'Solutions tailored to the needs and goals of clients.' }}</p>
                                </div>
                            </div>
                            <!-- Quality & Precision -->
                            <div class="approach-item">
                                <div class="approach-icon-wrap">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="approach-content">
                                    <h3>Quality & Precision</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Standar pelaksanaan berbasis QSHE dan kontrol kualitas ketat.' : 'Execution standards based on QSHE and strict quality control.' }}</p>
                                </div>
                            </div>
                            <!-- Sustainable Thinking -->
                            <div class="approach-item">
                                <div class="approach-icon-wrap">
                                    <i class="fas fa-seedling"></i>
                                </div>
                                <div class="approach-content">
                                    <h3>Sustainable Thinking</h3>
                                    <p>{{ app()->getLocale() == 'id' ? 'Pendekatan pembangunan yang efisien dan ramah lingkungan.' : 'Efficient and environmentally friendly development approach.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ISO Certification Gallery -->
        <section class="page-section iso-section" id="iso-gallery">
            <div class="iso-gallery-container">
                <div class="text-center mb-5">
                    <h2 class="section-heading text-uppercase" style="color: #30415f;">{{ app()->getLocale() == 'id' ? 'Berstandar ISO' : 'ISO Standard' }}</h2>
                </div>
                <div class="iso-gallery-wrapper">
                    <div class="iso-gallery-main" id="iso-main-image">
                        <img id="iso-display-image" class="iso-gallery-image" src="" alt="ISO Certificate" />
                    </div>
                    <div class="iso-gallery-nav">
                        <button class="iso-btn" id="iso-prev-btn" aria-label="Previous certificate">‹</button>
                        <button class="iso-btn" id="iso-next-btn" aria-label="Next certificate">›</button>
                    </div>
                </div>
                <div class="iso-gallery-thumbnails" id="iso-thumbnails">
                    <!-- Thumbnails will be generated by JavaScript -->
                </div>
            </div>
        </section>

        <!-- Services-->
        <section class="page-section" id="service" style="background:#192639;color:#fff">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">{{ app()->getLocale() == 'id' ? 'Layanan' : 'Services' }}</h2>
                    <h3 class="section-subheading ">{{ app()->getLocale() == 'id' ? 'Menyediakan Segala Yang Anda Butuhkan' : 'Providing Everything You Need' }}</h3>
                </div>
                <div class="row text-center justify-content-center" id="service_content">
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
                <h2 class="section-heading text-uppercase">{{ app()->getLocale() == 'id' ? 'KLIEN KAMI' : 'OUR CLIENTS' }}</h2>
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
                    <h2 class="section-heading text-uppercase">{{ app()->getLocale() == 'id' ? 'Hubungi Kami' : 'Contact Us' }}</h2>
                </div>
                
                <div class="contact-info-grid">
                    <div class="contact-info-item">
                        <h4>{{ app()->getLocale() == 'id' ? 'Alamat' : 'Address' }}</h4>
                        <p>Citywalk CW 2-11 Citra Gran,Jati Karya<br> Bekasi,<br>Jawa Barat</p>
                    </div>
                    <div class="contact-info-item">
                        <h4>{{ app()->getLocale() == 'id' ? 'Kontak' : 'Contact' }}</h4>
                        <a href="mailto:alhadidarchives@gmail.com">alhadidarchives@gmail.com</a>
                    </div>
                    <!-- <div class="contact-info-item">
                        <h4>{{ app()->getLocale() == 'id' ? 'Media Sosial Kami' : 'Our Social Media' }}</h4>
                        <div class="social-icons">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div> -->
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
                                    <h2 id="portofolio_project_name" class="text-uppercase">{{ app()->getLocale() == 'id' ? 'Nama Proyek' : 'Project Name' }}</h2>
                                    <p class="item-intro text-muted"></p>
                                    <img id="portofolio_img" class="img-fluid d-block mx-auto" src="{{ asset ('template_fe/assets/img/portfolio/1.jpg')}}" alt="..." />
                                    <p></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Status' : 'Status' }}:</strong>
                                            <span id="portofolio_status"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Lokasi' : 'Location' }}:</strong>
                                            <span id="portofolio_location"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Pemilik' : 'Owner' }}:</strong>
                                            <span id="portofolio_owner_project"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Alamat' : 'Address' }}:</strong>
                                            <span id="portofolio_alamat"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Nilai Kontrak' : 'Contract Value' }}:</strong>
                                            <span id="portofolio_nilai_kontrak"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Jenis Bangunan' : 'Building Type' }}:</strong>
                                            <span id="portofolio_jenis_bangunan"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Waktu Mulai' : 'Start Time' }}:</strong>
                                            <span id="portofolio_waktu"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Status Update' : 'Status Update' }}:</strong>
                                            <span id="portofolio_status_update"></span>
                                        </li>
                                        <li>
                                            <strong>{{ app()->getLocale() == 'id' ? 'Waktu Update' : 'Update Time' }}:</strong>
                                            <span id="portofolio_updated_at"></span>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        {{ app()->getLocale() == 'id' ? 'Tutup Proyek' : 'Close Project' }}
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
                    $('#masthead-slide-0').css('background-image', `url("${images[0]}")`).addClass('show');
                    $('#masterhead-title').empty().text(titles[0]);
                    $('#masterhead-subtitle').empty().text(subtitles[0]);
                    if (images.length > 1) {
                        $('#masthead-slide-1').css('background-image', `url("${images[1]}")`);;
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
                        showEl.css('background-image', `url("${nextImage}")`).addClass('show');
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
                    $('#masthead-slide-0').css('background-image', `url("${masterhead.image}")`).addClass('show');
                    // hide nav buttons if only one
                    $('#masthead-prev, #masthead-next').hide();
                }

                if (service && service.length > 0) {
                    $('#service_content').empty();
                    service.forEach(function(service){
                        let serviceItem = `
                        <div class="col-md-4">
                            <img src="${service.image}" alt="" class="rounded" style="width: 100px; height: 100px;">
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
                        $('#about_image').css('background-image', `url("${a.image}")`);;
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
                        let iconSrc = stat.icon ? `${stat.icon}` : '/template_fe/assets/img/medal.png';
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
                        let item = `<div class="client-item"><img src="${c.image}" alt="${c.title || ''}" /></div>`;
                        $('#clients-track').append(item);
                    });

                    let clientIndex = 0;
                    function visibleCount() {
                        const w = $(window).width();
                        if (w < 576) return 2; // Show 2 at a time on mobile
                        if (w < 768) return 2;
                        if (w < 992) return 3;
                        return 5;
                    }

                    function updateClients() {
                        const count = visibleCount();
                        const item = $('#clients-track .client-item').first();
                        if (!item.length) return;
                        const itemWidth = item.outerWidth(true);
                        // Fix: Ensure we can scroll to see all logos
                        // For 7 logos showing 2 at a time, maxIndex should be 6 (positions 0-6)
                        const maxIndex = Math.max(0, client.length - 1);
                        clientIndex = Math.min(clientIndex, maxIndex);
                        const move = clientIndex * itemWidth;
                        $('#clients-track').css('transform', 'translateX(-'+move+'px)');
                    }

                    $(window).on('resize', function(){ updateClients(); });
                    $('#clients-next').on('click', function(){
                        const maxIndex = Math.max(0, client.length - 1);
                        clientIndex = Math.min(clientIndex+1, maxIndex);
                        updateClients();
                    });
                    $('#clients-prev').on('click', function(){
                        clientIndex = Math.max(0, clientIndex-1);
                        updateClients();
                    });

                    // autoplay with pause on hover
                    let clientAuto = setInterval(function(){
                        const maxIndex = Math.max(0, client.length - 1);
                        clientIndex = (clientIndex + 1) > maxIndex ? 0 : clientIndex + 1;
                        updateClients();
                    }, 4000);

                    $('.clients-wrap').on('mouseenter', function(){ clearInterval(clientAuto); }).on('mouseleave', function(){
                        clientAuto = setInterval(function(){
                            const maxIndex = Math.max(0, client.length - 1);
                            clientIndex = (clientIndex + 1) > maxIndex ? 0 : clientIndex + 1;
                            updateClients();
                        }, 4000);
                    });

                    // initial layout adjustment
                    setTimeout(updateClients, 120);
                }

                // ISO Certification Gallery
                if (response.iso_certifications && response.iso_certifications.length > 0) {
                    const isoCerts = response.iso_certifications;
                    let currentIsoIndex = 0;

                    // Display first certificate
                    function displayIsoCertificate(index) {
                        if (index < 0 || index >= isoCerts.length) return;
                        const cert = isoCerts[index];
                        $('#iso-display-image').attr('src', `${cert.image}`);
                        $('#iso-thumbnails .iso-thumbnail').removeClass('active');
                        $(`#iso-thumbnail-${index}`).addClass('active');
                        currentIsoIndex = index;
                    }

                    // Create thumbnails
                    isoCerts.forEach(function(cert, idx) {
                        let thumbHtml = `<img id="iso-thumbnail-${idx}" src="${cert.image}" alt="ISO Certificate ${idx + 1}" class="iso-thumbnail ${idx === 0 ? 'active' : ''}" data-index="${idx}">`;;
                        $('#iso-thumbnails').append(thumbHtml);
                    });

                    // Display first certificate
                    displayIsoCertificate(0);

                    // Navigation buttons
                    $('#iso-prev-btn').on('click', function() {
                        let newIndex = (currentIsoIndex - 1 + isoCerts.length) % isoCerts.length;
                        displayIsoCertificate(newIndex);
                    });

                    $('#iso-next-btn').on('click', function() {
                        let newIndex = (currentIsoIndex + 1) % isoCerts.length;
                        displayIsoCertificate(newIndex);
                    });

                    // Thumbnail clicks
                    $('#iso-thumbnails').on('click', '.iso-thumbnail', function() {
                        let index = parseInt($(this).data('index'));
                        displayIsoCertificate(index);
                    });

                    // Main image click for fullscreen
                    $('#iso-main-image').on('click', function() {
                        let imgSrc = $('#iso-display-image').attr('src');
                        let modalHtml = `
                            <div class="modal fade" id="isoModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content" style="background: #000; border: none;">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; position: absolute; top: 10px; right: 15px; z-index: 10;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="modal-body" style="padding: 0;">
                                            <img src="${imgSrc}" alt="ISO Certificate" style="width: 100%; height: auto;">
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        
                        if (!$('#isoModal').length) {
                            $('body').append(modalHtml);
                        }
                        $('#isoModal').modal('show');
                    });
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