
@extends('layout.fe')
@section('content') 
<style>
    /* Fixed navbar - no shrink on design page */
    #mainNav {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        background-color: #212529 !important;
    }
    #mainNav .navbar-brand img {
        height: 65px !important;
    }
    #mainNav.navbar-shrink {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    #mainNav.navbar-shrink .navbar-brand img {
        height: 65px !important;
    }

    /* design section spacing */
    #design {
        padding-top: 8rem !important;
    }

    /* design item styling with border */
    .design-item {
        border: 4px solid #2d5a3d;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
    }

    .design-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .design-link {
        display: block;
        position: relative;
    }

    .design-hover {
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

    .design-item:hover .design-hover {
        opacity: 1;
    }

    .design-hover-content {
        color: white;
        font-size: 2rem;
    }

    .design-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .design-caption {
        padding: 1.5rem;
        background: white;
    }

    .design-caption-heading {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d5a3d;
        margin-bottom: 0.5rem;
    }

    .design-caption-subheading {
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
        
         <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="design">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Design</h2>
                    <h3 class="section-subheading text-muted">Witness our finest works. From conceptualization to completion, we pride ourselves on delivering projects that define new standards in design and construction. Find inspiration and proof of our quality in every detail.</h3>
                </div>
                <div class="row" id="design_content">
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

        <!-- design Modals-->
        <!-- design item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="designModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="{{ asset('template_fe/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 id="design_project_name" class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted"></p>
                                    
                                    <!-- Image Carousel -->
                                    <div id="designImageCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                                        <div class="carousel-inner" id="design_carousel_inner">
                                            <!-- Images will be loaded here dynamically -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#designImageCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#designImageCarousel" data-bs-slide="next">
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
                                            <strong>Location:</strong>
                                            <span id="design_location"></span>
                                        </li>
                                        <li>
                                            <strong>Owner:</strong>
                                            <span id="design_owner_project"></span>
                                        </li>
                                        <li>
                                            <strong>Jenis Bangunan:</strong>
                                            <span id="design_jenis_bangunan"></span>
                                        </li>
                                        <li>
                                            <strong>Waktu Mulai:</strong>
                                            <span id="design_waktu"></span>
                                        </li>
                                        <li>
                                            <strong>Waktu Update:</strong>
                                            <span id="design_updated_at"></span>
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
                let design = response.design;
                // masterhead can be an array (multiple slides) or a single object
                if (design && design.length > 0) {
                    $('#design_content').empty();
                    design.forEach(function(design){
                        let designItem = `
                         <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="design-item">
                                <a class="design-link" data-slug="${design.slug}" data-bs-toggle="modal" href="#designModal">
                                    <div class="design-hover">
                                        <div class="design-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="/storage/${design.image}" alt="${design.project_name}" height="450px"/>
                                </a>
                                <div class="design-caption">
                                    <div class="design-caption-heading">${design.project_name}</div>
                                    
                                    <div class="design-caption-subheading text-muted">Lokasi : ${design.location}</div>
                                </div>
                            </div>
                        </div>`;
                        $('#design_content').append(designItem);
                    });
                }
            },
            complete: function() {
                // Hide the loader overlay after the request is complete
                $('.loader-overlay').css('display', 'none');
            }
        });
        $(document).on('click', '.design-link', function(e){
            e.preventDefault();
            let slug = $(this).data('slug');
            // alert(slug);

            $.ajax({
                url:"{{ route('design.detail') }}?slug="+slug,
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
                        let design = data.data;
                        let project_name = design.project_name;
                        // let status = design.status;
                        let location = design.location;
                        let owner_project = design.owner_project;
                        // let alamat = design.alamat;
                        // let nilai_kontrak = design.nilai_kontrak;
                        let jenis_bangunan = design.jenis_bangunan;
                        let waktu = design.waktu;
                        // let status_update = design.status_update;
                        let updated_at = design.updated_at; 
                        let image = design.image;
                        
                        let waktuFormatted = waktu ? new Date(waktu).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) : '-';
                        let updatedAtFormatted = updated_at ? new Date(updated_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) : '-';
                        
                        $("#design_project_name").empty().text(project_name || '-');
                        // $("#design_status").empty().text(status || 'undefined');
                        $("#design_location").empty().text(location || '-');
                        $("#design_owner_project").empty().text(owner_project || '-');
                        // $("#design_alamat").empty().text(alamat);
                        // $("#design_nilai_kontrak").empty().text(nilai_kontrak);
                        $("#design_jenis_bangunan").empty().text(jenis_bangunan || '-');
                        $("#design_waktu").empty().text(waktuFormatted);
                        // $("#design_status_update").empty().text(status_update);
                        $("#design_updated_at").empty().text(updatedAtFormatted);
                        
                        // Populate image carousel
                        let carouselInner = $('#design_carousel_inner');
                        carouselInner.empty();
                        
                        if(design.images && design.images.length > 0) {
                            design.images.forEach(function(img, index) {
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
                        
                        $("#designModal").modal
                        

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
