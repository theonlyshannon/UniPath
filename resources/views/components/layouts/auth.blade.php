<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        {{ $title ?? 'No Page' }}
    </title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app/images/android-chrome-512x512.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('app/images/android-chrome-512x512.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('app/images/android-chrome-512x512.png') }}" />
    <link rel="manifest" href="{{ asset('app/images/favicons/site.webmanifest') }}" />
    <meta name="description"
        content="Aplikasi persiapan perkuliahan untuk siswa menengah. Maksimalkan potensimu siapkan diri untuk memasuki dunia perkuliahan!" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cormorant:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('app/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/bootstrap-select/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/nouislider/nouislider.pips.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/tiny-slider/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/eduhive-icons/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/owl-carousel/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/vendors/owl-carousel/css/owl.theme.default.min.css') }}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('app/css/eduhive.css') }}" />
    <link rel="stylesheet" href="{{ asset('app/css/custom.css') }}" />

    @stack('app-style')
</head>

<body>

    <div class="main-wrapper" id="app">
        <div class="page-wrapper full-page">

            @include('sweetalert::alert')

            {{ $slot }}

        </div>
    </div>

    <script src="{{ asset('app/vendors/jquery/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('app/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('app/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('app/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app/vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('app/vendors/tiny-slider/tiny-slider.js') }}"></script>
    <script src="{{ asset('app/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('app/vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('app/vendors/owl-carousel/js/owlcarousel2-filter.min.js') }}"></script>
    <script src="{{ asset('app/vendors/owl-carousel/js/owlcarousel2-progressbar.js') }}"></script>
    <script src="{{ asset('app/vendors/wow/wow.js') }}"></script>
    <script src="{{ asset('app/vendors/imagesloaded/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('app/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('app/vendors/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-circleType/jquery.circleType.js') }}"></script>
    <script src="{{ asset('app/vendors/jquery-lettering/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('app/js/eduhive.js') }}"></script>

    @stack('script-app')
</body>

</html>
