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
        border: 5px solid #46584d;`r`n        background: #f8f9fa;
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
</style>

<div class="professionals-header">
    <div class="container">
        <h1>Board of Directors</h1>
        <p class="lead">Leading our company with vision and integrity</p>
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
                <div class="prof-card" data-bs-toggle="modal" data-bs-target="#professionalModal" 
                     data-name="{{ $professional->name }}" 
                     data-position="{{ $professional->position }}" 
                     data-photo="{{ asset('storage/' . $professional->photo) }}" 
                     data-details="{{ $professional->details }}">
                    <img src="{{ asset('storage/' . $professional->photo) }}" alt="{{ $professional->name }}" class="prof-photo">
                    <div class="prof-info">
                        <h3 class="prof-name">{{ $professional->name }}</h3>
                        <p class="prof-position">{{ $professional->position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($presidentDirector->count() > 0)
            <div class="hierarchy-row middle">
                @foreach($presidentDirector as $professional)
                <div class="prof-card" data-bs-toggle="modal" data-bs-target="#professionalModal" 
                     data-name="{{ $professional->name }}" 
                     data-position="{{ $professional->position }}" 
                     data-photo="{{ asset('storage/' . $professional->photo) }}" 
                     data-details="{{ $professional->details }}">
                    <img src="{{ asset('storage/' . $professional->photo) }}" alt="{{ $professional->name }}" class="prof-photo">
                    <div class="prof-info">
                        <h3 class="prof-name">{{ $professional->name }}</h3>
                        <p class="prof-position">{{ $professional->position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($directors->count() > 0)
            <div class="hierarchy-row bottom">
                @foreach($directors as $professional)
                <div class="prof-card" data-bs-toggle="modal" data-bs-target="#professionalModal" 
                     data-name="{{ $professional->name }}" 
                     data-position="{{ $professional->position }}" 
                     data-photo="{{ asset('storage/' . $professional->photo) }}" 
                     data-details="{{ $professional->details }}">
                    <img src="{{ asset('storage/' . $professional->photo) }}" alt="{{ $professional->name }}" class="prof-photo">
                    <div class="prof-info">
                        <h3 class="prof-name">{{ $professional->name }}</h3>
                        <p class="prof-position">{{ $professional->position }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
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
