@extends( 'layouts.auth' )

@section( 'title', 'Add user' )

@section( 'content' )

    <p class="login-box-msg">User details</p>

    @include( 'includes.auth_message' )

    <form action="{{ route( 'register' ) }}" method="post">

        <div class="form-group" id="name_grp">

            <div class="input-group mb-3">
                <input type="email" name="name" id="name" class="form-control" placeholder="Name"
                       autocomplete="off" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>

        </div>

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

        <div class="form-group" id="password-confirm_grp">

            <div class="input-group mb-3">
                <input type="password" id="password-confirm" name="password-confirm" class="form-control"
                       placeholder="Password confirmation" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-6">
                <button type="submit" class="btn btn-primary" id="btnLogin">
                    <i class="fas fa-save"></i> Add user
                </button>
            </div>
            <!-- /.col -->
        </div>

    </form>

@endsection
