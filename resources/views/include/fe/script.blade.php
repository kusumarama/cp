       <script src="{{asset('template_admin/vendor/jquery/jquery.min.js')}}"></script>
       <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset ('template_fe/js/scripts.js')}}"></script>
        
        <!-- Fix mobile dropdown and close menu when clicking outside -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const navbarCollapse = document.getElementById('navbarResponsive');
                const navbarToggler = document.querySelector('.navbar-toggler');
                
                // Close navbar when clicking outside
                document.addEventListener('click', function(event) {
                    const isClickInsideNavbar = document.getElementById('mainNav').contains(event.target);
                    const isNavbarOpen = navbarCollapse.classList.contains('show');
                    
                    if (!isClickInsideNavbar && isNavbarOpen) {
                        // Use Bootstrap's collapse method to close
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
                
                // Also close navbar when clicking on any nav link (except dropdowns)
                const navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle)');
                navLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        if (navbarCollapse.classList.contains('show')) {
                            const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                                toggle: false
                            });
                            bsCollapse.hide();
                        }
                    });
                });
                
                // Prevent dropdown from closing when clicking inside on mobile
                const languageDropdown = document.getElementById('languageDropdown');
                if (languageDropdown) {
                    languageDropdown.addEventListener('click', function(e) {
                        if (window.innerWidth < 992) {
                            e.stopPropagation();
                        }
                    });
                }
                
                // Keep navbar open when switching language on mobile
                const dropdownItems = document.querySelectorAll('#languageDropdown + .dropdown-menu .dropdown-item');
                dropdownItems.forEach(function(item) {
                    item.addEventListener('click', function(e) {
                        // Let the link work normally, don't prevent default
                        e.stopPropagation();
                    });
                });
            });
        </script>
        