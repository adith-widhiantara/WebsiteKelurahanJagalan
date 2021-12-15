<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <title>@yield('title') | Desa Penambangan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    {{-- section style --}}
    @yield('style')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- Navbar --}}
        @include('section.admin.navbar')
        {{-- end Navbar --}}

        {{-- Main Sidebar Container --}}
        @include('section.admin.sidebar')
        {{-- end Main Sidebar Container --}}


        {{-- Content Wrapper --}}
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('breadcrumbs')
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('base')
                </div>
            </section>
        </div>
        {{-- end Content Wrapper --}}

        {{-- footer --}}
        @include('section.admin.footer')
        {{-- end footer --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- script --}}
    @yield('script')
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>

    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            @if( session('success') )
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
            @endif

            @if( session('info') )
            Toast.fire({
                icon: 'info',
                title: '{{ session('info') }}'
            });
            @endif

            @if( session('error') )
            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            });
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    Toast.fire({
                        icon: 'error',
                        title: '{{ $error }}'
                    });
                @endforeach
            @endif

            @if( session('warning') )
            Toast.fire({
                icon: 'warning',
                title: '{{ session('warning') }}'
            });
            @endif

        });
    </script>
</body>

</html>
