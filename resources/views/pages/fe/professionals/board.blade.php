@extends('layout.fe')
@section('content')
<style>
    .professionals-header {
        background: linear-gradient(135deg, #46584d 0%, #2d3a32 100%);
        padding: 120px 0 60px;
        color: white;
        text-align: center;
    }
    .professionals-header h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .professionals-section {
        padding: 80px 0;
        background: #f8f9fa;
    }
    .board-hierarchy {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    .hierarchy-row {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        margin-bottom: 4rem;
        gap: 2rem;
        flex-wrap: wrap;
    }
    .prof-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        max-width: 300px;
        flex: 0 1 auto;
    }
    .hierarchy-row.top .prof-card {
        max-width: 350px;
    }
    .prof-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .prof-photo {
        width: 100%;
        height: 320px;
        object-fit: contain;
        object-position: center;
        display: block;
        background: #f8f9fa;
    }
    .prof-info {
        padding: 1.5rem;
        text-align: center;
    }
    .prof-name {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3a32;
        margin-bottom: 0.5rem;
    }
    .prof-position {
        color: #46584d;
        font-size: 1rem;
        font-weight: 500;
    }
    .modal-photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: contain;
        margin: 0 auto 2rem;
        display: block;
        border: 5px solid #46584d;
        background: #f8f9fa;
    }
    .modal-title {
        color: #2d3a32;
        font-weight: 700;
    }
    .modal-subtitle {
        color: #46584d;
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }
    @media (max-width: 768px) {
        .professionals-header h1 {
            font-size: 2rem;
        }
        .hierarchy-row {
            margin-bottom: 2rem;
        }
        .prof-card {
            max-width: 250px;
        }
        .prof-photo {
            height: 280px;
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

<div class="professionals-header">
    <div class="container">
        <h1>{{ app()->getLocale() == 'id' ? 'Dewan Direksi' : 'Board of Directors' }}</h1>
        <p class="lead">{{ app()->getLocale() == 'id' ? 'Memimpin perusahaan kami dengan visi dan integritas' : 'Leading our company with vision and integrity' }}</p>
    </div>
</div>

<section class="professionals-section">
    <div class="container">
        <div class="board-hierarchy">
            @php
                // Group professionals by hierarchy level
                $presidentCommissioner = $professionals->where('position', 'President Commissioner')->sortBy('order');
                $presidentDirector = $professionals->where('position', 'President Director')->sortBy('order');
                $directors = $professionals->whereIn('position', ['Director', 'Independent Director', 'Independent Commissioner'])->sortBy('order');
            @endphp

            @if($presidentCommissioner->count() > 0)
            <div class="hierarchy-row top">
                @foreach($presidentCommissioner as $professional)
                @php
                    $position = $locale === 'id' ? ($professional->position_id ?? $professional->position) : $professional->position;
                @endphp
                <div class="prof-card" data-bs-toggle="modal" data-bs-target="#professionalModal" 
                     data-name="{{ $professional->name }}" 
                     data-position="{{ $position }}" 
                     data-photo="{{ asset('storage/' . $professional->photo) }}" 
                     data-details="{{ $professional->details }}">
                    <img src="{{ asset('storage/' . $professional->photo) }}" alt="{{ $professional->name }}" class="prof-photo">
                    <div class="prof-info">
                        <h3 class="prof-name">{{ $professional->name }}</h3>
                        <p class="prof-position">{{ $position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($presidentDirector->count() > 0)
            <div class="hierarchy-row middle">
                @foreach($presidentDirector as $professional)
                @php
                    $position = $locale === 'id' ? ($professional->position_id ?? $professional->position) : $professional->position;
                @endphp
                <div class="prof-card" data-bs-toggle="modal" data-bs-target="#professionalModal" 
                     data-name="{{ $professional->name }}" 
                     data-position="{{ $position }}" 
                     data-photo="{{ asset('storage/' . $professional->photo) }}" 
                     data-details="{{ $professional->details }}">
                    <img src="{{ asset('storage/' . $professional->photo) }}" alt="{{ $professional->name }}" class="prof-photo">
                    <div class="prof-info">
                        <h3 class="prof-name">{{ $professional->name }}</h3>
                        <p class="prof-position">{{ $position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($directors->count() > 0)
            <div class="hierarchy-row bottom">
                @foreach($directors as $professional)
                @php
                    $position = $locale === 'id' ? ($professional->position_id ?? $professional->position) : $professional->position;
                @endphp
                <div class="prof-card" data-bs-toggle="modal" data-bs-target="#professionalModal" 
                     data-name="{{ $professional->name }}" 
                     data-position="{{ $position }}" 
                     data-photo="{{ asset('storage/' . $professional->photo) }}" 
                     data-details="{{ $professional->details }}">
                    <img src="{{ asset('storage/' . $professional->photo) }}" alt="{{ $professional->name }}" class="prof-photo">
                    <div class="prof-info">
                        <h3 class="prof-name">{{ $professional->name }}</h3>
                        <p class="prof-position">{{ $position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
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

<!-- Modal -->
<div class="modal fade" id="professionalModal" tabindex="-1" aria-labelledby="professionalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <img src="" alt="" class="modal-photo" id="modal-photo">
                <h2 class="modal-title" id="modal-name"></h2>
                <p class="modal-subtitle" id="modal-position"></p>
                <div class="text-start" id="modal-details"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Modal handler
        $('.prof-card').on('click', function() {
            const name = $(this).data('name');
            const position = $(this).data('position');
            const photo = $(this).data('photo');
            const details = $(this).data('details');
            
            $('#modal-name').text(name);
            $('#modal-position').text(position);
            $('#modal-photo').attr('src', photo).attr('alt', name);
            $('#modal-details').html(details ? '<p>' + details + '</p>' : '<p class="text-muted">No additional information available.</p>');
        });
    });
</script>
@endsection
