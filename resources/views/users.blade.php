@extends( 'layouts.app' )

@section( 'title', 'Users' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>User details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="user-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="name_grp">

                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off"
                                           placeholder="Name" autofocus />
                                    <input type="hidden" id="user_id" name="user_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="email_grp">

                                    <label for="email">Email address</label>
                                    <input type="text" id="email" name="email" class="form-control" autocomplete="off"
                                           placeholder="Email address" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="role_grp">

                                    <label for="role">User role</label>
                                    <select id="role" name="role" class="form-control">
                                        <option value="">Select user role</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="General">General</option>
                                        <option value="Practitioner">Nurse/Doctor</option>
                                    </select>

                                </div>

                            </div>

                        </div>

                        <button type="submit" id="btnSave" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <table class="table table-striped table-hover" id="users">

                        <thead>

                            <tr>

                                <th>Name</th>
                                <th>Email address</th>
                                <th>Role</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                                <th>Actions</th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection

@section( 'js_file', 'users.js' )
