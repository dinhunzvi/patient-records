<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config( 'app.name' ) }} | @yield( 'title' )</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset( 'plugins/fontawesome-free/css/all.min.css' ) }}" type="text/css" />
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset( 'plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" type="text/css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset( 'css/adminlte.min.css' ) }}" type="text/css" />
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset( 'apple-touch-icon.png' ) }}" />
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset( 'favicon-32x32.png' ) }}" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset( 'favicon-16x16.png' ) }}" />
        <link rel="manifest" href="{{ asset( 'site.webmanifest' ) }}" />
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route( 'home' ) }}">
                    <img src="{{ asset( 'img/logo.jpg' ) }}" alt="{{ config( 'app.name' ) }}"
                        height="160" width="160" />
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="card">

                <div class="card-body login-card-body">

                    @yield( 'content' )

                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset( 'js/jquery.min.js' ) }}" type="text/javascript"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset( 'js/bootstrap.bundle.min.js' ) }}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset( 'js/adminlte.min.js' ) }}" type="text/javascript"></script>
        <!-- Common JS functions -->
        <script src="{{ asset( 'js/common.js' ) }}" type="text/javascript"></script>
        <!-- JS for page -->
        <script src="{{ asset( 'js').'/' }}@yield( 'js_file' )" type="text/javascript"></script>
    </body>
</html>

