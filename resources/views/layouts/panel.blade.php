<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('page_title') - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- icons & favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="/visitor/assets/images/favicon/favicon.ico" />
    <!-- this icon shows in browser toolbar -->
    <link rel="icon" type="image/x-icon" href="/visitor/assets/images/favicon/favicon.ico" />
    <!-- this icon shows in browser toolbar -->
    <link rel="apple-touch-icon" sizes="57x57" href="/visitor/assets/images/favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="/visitor/assets/images/favicon/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/visitor/assets/images/favicon/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/visitor/assets/images/favicon/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/visitor/assets/images/favicon/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/visitor/assets/images/favicon/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/visitor/assets/images/favicon/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/visitor/assets/images/favicon/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/visitor/assets/images/favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192"
        href="/visitor/assets/images/favicon/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/visitor/assets/images/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="/visitor/assets/images/favicon/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/visitor/assets/images/favicon/favicon-16x16.png" />

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    @yield('style')

</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <x-topnav />

        <!-- ========== Left Sidebar Start ========== -->
        @if (Request::segment(1) == 'member')
            <x-sidenav_member />
        @elseif (Request::segment(1) == 'finance')
            <x-sidenav_finance />
        @endif
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')

            <x-footer />
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.js"></script>

    @yield('script')
</body>

</html>
