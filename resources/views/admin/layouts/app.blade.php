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

    <script src="{{ adminAsset('js/jquery.min.js') }}"></script>

    @stack('header')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css'> --}}
    @livewireStyles
    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="{{ $body_class }}">


    @include('admin.parts.header')

    @include('admin.parts.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main>

    @include('admin.parts.footer')

    @yield('modal')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>


    <!-- Vendor JS Files -->
    {{-- <script src="{{ adminAsset('vendor/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ adminAsset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Template Main JS File -->

    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js'></script> --}}
    <script src="{{ adminAsset('js/main.js') }}"></script>
    @stack('footer')
    <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>


    <script>
        $(document).ready(function() {

            if ($('.select2Picker').length > 0) {
                $('.select2Picker').select2({
                    placeholder: 'Select an option',
                    disabled: $(this).data('disabled') ?? false,
                    maximumSelectionLength: $(this).data('max') ?? 0,
                }).on('select2:select', function(e) {
                    var data = e.params.data;
                    if (data.id == 'all') {
                        $(this).val('all').change();
                    } else {
                        var wanted_option = $(this).find('option[value="all"]');
                        wanted_option.prop('selected', false);
                    }
                    $(this).trigger('change.select2');
                }).on('change', function() {
                    var count = $(this).select2('data').length
                    if (count == 0) {
                        $(this).val('all').change();
                    }
                });
            }
            if ($('.select2PickerCountry').length > 0) {
                $('.select2PickerCountry').select2({
                    placeholder: 'Select an option',
                    disabled: $(this).data('disabled') ?? false,
                    maximumSelectionLength: $(this).data('max') ?? 0,
                    matcher(params, data) {
                        const originalMatcher = $.fn.select2.defaults.defaults.matcher;
                        const result = originalMatcher(params, data);

                        if (
                            result &&
                            data.children &&
                            result.children &&
                            data.children.length
                        ) {
                            if (
                                data.children.length !== result.children.length &&
                                data.text.toLowerCase().includes(params.term.toLowerCase())
                            ) {
                                result.children = data.children;
                            }
                            return result;
                        }

                        return null;
                    },
                }).on('select2:select', function(e) {
                    var data = e.params.data;
                    if (data.id == 'all') {
                        $(this).val('all').change();
                    } else {
                        var wanted_option = $(this).find('option[value="all"]');
                        wanted_option.prop('selected', false);
                    }
                    $(this).trigger('change.select2');
                }).on('change', function() {
                    var count = $(this).select2('data').length
                    if (count == 0) {
                        $(this).val('all').change();
                    }
                });
            }

        });
    </script>

</body>

</html>
