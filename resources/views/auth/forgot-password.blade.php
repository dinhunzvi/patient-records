@extends( 'layouts.auth' )

@section( 'title', 'Forgot password' )

@section( 'content' )

    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

    @include( 'includes.auth_message' )

    <form id="forgot_password_form" method="post">

        <div class="form-group" id="email_grp">

            <div class="input-group mb-3">

                <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                       autofocus autocomplete="off" >
                <div class="input-group-append">

                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>

                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-8">
                <button type="submit" class="btn btn-primary" id="btnForgotPassword">
                    <i class="fa fa-paper-plane"></i> Request new password
                </button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <p class="mt-3 mb-1">
        <a href="{{ route( 'login') }}">Sign in</a>
    </p>


@endsection

@section( 'js_file', 'forgot_password.js' )
