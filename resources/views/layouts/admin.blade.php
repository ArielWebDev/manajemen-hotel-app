
<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.header')
</head>

<body class="skin-megna fixed-layout">
    @include('includes.loader')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @include('includes.navbar')
        @include('includes.sidebar')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" style="margin-top: 50px">
                @yield('content')
                @include('includes.servicepanel')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    @include('includes.footer')

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    @stack('scripts')
    @include('includes.js')
    {{-- @include('sweetalert::alert') --}}

</body>

</html>