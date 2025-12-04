        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset ('template_fe/css/styles.css') }}?v={{ time() }}" rel="stylesheet" />
        <link href="{{ asset ('template_fe/css/loader.css')}}" rel="stylesheet" />
        
        <style>
            /* Mobile language switcher */
            @media (max-width: 991.98px) {
                .navbar-collapse .nav-link.disabled {
                    opacity: 0.6;
                    font-size: 0.85rem;
                    padding-top: 0.75rem;
                    padding-bottom: 0.25rem;
                    cursor: default;
                }
                
                .navbar-collapse .dropdown-menu {
                    position: static !important;
                    transform: none !important;
                    border: none;
                    background-color: transparent;
                    padding-left: 1rem;
                }
                
                .navbar-collapse .dropdown-menu .dropdown-item {
                    color: rgba(255, 255, 255, 0.7);
                    padding: 0.5rem 1rem;
                }
                
                .navbar-collapse .dropdown-menu .dropdown-item:hover {
                    color: #ffc800;
                    background-color: transparent;
                }
                
                .navbar-nav .dropdown-toggle::after {
                    vertical-align: middle;
                }
            }
        </style>