<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- third party css -->
    <link href="{{ asset('css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app-modern.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('css/app-modern-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="loading" data-layout="detached"
    data-layout-config='{"leftSidebarCondensed":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <!-- Topbar Start -->
    @include('admin.layouts.topbar')
    <!-- end Topbar -->

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Begin page -->
        <div class="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.layouts.sidebar')
            <!-- Left Sidebar End -->

            <div class="content-page">
                <div class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title d-flex justify-content-between align-items-center">
                                    @yield('title')
                                </h4>
                            </div>
                        </div>

                    </div>
                    @yield('content')
                </div>
                <!-- End Content -->

                <!-- Footer Start -->
                @include('admin.layouts.footer')
                <!-- end Footer -->

            </div> <!-- content-page -->

        </div> <!-- end wrapper-->
    </div>
    <!-- END Container -->


    <!-- Right Sidebar -->
    @include('admin.layouts.rightbar')

    <!-- /Right-bar -->


    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src=" {{ asset('js/app.min.js') }}"></script>

    <!-- third party js -->
    <script src="{{ asset('js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('js/pages/demo.dashboard.js') }}"></script>
    <!-- plugin js -->
    <script src="{{ asset('js/vendor/dropzone.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('js/ui/component.fileupload.js') }}"></script>
     <script src="{{ asset('js/main.js') }}"></script>
    @stack('js')
    <!-- end demo js-->
</body>

</html>
