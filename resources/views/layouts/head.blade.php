<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <link rel="icon" href="{{ asset('build/images/favicon.ico') }}" type="image/ico" />
    <title>لوحة التحكم</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-rtl/dist/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min2.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/icon.css') }}" rel="stylesheet">
    <!-- NProgress -->
    {{-- <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet"> --}}
    <!-- bootstrap-progressbar -->
    {{-- <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"> --}}
    <!-- iCheck -->
    {{-- <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet"> --}}
    <!-- bootstrap-daterangepicker -->
    {{-- <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"> --}}

    <!-- iCheck -->
    {{-- <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendors/sweetaleart.css') }}"> --}}

    <!-- Datatables -->
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

    <!-- Select2 -->
    <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
   <!-- Switchery -->
    {{-- <link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet"> --}}

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href='css/sweetalert2.css'>

    <link href="{{ asset('font/test.css') }}" rel="stylesheet">


       {{-- <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet"> --}}
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500&display=swap" rel="stylesheet"> --}}
    <style>
        * {
                font-family: "Noto Kufi Arabic", sans-serif;
        }

        div.dataTables_wrapper div.dataTables_filter, .dataTables_filter {
            width: 50%;
            float: right;
            text-align: right;
        }
        div.dataTables_wrapper div.dataTables_filter label {
            font-weight: normal;
            white-space: nowrap;
            text-align: left;
            margin-right: 50px;
        }
        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: 0.5em;
            display: inline-block;
            width: 198px;
        }
        .sidebar-footer a {
            width: 33.3333%;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
        .swal-title { color: black;}
        .swal-footer {text-align: center;direction: ltr;}
        .swal2-popup.swal2-toast.swal2-show {
            width: 100%;
            font-size: 15px;
        }
        .swal-text{
            text-align: center
        }


    </style>

    @livewireStyles

    @yield('css')

</head>
