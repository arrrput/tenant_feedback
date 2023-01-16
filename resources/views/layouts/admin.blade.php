<html>
    <head>
                <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            @yield('title')
        </title>
        {{-- Style --}}
        @stack('prepend-style')
        @include('includes.style')
        @stack('addon-style')
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
         <!-- Fonts -->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireStyles
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
 </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
         
      <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ URL::asset('backend/img/ic_logo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>
  
  {{-- {{Navbar}} --}}
  @include('includes.header')
  
  {{-- sidebar --}}
  @include('includes.sidebar')

  {{-- Content --}}
  @yield('content')
  
  {{-- footer --}}

  @include('includes.footer')
    
  
  {{-- Script --}}
    
        @include('includes.script')
        @stack('prepend-script')
        @stack('addon-script')
        @livewireChartsScripts
        @livewireScripts
 </body>
 
</html>


{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}
