<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>@yield('titulo')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="/admin/img/favicon.png" />
        <!--===============================================================================================-->
        <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/admin/css/ruang-admin.min.css" rel="stylesheet">
        <!--===============================================================================================-->
    </head>

    <body class="bg-gradient-login">

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Login Content -->
        <script src="/admin/vendor/jquery/jquery.min.js"></script>
        <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="/admin/js/ruang-admin.min.js"></script>

    </body>

</html>
