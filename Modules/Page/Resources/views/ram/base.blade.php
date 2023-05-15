<!doctype html>
<html lang="ar">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- favicons -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{latest('/web/assets/images/favicons/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{latest('/web/assets/images/favicons/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{latest('/web/assets/images/favicons/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{latest('/web/assets/images/favicons/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{latest('/web/assets/images/favicons/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{latest('/web/assets/images/favicons/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{latest('/web/assets/images/favicons/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{latest('/web/assets/images/favicons/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{latest('/web/assets/images/favicons/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{latest('/web/assets/images/favicons/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{latest('/web/assets/images/favicons/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{latest('/web/assets/images/favicons/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{latest('/web/assets/images/favicons/favicon-16x16.png')}}">
        <link rel="manifest" href="{{latest('/web/assets/images/favicons/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{latest('/web/assets/images/favicons/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
        <!-- css -->
        <link rel="stylesheet" href="{{latest('/web/assets/css/app.css')}}">
        <!-- title -->
        <title>عيادات رام</title>
        <!-- seo -->
        <meta name="description" content="description">
        <meta name="keywords" content="keywords">
        @yield('scripts')

    </head>

    <body>



        @yield('content')

        <script src="{{latest('/web/assets/js/app.min.js')}}"></script>

        @routes

        @yield('submit.scripts')
    </body>

</html>
