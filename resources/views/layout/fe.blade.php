<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PT Harkat Digdaya Konstruksi</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href=" {{ asset ('template_admin/img/Logo HDK.png') }}" />
        <!-- style-->
        @include('include.fe.style')
    </head>
    <body id="page-top">
        <div class="loader-overlay">
            <div class="loader"></div>
        </div>
        <!-- Navigation-->
        @include('include.fe.navbar')
        @yield('content')

        <!-- Footer-->
           @include('include.fe.footer')

        <!-- Bootstrap core JS-->
         @include('include.fe.script')
         @yield('script')


         <script>

             $(window).on('load', function() { $('.loader-overlay').fadeOut(300); });

             setTimeout(function() { $('.loader-overlay').fadeOut(300); }, 2000);

         </script>
    </body>
</html>
