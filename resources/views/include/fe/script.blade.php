       <script src="{{asset('template_admin/vendor/jquery/jquery.min.js')}}"></script>
       <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset ('template_fe/js/scripts.js')}}"></script>
        
        <!-- Fix mobile dropdown -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
        