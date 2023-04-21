<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" />
</head>

<body>
<div id="cover-spin"></div>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="{{route('home')}}">
                    <!-- <img src="../../assets/images/logo.svg" alt="logo" /> -->
                    <h1 class="text-white">Notification</h1>
                </a>
                <a class="sidebar-brand brand-logo-mini" href="{{route('home')}}">
                    <!-- <img src="../../assets/images/logo-mini.svg" alt="logo" /> -->
                    <h1 class="text-white">N</h1>
                </a>
            </div>
            @include('layouts.includes.sidemenu')
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_navbar.html -->
            @include('layouts.includes.topmenu')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                @include('layouts.includes.flash-message')
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                @include('layouts.includes.footer')
                <!-- partial:../../partials/_footer.html -->
                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> 
    <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/js/misc.js')}}"></script>
    <script src="{{ asset('assets/js/settings.js')}}"></script>
    <script src="{{ asset('assets/js/todolist.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    @yield('script')
    <!-- endinject -->
</body>

</html>