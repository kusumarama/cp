<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset ('template_admin/img/Logo HDK.png')}}" class = "rounded" alt="...." width="50px">
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request ::is('editor')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <span class="sidebar-heading small mb-1 mt-2 sticky-top text-white bg-primary py-2 px-3 text-center size=14">
                FrontEnd</span>
            
            <!-- Core Content Section -->
            <span class="sidebar-subheading small mb-2 mt-3 text-white px-3 font-weight-bold" style="font-size: 11px; opacity: 0.8;">
                <i class="fas fa-fw fa-layer-group"></i> Core Content
            </span>
            
            <li class="nav-item {{ Request ::is('editor/master-head')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.master-head') }}">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Hero / MasterHead</span></a>
            </li>
            
            <li class="nav-item {{ Request ::is('editor/service')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.service') }}">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Services</span></a>
            </li>
            
            <li class="nav-item {{ Request ::is('editor/about')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.about') }}">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>About</span></a>
            </li>
            
            <li class="nav-item {{ Request ::is('editor/statistic*')? 'active' : '' }}">
                <a class="nav-link" href="{{route('statistic.index') }}">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Statistics</span></a>
            </li>
            
            <!-- Team Section -->
            <span class="sidebar-subheading small mb-2 mt-3 text-white px-3 font-weight-bold" style="font-size: 11px; opacity: 0.8;">
                <i class="fas fa-fw fa-people-carry"></i> Team & Staff
            </span>
            
            <li class="nav-item {{ Request ::is('editor/users')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.user') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span></a>
            </li>
            
            <li class="nav-item {{ Request ::is('editor/professional*')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.professional') }}">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>Our Professionals</span></a>
            </li>
            
            <!-- Projects & Portfolio -->
            <span class="sidebar-subheading small mb-2 mt-3 text-white px-3 font-weight-bold" style="font-size: 11px; opacity: 0.8;">
                <i class="fas fa-fw fa-project-diagram"></i> Projects
            </span>
            
            <li class="nav-item {{ Request ::is('editor/portofolio')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.portofolio') }}">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Portfolio</span></a>
            </li>
            
            <li class="nav-item {{ Request ::is('editor/design')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.design') }}">
                    <i class="fas fa-fw fa-pencil-ruler"></i>
                    <span>Design</span></a>
            </li>
            
            <li class="nav-item {{ Request ::is('editor/legality')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.legality') }}">
                    <i class="fas fa-fw fa-gavel"></i>
                    <span>Legality</span></a>
            </li>
            
            <!-- Certifications & Standards -->
            <span class="sidebar-subheading small mb-2 mt-3 text-white px-3 font-weight-bold" style="font-size: 11px; opacity: 0.8;">
                <i class="fas fa-fw fa-certificate"></i> Certifications
            </span>
            
            <li class="nav-item {{ Request ::is('editor/iso-certification')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.iso-certification') }}">
                    <i class="fas fa-fw fa-star"></i>
                    <span>ISO Standards</span></a>
            </li>
            
            <!-- Relationships -->
            <span class="sidebar-subheading small mb-2 mt-3 text-white px-3 font-weight-bold" style="font-size: 11px; opacity: 0.8;">
                <i class="fas fa-fw fa-handshake"></i> Relationships
            </span>
            
            <li class="nav-item {{ Request ::is('editor/client')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.client') }}">
                    <i class="fas fa-fw fa-handshake"></i>
                    <span>Clients</span></a>
            </li>
            
            <li class="nav-item {{ Request ::is('editor/contact')? 'active' : '' }}">
                <a class="nav-link" href="{{route('editor.contact') }}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Contact Messages</span></a>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <span class="sidebar-heading small mb-1 mt-2 sticky-top text-white bg-primary py-2 px-3 text-center size=14">
                SI Pelaporan Mingguan</span>
            <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Menu 1</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Menu 2</span></a>
            </li>

            </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Menu 3</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Menu 4</span></a>
            </li>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle">
                </button>
            </div>

        </ul>