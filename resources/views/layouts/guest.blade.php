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
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
   </head>
   <body class="hold-transition login-page">

      {{-- Content --}}
      @yield('content')

      <!-- jQuery -->
      <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- Select2 -->
      <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
      <!-- Initialize select2.js -->
      <script>
         $(function () {
           //Initialize Select2 Elements
           $('.select2').select2()
         })
      </script>
   </body>
</html>