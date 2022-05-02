<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- CDN Tailwind CSS -->
      <script src="https://cdn.tailwindcss.com"></script>
      <!-- Select2 -->
      <link rel="stylesheet" href="{{ asset('artisancrmv1/assets/plugins/select2/css/select2.min.css') }}">
      <!-- Main CSS -->
      <link rel="stylesheet" href="{{ asset('artisancrmv1/assets/css/main.css') }}">
   </head>
   <body>

      {{-- Content --}}
      @yield('content')

      {{-- Scripts --}}
      @yield('scripts')
      
   </body>
</html>