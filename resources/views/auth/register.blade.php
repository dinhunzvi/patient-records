@extends( 'layouts.auth' )

@section( 'title', 'Add user' )

@section( 'content' )

    <p class="login-box-msg">User details</p>

    @include( 'includes.auth_message' )

    <form action="{{ route( 'register' ) }}" method="post">
        @csrf

        <div class="form-group" id="name_grp">

            <div class="input-group mb-3">
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Name"  autocomplete="off" />

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

        </div>

        <div class="form-group" id="email_grp">

            <div class="input-group mb-3">
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="Email address" autocomplete="off" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

        </div>

        <div class="form-group" id="password_grp">

            <div class="input-group mb-3">
                <input type="password" id="password" name="password" placeholder="Password"
                       class="form-control @error('password') is-invalid @enderror"  />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

        </div>

        <div class="form-group" id="password-confirm_grp">

            <div class="input-group mb-3">
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror"
                       placeholder="Password confirmation" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

            </div>

        </div>

        <div class="row">

            <div class="col-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add user
                </button>
            </div>
            <!-- /.col -->
        </div>

    </form>

@endsection
