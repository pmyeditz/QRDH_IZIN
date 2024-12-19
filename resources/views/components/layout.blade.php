<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRDH || BY ridho</title>
    {{-- datatables --}}
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.5/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.1/css/select.bootstrap5.css">

    <!-- Memuat Bootstrap CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">


    {{-- scanner --}}
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.jpeg') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    {{-- scanner qrcode --}}
    <script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>

    <!-- Custom CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/costum.css') }}" rel="stylesheet">

    {{-- chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>

</style>
</head>
<body>
    <div class="main">
        @yield('main')
    </div>

    <div class="container">
      @yield('login')
    </div>

    {{-- Memuat Bootstrap JavaScript dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Vendor JS Files --}}
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    {{-- Template Main JS File --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- datatables --}}
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.5/datatables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{-- mengarah ke CDN yang disediakan oleh jsDelivr. --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.1/js/select.bootstrap5.js"></script>

    <script>
        new DataTable('.contoh', {
            select: true
        });
    </script>
</body>
</html>

{{-- Catatan: @include dan @yield adalah directive Blade yang digunakan dalam proyek Laravel --}}
