<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ESAB</title>

    <!-- Favicons -->
    <link href="{{ adminAsset('img/favicon.png') }}" rel="icon">
    <link href="{{ adminAsset('img/favicon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ adminAsset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ adminAsset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ adminAsset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ adminAsset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ adminAsset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ adminAsset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ adminAsset('vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ adminAsset('css/style.css') }}" rel="stylesheet">

    @stack('header')

</head>

<body class="{{ $body_class }}">

    @yield('content')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ adminAsset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ adminAsset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ adminAsset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ adminAsset('vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ adminAsset('js/main.js') }}"></script>

    @stack('footer')
</body>

</html>
