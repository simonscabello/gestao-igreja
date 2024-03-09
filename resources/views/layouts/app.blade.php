<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('theme/img/favicon-sib.ico')}}">

    <!-- Google Font: Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('theme/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('theme/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('theme/css/adminlte.css') }}">
      <style>
      body {
        font-family: 'Open Sans', sans-serif;
      }
    </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('theme/img/icone-sibb.png') }}" alt="Sibb logo" height="60"
             width="60">
    </div>

    @include('layouts.header')
    @include('layouts.sidebar')

    @yield('content')

    @include('layouts.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('theme/plugins/jquery/jquery.min.js') }}"></script>

<!-- DataTable -->
<script src="{{ asset('theme/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('theme/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('theme/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- InputMask -->
<script src="{{ asset('theme/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('theme/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

<!-- overlayScrollbars -->
<script src="{{ asset('theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('theme/js/adminlte.js') }}"></script>

@yield('scripts')

<script>
    $('.datatable').DataTable({
        'paging': true,
        'lenghtChange': true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json",
        },
    })

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

        $('[data-mask]').inputmask()
    })

</script>

@include('sweetalert::alert')

</body>
</html>
