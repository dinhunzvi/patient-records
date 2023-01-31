@extends( 'layouts.auth' )

@section( 'title', 'Login' )

@section( 'content' )

    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route( 'login' ) }}" method="post">
        @csrf

        <div class="form-group" id="email_grp">

            <div class="input-group mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                       autocomplete="off" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-group" id="password_grp">

            <div class="input-group mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-4">
                <button type="submit" class="btn btn-primary" id="btnLogin">
                    <i class="fas fa-sign-in-alt"></i> Sign in
                </button>
            </div>
            <!-- /.col -->
        </div>

    </form>

    <p class="mb-1">
        <a href="">I forgot my password</a>
    </p>

@endsection

@section( 'js_file', 'login.js' )
