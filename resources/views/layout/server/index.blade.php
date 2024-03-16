<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    @yield('title')
    <base href="{{asset('')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/header/favicon.ico"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" />
    @yield('local_css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery/jquery.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/responsive/responsive.dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('')}}{{mix('css/app.css')}}" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layout.server.navbar')
    @include('layout.server.menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content_header')
        <section class="content">
        @yield('content')
        </section>
    </div>
    <!-- Content Wrapper. Contains page content -->
    @include('layout.server.footer')
    @include('layout.server.quickbar')
</div>
<!-- ./wrapper -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- ./wrapper -->
<script src="{{asset('plugins/jszip/new/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/new/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/new/vfs_fonts.js')}}"></script>
@yield('local_script')
<script src="{{asset('')}}{{mix('js/app.js')}}"></script>
</body>
</html>