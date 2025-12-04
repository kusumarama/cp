        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{ asset ('template_fe/assets/img/logo hdk putih.png')}}" alt="..." style="height: 65px; width: auto;" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">{{ app()->getLocale() == 'id' ? 'Beranda' : 'Home' }}</a></li>
                        
                        <!-- Professional dropdown - Desktop -->
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle {{ request()->is('board-of-directors') || request()->is('management') ? 'active' : '' }}" href="#" id="professionalDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ app()->getLocale() == 'id' ? 'Profesional Kami' : 'Our Professionals' }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="professionalDropdown">
                                <li><a class="dropdown-item" href="{{ route('board.index') }}">{{ app()->getLocale() == 'id' ? 'Dewan Direksi' : 'Board of Directors' }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('management.index') }}">{{ app()->getLocale() == 'id' ? 'Manajemen' : 'Management' }}</a></li>
                            </ul>
                        </li>
                        
                        <!-- Professional links - Mobile -->
                        <li class="nav-item d-lg-none">
                            <span class="nav-link disabled">{{ app()->getLocale() == 'id' ? 'Profesional Kami' : 'Our Professionals' }}</span>
                        </li>
                        <li class="nav-item d-lg-none" style="padding-left: 1rem;">
                            <a class="nav-link {{ request()->is('board-of-directors') ? 'active' : '' }}" href="{{ route('board.index') }}">{{ app()->getLocale() == 'id' ? 'Dewan Direksi' : 'Board of Directors' }}</a>
                        </li>
                        <li class="nav-item d-lg-none" style="padding-left: 1rem;">
                            <a class="nav-link {{ request()->is('management') ? 'active' : '' }}" href="{{ route('management.index') }}">{{ app()->getLocale() == 'id' ? 'Manajemen' : 'Management' }}</a>
                        </li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('portfolio') ? 'active' : '' }}" href="{{ route('portfolio.index') }}">{{ app()->getLocale() == 'id' ? 'Portofolio' : 'Portofolio' }}</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('design') ? 'active' : '' }}" href="{{ route('design.index') }}">{{ app()->getLocale() == 'id' ? 'Desain' : 'Design' }}</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->is('legality') ? 'active' : '' }}" href="{{ route('legality.index') }}">{{ app()->getLocale() == 'id' ? 'Legalitas' : 'Legality' }}</a></li>
                        <!-- <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/#about') }}">About</a></li> -->
                        
                        <!-- Language switcher - Desktop (Dropdown) -->
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-globe"></i> {{ app()->getLocale() == 'id' ? 'ID' : 'EN' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                                <li><a class="dropdown-item" href="{{ route('switch.language', 'en') }}">English</a></li>
                                <li><a class="dropdown-item" href="{{ route('switch.language', 'id') }}">Bahasa Indonesia</a></li>
                            </ul>
                        </li>
                        
                        <!-- Language switcher - Mobile (Direct links) -->
                        <li class="nav-item d-lg-none">
                            <span class="nav-link disabled"><i class="fas fa-globe"></i> {{ app()->getLocale() == 'id' ? 'Bahasa' : 'Language' }}</span>
                        </li>
                        <li class="nav-item d-lg-none" style="padding-left: 1rem;">
                            <a class="nav-link {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('switch.language', 'en') }}">English</a>
                        </li>
                        <li class="nav-item d-lg-none" style="padding-left: 1rem;">
                            <a class="nav-link {{ app()->getLocale() == 'id' ? 'active' : '' }}" href="{{ route('switch.language', 'id') }}">Bahasa Indonesia</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>