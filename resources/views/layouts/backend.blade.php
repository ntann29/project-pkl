<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Pengaduan dan Saran</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('backend/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/styles.min.css') }}" />
    @yield('style')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <!--  App Topstrip -->
        @include('layouts.componen_backend.header')
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                
                <!-- Sidebar navigation-->
                @include('layouts.componen_backend.sidebar')
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.componen_backend.header')
            <!--  Header End -->
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('backend/js/app.min.js') }}"></script>
    <script src="{{ asset('backend/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('backend/js/dashboard.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
    
</body>

</html>