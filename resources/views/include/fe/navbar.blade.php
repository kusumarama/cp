        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{ asset ('template_fe/assets/img/logo hdk putih.png')}}" alt="..." style="height: 65px; width: auto;" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('portfolio') ? 'active' : '' }}" href="{{ route('portfolio.index') }}">Portofolio</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('design') ? 'active' : '' }}" href="{{ route('design.index') }}">Design</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('legality') ? 'active' : '' }}" href="{{ route('legality.index') }}">Legality</a></li>
                        <!-- <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/#about') }}">About</a></li> -->
                    </ul>
                </div>
            </div>
        </nav>