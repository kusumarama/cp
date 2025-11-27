@extends('layout.fe')
@section('content') 
<style>
    /* Fixed navbar */
    #mainNav {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        background-color: #212529 !important;
    }
    #mainNav .navbar-brand img {
        height: 45px !important;
    }
    #mainNav.navbar-shrink {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    #mainNav.navbar-shrink .navbar-brand img {
        height: 45px !important;
    }

    /* About section spacing */
    #about-legality {
        padding-top: 8rem !important;
    }

    /* Legality section spacing */
    #legality {
        padding-top: 3rem !important;
    }

    /* 5 column grid layout */
    .col-lg-2_4 {
        flex: 0 0 auto;
        width: 20%;
    }
    
    @media (max-width: 991px) {
        .col-lg-2_4 {
            width: 33.333333%;
        }
    }
    
    @media (max-width: 767px) {
        .col-lg-2_4 {
            width: 50%;
        }
    }

    /* Legality item styling with border */
    .legality-item {
        border: 4px solid #2d5a3d;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
    }

    .legality-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .legality-link {
        display: block;
        position: relative;
    }

    .legality-hover {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(45, 90, 61, 0.9);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .legality-item:hover .legality-hover {
        opacity: 1;
    }

    .legality-hover-content {
        color: white;
        font-size: 2rem;
    }

    .legality-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .legality-caption {
        padding: 1rem;
        background: white;
    }

    .legality-caption-heading {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d5a3d;
        margin-bottom: 0.5rem;
    }

    .legality-caption-subheading {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    /* Carousel styling */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 20px;
    }

    .carousel-inner {
        border-radius: 8px;
        background: #f8f9fa;
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
        
        <!-- About Legality Section -->
        <section class="page-section bg-white" id="about-legality">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-heading text-uppercase" style="color: #2d5a3d; font-weight: 700; letter-spacing: 1px;">Company Legality</h2>
                    <div class="divider-custom" style="margin: 1.5rem auto;">
                        <div style="width: 80px; height: 4px; background: #2d5a3d; margin: 0 auto;"></div>
                    </div>
                </div>
                <div class="row align-items-stretch g-4">
                    <div class="col-lg-5 mb-4 mb-lg-0 d-flex">
                        <div class="position-relative w-100">
                            <img class="img-fluid rounded shadow-lg w-100" src="{{ asset('template_fe/assets/img/legality.png') }}" alt="Company Building" style="border: 4px solid #2d5a3d; border-radius: 12px !important; height: 100%; object-fit: cover;" />
                            
                        </div>
                    </div>
                    <div class="col-lg-7 d-flex">
                        <div class="row g-3 w-100">
                            <!-- Risk-Based Business Licensing Card -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm hover-lift" style="border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    <div class="card-body p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px;">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <div class="rounded-circle p-2" style="background: rgba(45,90,61,0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-certificate" style="color: #2d5a3d; font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <h5 class="card-title text-center mb-3" style="color: #2d5a3d; font-weight: 700; font-size: 1.1rem; line-height: 1.3;">Risk-Based Business<br>Licensing (SS)</h5>
                                        <ul class="list-unstyled mb-0" style="font-size: 0.85rem; color: #555;">
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41011 Construction of Residential Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41012 Construction of Office Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41014 Construction of Shopping Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41016 Construction of Educational Buildings</span></li>
                                            <li class="mb-0 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41017 Construction of Lodging Buildings</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Construction Service Business Entity Certificate Card -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm hover-lift" style="border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    <div class="card-body p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px;">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <div class="rounded-circle p-2" style="background: rgba(45,90,61,0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-award" style="color: #2d5a3d; font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <h5 class="card-title text-center mb-3" style="color: #2d5a3d; font-weight: 700; font-size: 1.1rem; line-height: 1.3;">Construction Service Business Entity Certificate (SBUJK)</h5>
                                        <ul class="list-unstyled mb-0" style="font-size: 0.85rem; color: #555; max-height: 280px; overflow-y: auto;">
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41011 Construction of Residential Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41012 Construction of Office Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41013 Construction of Industrial Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41014 Construction of Shopping Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41015 Construction of Health Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41016 Construction of Educational Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41017 Construction of Lodging Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41018 Construction of Entertainment and Sports Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>41019 Construction of Other Buildings</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>42101 Construction of Civil Roadworks</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>46631 Wholesale of Metal Goods for Construction Materials</span></li>
                                            <li class="mb-2 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>46638 Wholesale of Various Kinds of Building Materials</span></li>
                                            <li class="mb-0 d-flex"><span class="me-2" style="color: #2d5a3d;">•</span><span>46639 Wholesale of Other Construction Materials</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Article of Incorporation Card -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm hover-lift" style="border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    <div class="card-body p-4 text-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px;">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <div class="rounded-circle p-2" style="background: rgba(45,90,61,0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-file-contract" style="color: #2d5a3d; font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <h5 class="card-title mb-3" style="color: #2d5a3d; font-weight: 700; font-size: 1.1rem;">ARTICLE OF<br>INCORPORATION</h5>
                                        <div class="p-3 rounded" style="background: rgba(45,90,61,0.05); border: 2px solid #2d5a3d;">
                                            <p class="mb-0 fw-bold" style="font-size: 1rem; color: #2d5a3d; letter-spacing: 0.5px;">AHU-0050193.ah.01.01.tahun 2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Business Identification Number Card -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm hover-lift" style="border-radius: 12px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                    <div class="card-body p-4 text-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px;">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <div class="rounded-circle p-2" style="background: rgba(45,90,61,0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-id-card" style="color: #2d5a3d; font-size: 1.5rem;"></i>
                                            </div>
                                        </div>
                                        <h5 class="card-title mb-3" style="color: #2d5a3d; font-weight: 700; font-size: 1.1rem;">Business Identification<br>Number (NIB)</h5>
                                        <div class="p-3 rounded" style="background: rgba(45,90,61,0.05); border: 2px solid #2d5a3d;">
                                            <p class="mb-0 fw-bold" style="font-size: 1rem; color: #2d5a3d; letter-spacing: 0.5px;">2407230101276 – 24 JULI 2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .hover-lift:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 35px rgba(45,90,61,0.15) !important;
            }
            
            @media (max-width: 768px) {
                .card-title {
                    font-size: 1rem !important;
                }
                .card-body ul {
                    font-size: 0.8rem !important;
                }
            }
        </style>

        <!-- Legality Projects Grid -->
        <section class="page-section bg-light" id="legality">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-heading text-uppercase">Certified Projects</h2>
                    <h3 class="section-subheading text-muted">View our legally certified and compliant projects</h3>
                </div>
                <div class="row" id="legality_content">
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

        <!-- Legality Modal -->
        <div class="portfolio-modal modal fade" id="legalityModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{ asset('template_fe/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <h2 id="legality_project_name" class="text-uppercase">Title</h2>
                                    <p class="item-intro text-muted"></p>
                                    
                                    <!-- Image Carousel -->
                                    <div id="legalityImageCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                                        <div class="carousel-inner" id="legality_carousel_inner">
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#legalityImageCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#legalityImageCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    
                                    <!-- Image Zoom Modal -->
                                    <div class="modal fade" id="imageZoomModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content bg-transparent border-0">
                                                <div class="modal-body p-0 position-relative">
                                                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1060; background-color: rgba(0,0,0,0.5); padding: 1rem; border-radius: 50%;"></button>
                                                    <img id="zoomedImage" src="" class="img-fluid w-100" style="max-height: 90vh; object-fit: contain; cursor: pointer;" data-bs-dismiss="modal" title="Click to close">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Subtitle:</strong>
                                            <span id="legality_location"></span>
                                        </li>
                                        <li>
                                            <strong>Waktu Update:</strong>
                                            <span id="legality_updated_at"></span>
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
        $.ajax({
            url: "{{ route('public.data') }}",
            method: 'GET',
            beforeSend: function() {
                $('.loader-overlay').css('display', 'flex');
            },
            success: function(response) {               
                let legality = response.legality;
                if (legality && legality.length > 0) {
                    $('#legality_content').empty();
                    legality.forEach(function(legality){
                        let legalityItem = `
                         <div class="col-lg-2_4 col-md-4 col-sm-6 mb-6">
                            <div class="legality-item">
                                <a class="legality-link" data-slug="${legality.slug}" data-bs-toggle="modal" href="#legalityModal">
                                    <div class="legality-hover">
                                        <div class="legality-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="/storage/${legality.image}" alt="${legality.title}"/>
                                </a>
                                <div class="legality-caption">
                                    <div class="legality-caption-heading">${legality.title}</div>
                                    <div class="legality-caption-subheading text-muted">${legality.subtitle}</div>
                                </div>
                            </div>
                        </div>`;
                        $('#legality_content').append(legalityItem);
                    });
                }
            },
            complete: function() {
                $('.loader-overlay').css('display', 'none');
            }
        });

        $(document).on('click', '.legality-link', function(e){
            e.preventDefault();
            let slug = $(this).data('slug');

            $.ajax({
                url:"{{ route('legality.detail') }}?slug="+slug,
                type:"GET",
                data:{
                    "_token":"{{ csrf_token()}}",
                },
                dataType:"JSON",
                cache:false,
                beforeSend:function(){
                    $('.loader-overlay').css('display', 'flex');
                },
                success:function(data){
                    if(data.success===1){
                        let legality = data.data;
                        let title = legality.title;
                        let subtitle = legality.subtitle;
                        let updated_at = legality.updated_at; 
                        let image = legality.image;
                        
                        let updatedAtFormatted = updated_at ? new Date(updated_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) : '-';
                        
                        $("#legality_project_name").empty().text(title || '-');
                        $("#legality_location").empty().text(subtitle || '-');
                        $("#legality_updated_at").empty().text(updatedAtFormatted);
                        
                        let carouselInner = $('#legality_carousel_inner');
                        carouselInner.empty();
                        
                        if(legality.images && legality.images.length > 0) {
                            legality.images.forEach(function(img, index) {
                                let activeClass = index === 0 ? 'active' : '';
                                let carouselItem = `
                                    <div class="carousel-item ${activeClass}">
                                        <img src="{{asset('storage/')}}/${img.image_path}" class="d-block w-100 zoom-image" alt="${title}" style="max-height: 500px; object-fit: contain; cursor: pointer;">
                                    </div>
                                `;
                                carouselInner.append(carouselItem);
                            });
                        } else {
                            carouselInner.append(`
                                <div class="carousel-item active">
                                    <img src="{{asset('storage/')}}/${image}" class="d-block w-100 zoom-image" alt="${title}" style="max-height: 500px; object-fit: contain; cursor: pointer;">
                                </div>
                            `);
                        }
                        
                        // Add click event for image zoom
                        $('.zoom-image').off('click').on('click', function() {
                            let imgSrc = $(this).attr('src');
                            $('#zoomedImage').attr('src', imgSrc);
                            $('#imageZoomModal').modal('show');
                        });
                        
                        $("#legalityModal").modal();
                    }else{
                        alert(data.message);
                    }
                },
                complete:function(){
                    $('.loader-overlay').css('display', 'none');
                }
            })
        });
    });
</script>
@endsection
