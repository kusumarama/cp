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
    .prof-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    .prof-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    .prof-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .prof-photo {
        width: 100%;
        padding-top: 100%;
        background-size: cover;
        background-position: center;
        position: relative;
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
        object-fit: cover;
        margin: 0 auto 2rem;
        display: block;
        border: 5px solid #46584d;
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
        .prof-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }
    }
</style>

<div class="professionals-header">
    <div class="container">
        <h1>Board of Directors</h1>
        <p class="lead">Leading our company with vision and integrity</p>
    </div>
</div>

<section class="professionals-section">
    <div class="container">
        <div class="prof-grid" id="board-grid">
            <!-- Board members will be loaded here via AJAX -->
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
        $.ajax({
            url: "{{ route('public.data') }}",
            method: 'GET',
            beforeSend: function() {
                $('.loader-overlay').css('display', 'flex');
            },
            success: function(response) {
                if (response.professionals && response.professionals.board_of_director) {
                    const board = response.professionals.board_of_director;
                    $('#board-grid').empty();
                    
                    board.forEach(function(prof) {
                        const card = `
                            <div class="prof-card" data-bs-toggle="modal" data-bs-target="#professionalModal"
                                 data-name="${prof.name}" 
                                 data-position="${prof.position}"
                                 data-photo="/storage/${prof.photo}"
                                 data-details="${prof.details || ''}">
                                <div class="prof-photo" style="background-image: url('/storage/${prof.photo}')"></div>
                                <div class="prof-info">
                                    <div class="prof-name">${prof.name}</div>
                                    <div class="prof-position">${prof.position}</div>
                                </div>
                            </div>
                        `;
                        $('#board-grid').append(card);
                    });

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
                }
            },
            complete: function() {
                $('.loader-overlay').css('display', 'none');
            }
        });
    });
</script>
@endsection
