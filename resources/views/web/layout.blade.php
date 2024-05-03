<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="My Ecommerce" name="description" />
    <meta content="Gabriel Camargos Alves" name="author" />
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
    @include('web.header.css')
</head>


<body class="pace-done">
{{-- @show --}}
<!-- Begin page -->
<div id="layout_wrapper">
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        @include('layouts.footer')
    </div>
    <!-- end main content-->
</div>
<!-- END layout_wrapper -->

{{--    <!-- Right Sidebar -->--}}
{{--    @include('layouts.right-sidebar')--}}
{{--    <!-- /Right-bar -->--}}

<!-- JAVASCRIPT -->
<input type="text" id="page_is_dirty" name="page_is_dirty" value="0" style="display:none" />
@include('layouts.vendor-scripts')
</body>

</html>
