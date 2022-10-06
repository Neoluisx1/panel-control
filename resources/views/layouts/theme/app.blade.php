<!DOCTYPE html>

<html lang="es" class="light">
    <!-- BEGIN: Head -->
    <head>
        <livewire:styles />
        <meta charset="utf-8">
        <link href="{{asset('dist/images/logo.svg')}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SISTEMA POS">
        <meta name="keywords" content="VENTAS">
        <meta name="author" content="INFINITY">
        <title>SISTEMA DE VENTAS </title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('dist/css/app.css')}}" />
        <link rel="stylesheet" href="{{asset('css/all.css')}}" />
        <link rel="stylesheet" href="{{asset('css/snackbar.min.css')}}" />
        <link rel="stylesheet" href="{{asset('dist/apexcharts.css')}}" />

        <link rel="stylesheet" href="{{asset('css/mc-calendar.min.css')}}" />

        <script src="{{asset('js/kioskboard.js')}}"></script>

        <script src="{{asset('js/mc-calendar.min.js')}}"></script>



        <style>
            .image-fit>img{
                object-fit: contain!important;
            }
            nav p{
                display: none!important;
            }
        </style>
        <!-- END: CSS Assets-->
    </head>

    <!-- END: Head -->

    <body class="main">
        <!-- BEGIN: Mobile Menu -->

        @include('layouts.theme.mobile-menu')
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            @include('layouts.theme.sidebar')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                @include('layouts.theme.topbar')
                <!-- END: Top Bar -->
                {{ $slot }}
            </div>
            <!-- END: Content -->
        </div>
        <!-- BEGIN: JS Assets-->
          @include('layouts.theme.footer')
        <!-- END: JS Assets-->
        <livewire:scripts />
    </body>
</html>
