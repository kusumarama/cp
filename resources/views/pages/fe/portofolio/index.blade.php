
@extends('layout.fe')
@section('content') 
<style>
    /* Transparent navbar at top, solid on scroll */
    #mainNav {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
        background-color: transparent !important;
        transition: all 0.3s ease;
    }
    
    #mainNav.navbar-shrink {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        background-color: #212529 !important;
    }
    
    #mainNav .navbar-brand img {
        height: 65px !important;
    }
    
    #mainNav.navbar-shrink .navbar-brand img {
        height: 50px !important;
    }

    /* Portfolio section spacing */
    #portfolio {
        padding-top: 8rem !important;
    }
    
    @media (max-width: 768px) {
        #portfolio {
            padding-top: 6rem !important;
        }
    }

    /* Portfolio item styling with border */
    .portfolio-item {
        border: 4px solid #2d5a3d;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
    }

    .portfolio-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .portfolio-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        object-position: center;
    }

    .portfolio-caption {
        padding: 1.5rem;
        background: white;
    }

    .portfolio-caption-heading {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d5a3d;
        margin-bottom: 0.5rem;
        word-wrap: break-word;
    }

    .portfolio-caption-subheading {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    /* Mobile optimization */
    @media (max-width: 768px) {
        .portfolio-item img {
            height: 250px;
        }
        
        .portfolio-caption-heading {
            font-size: 1rem;
            line-height: 1.3;
        }
        
        .portfolio-caption-subheading {
            font-size: 0.85rem;
        }
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
    
    .carousel-inner img {
        object-fit: contain !important;
        background: white;
    }
    
    @media (max-width: 768px) {
        .carousel-inner img {
            max-height: 350px !important;
        }
        
        .modal-dialog {
            margin: 0.5rem;
        }
        
        .modal-body {
            padding: 1rem;
        }
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
        
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Portofolio</h2>
                    <h3 class="section-subheading text-muted">Witness our finest works. From conceptualization to completion, we pride ourselves on delivering projects that define new standards in design and construction. Find inspiration and proof of our quality in every detail.</h3>
                </div>
                <div class="row" id="portofolio_content">
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
                                    <h2 id="portofolio_project_name" class="text-uppercase" style="word-wrap: break-word; overflow-wrap: break-word; hyphens: auto;">Project Name</h2>
                                    <p class="item-intro text-muted"></p>
                                    
                                    <!-- Image Carousel -->
                                    <div id="portfolioImageCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                                        <div class="carousel-inner" id="portfolio_carousel_inner">
                                            <!-- Images will be loaded here dynamically -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#portfolioImageCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#portfolioImageCarousel" data-bs-slide="next">
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
                let portofolio = response.portofolio;
                // masterhead can be an array (multiple slides) or a single object
                if (portofolio && portofolio.length > 0) {
                    $('#portofolio_content').empty();
                    portofolio.forEach(function(portofolio){
                        let portofolioItem = `
                         <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-slug="${portofolio.slug}" data-bs-toggle="modal" href="#portfolioModal">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="/storage/${portofolio.image}" alt="${portofolio.project_name}" height="450px"/>
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">${portofolio.project_name}</div>
                                    <div class="portfolio-caption-subheading text-muted">Status : ${portofolio.status}</div>
                                    <div class="portfolio-caption-subheading text-muted">Lokasi : ${portofolio.location}</div>
                                </div>
                            </div>
                        </div>`;
                        $('#portofolio_content').append(portofolioItem);
                    });
                }
            },
            complete: function() {
                // Hide the loader overlay after the request is complete
                $('.loader-overlay').css('display', 'none');
            }
        });
        $(document).on('click', '.portfolio-link', function(e){
            e.preventDefault();
            let slug = $(this).data('slug');
            // alert(slug);

            $.ajax({
                url:"{{ route('detail') }}?slug="+slug,
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
                        let portofolio = data.data;
                        let project_name = portofolio.project_name;
                        let status = portofolio.status;
                        let location = portofolio.location;
                        let owner_project = portofolio.owner_project;
                        let alamat = portofolio.alamat;
                        let nilai_kontrak = portofolio.nilai_kontrak;
                        let jenis_bangunan = portofolio.jenis_bangunan;
                        let waktu = portofolio.waktu;
                        let status_update = portofolio.status_update;
                        let updated_at = portofolio.updated_at; 
                        let image = portofolio.image;
                        
                        let waktuFormatted = new Date(waktu).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                        let updatedAtFormatted = new Date(updated_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
                        
                        $("#portofolio_project_name").empty().text(project_name);
                        $("#portofolio_status").empty().text(status);
                        $("#portofolio_location").empty().text(location);
                        $("#portofolio_owner_project").empty().text(owner_project);
                        $("#portofolio_alamat").empty().text(alamat);
                        $("#portofolio_nilai_kontrak").empty().text(nilai_kontrak);
                        $("#portofolio_jenis_bangunan").empty().text(jenis_bangunan);
                        $("#portofolio_waktu").empty().text(waktuFormatted);
                        $("#portofolio_status_update").empty().text(status_update);
                        $("#portofolio_updated_at").empty().text(updatedAtFormatted);
                        
                        // Populate image carousel
                        let carouselInner = $('#portfolio_carousel_inner');
                        carouselInner.empty();
                        
                        if(portofolio.images && portofolio.images.length > 0) {
                            portofolio.images.forEach(function(img, index) {
                                let activeClass = index === 0 ? 'active' : '';
                                let carouselItem = `
                                    <div class="carousel-item ${activeClass}">
                                        <img src="{{asset('storage/')}}/${img.image_path}" class="d-block w-100 zoom-image" alt="${project_name}" style="max-height: 500px; object-fit: contain; cursor: pointer;">
                                    </div>
                                `;
                                carouselInner.append(carouselItem);
                            });
                        } else {
                            // Fallback to main image if no additional images
                            carouselInner.append(`
                                <div class="carousel-item active">
                                    <img src="{{asset('storage/')}}/${image}" class="d-block w-100 zoom-image" alt="${project_name}" style="max-height: 500px; object-fit: contain; cursor: pointer;">
                                </div>
                            `);
                        }
                        
                        // Add click event for image zoom
                        $('.zoom-image').off('click').on('click', function() {
                            let imgSrc = $(this).attr('src');
                            $('#zoomedImage').attr('src', imgSrc);
                            $('#imageZoomModal').modal('show');
                        });
                        
                        $("#portfolioModal").modal
                        

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
<style>
    /* Mobile responsive fix for project titles */
    @media (max-width: 768px) {
        #portofolio_project_name {
            font-size: 1.5rem !important;
            line-height: 1.3 !important;
            word-break: break-word;
        }
        
        .modal-body h2 {
            font-size: 1.5rem !important;
        }
    }
    
    @media (max-width: 576px) {
        #portofolio_project_name {
            font-size: 1.2rem !important;
        }
    }
</style>
@endsection