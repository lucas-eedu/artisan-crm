<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- Theme Style -->
        <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
        <!-- Custom Artisan Theme Style -->
        <link rel="stylesheet" href="{{ asset('template/dist/css/custom-artisan.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">

            {{-- NavBar --}}
            @include('layouts.navigation')

            {{-- Content --}}
            @yield('content')

            {{-- Footer --}}
            @include('layouts.footer')
            
        </div>

        <!-- jQuery -->
        <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
        <!-- Jquery Mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <!-- Initialize select2.js -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()
            })
        </script>
        <!-- Phone Mask -->
        <script>
            var phoneMaskBehavior = function(val) {
                    return val.replace(/\D/g, '').length <= 10 ? '(00) 0000-00009' : '(00) 0.0000.0000';
                },
                phoneMaskOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(phoneMaskBehavior.apply({}, arguments), options);
                    }
                };
            $(function() {
                $(':input[name=phone]').mask(phoneMaskBehavior, phoneMaskOptions);
            })
        </script>
        @yield('scripts')
    </body>

</html>