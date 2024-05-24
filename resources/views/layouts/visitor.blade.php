<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> @yield('page_title') - {{ env('APP_NAME') }}</title>

    <!-- twitter card starts from here, if you don't need remove this section -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@yourtwitterusername" />
    <meta name="twitter:creator" content="@yourtwitterusername" />
    <meta name="twitter:url" content="http://twitter.com" />
    <meta name="twitter:title" content="@yield('page_title') - {{ env('APP_NAME') }}" />
    <!-- maximum 140 char -->
    <meta name="twitter:description" content="Your site description, maximum 140 char " />
    <!-- maximum 140 char -->
    <meta name="twitter:image" content="/visitor/assets/images/twittercardimg/twittercard-144-144.png" />
    <!-- when you post this page url in twitter , this image will be shown -->
    <!-- twitter card ends here -->

    <!-- facebook open graph starts from here, if you don't need then delete open graph related  -->
    <meta property="og:title" content="@yield('page_title') - {{ env('APP_NAME') }}" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:locale" content="en_UK" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <!--meta property="fb:admins" content="" /-->
    <!-- use this if you have  -->
    <meta property="og:type" content="website" />
    <!-- 'article' for single page  -->
    <meta property="og:image" content="/visitor/assets/images/opengraph/fbphoto-476-476.png" />
    <!-- when you post this page url in facebook , this image will be shown -->
    <!-- facebook open graph ends here -->

    <!-- desktop bookmark -->
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="/visitor/assets/images/favicon/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />

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


    <!-- Dependency Styles -->
    <link id="style-bundle" rel="stylesheet" href="/visitor/assets/vendors/css/bundle.css" type="text/css" />

    <!-- Site Stylesheet -->
    <link id="cbx-style" rel="stylesheet" href="/visitor/assets/css/style-default.css" type="text/css" />

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet" />

    @yield('css')

</head>

<body id="home-v1" class="home-page-one" data-style="default">
    <a href="index.html#" class="scroll-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <div id="main_content" class="main-content">


        <!--=========================-->
        <!--=        Navbar         =-->
        <!--=========================-->
        @include('components.visitory.header')
        <!-- /.site-header -->

        @yield('content')

        <!--=========================-->
        <!--=        Footer         =-->
        <!--=========================-->
        @include('components.visitory.footer')



    </div>
    <!-- /#site -->


    <!-- Dependency Scripts -->
    <script id="script-bundle" src="/visitor/assets/vendors/js/bundle.js"></script>

    <!-- Site Scripts -->
    <script src="/visitor/assets/js/app.js"></script>

    @yield('js')
</body>

</html>
