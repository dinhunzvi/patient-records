<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config( 'app.name' ) }} | @yield( 'title' )</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset( 'plugins/fontawesome-free/css/all.min.css') }}" type="text/css"/>
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset( 'css/adminlte.min.css' ) }}" type="text/css"/>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/>

    <!-- Common css -->
    <link href="{{ asset( 'css/common.css') }}" type="text/css" rel="stylesheet"/>

    @if( $date_picker )
        <!-- datepicker CSS -->
        <link rel="stylesheet" href="{{ asset( 'css/gijgo.min.css') }}" type="text/css"/>
    @endif
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset( 'apple-touch-icon.png' ) }}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset( 'favicon-32x32.png' ) }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset( 'favicon-16x16.png' ) }}"/>
    <link rel="manifest" href="{{ asset( 'site.webmanifest' ) }}"/>

    <!-- jQuery -->
    <script src="{{ asset( 'js/jquery.min.js' ) }}"></script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route( 'home' ) }}" class="nav-link">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link" id="change_password">
                    <i class="fas fa-pencil-alt"></i> Change password
                </a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link" id="sign_out">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>

        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route( 'home' ) }}" class="brand-link">
            <img src="{{ asset( 'img/logo.jpg' ) }}" alt="{{ config( 'app.name' ) }}"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config( 'app.name' ) }}</span>
        </a>

        @include( 'includes.sidebar' )

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include( 'modals.sign_out' )
        @include( 'modals.change_password' )

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield( 'title' )</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route( 'home' ) }}">Home</a></li>
                            <li class="breadcrumb-item active">@yield( 'title' )</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                @yield( 'content' )

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date( 'Y' ) }} Frazier Logistics</strong>
        All rights reserved.

    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap -->
<script src="{{ asset( 'js/bootstrap.bundle.min.js' ) }}"></script>
<!-- AdminLTE -->
<script src="{{ asset( 'js/adminlte.min.js' ) }}"></script>
@if( $type_ahead )
    <script src="{{ asset( 'js/bootstrap3-typeahead.min.js' ) }}" type="text/javascript"></script>
@endif

<!-- Common JS functions and values -->
<script src="{{ asset( 'js/common.js' ) }}"></script>
<!-- page JS script -->
<script src="js/@yield( 'js_file' )" type="text/javascript"></script>

<!-- OPTIONAL SCRIPTS -->
@if( $charts )
    <script src="{{ asset( 'plugins/chart.js/Chart.bundle.js' ) }}" type="text/javascript"></script>
@endif

@if( $data_tables )
    <script src="{{ asset( 'plugins/datatables/jquery.dataTables.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/datatables-responsive/js/dataTables.responsive.min.js' ) }}"></script>
    <script src="{{ asset( 'plugins/datatables-responsive/js/responsive.bootstrap4.min.js' ) }}"></script>
@endif

@if ( $moment )
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js" type="text/javascript"></script>
@endif

</body>
</html>
