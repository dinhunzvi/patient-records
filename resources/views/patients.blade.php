@extends( 'layouts.app' )

@section( 'title', 'Patients' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>Patient details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="patient-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="first_name_grp">

                                    <label for="first_name">First name(s)</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control"
                                           placeholder="First name(s)" autocomplete="off" autofocus />
                                    <input type="hidden" id="patient_id" name="patient_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="last_name_grp">

                                    <label for="last_name">Last name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control"
                                           placeholder="Last name" autocomplete="off" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="id_number_grp">

                                    <label for="id_number">National ID number</label>
                                    <input type="text" id="id_number" name="id_number" class="form-control"
                                           placeholder="National ID number" autocomplete="off" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="dob_grp">

                                    <label for="dob">Date of birth</label>
                                    <input type="text" id="dob" name="dob" class="form-control"
                                           placeholder="Date of birth" autocomplete="off" />

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="address_grp">

                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" class="form-control" placeholder="Address"
                                              autocomplete="off"></textarea>

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="gender_grp">

                                    <label for="">Gender</label>
                                    <div class="form-check input">
                                        <input class="form-check-input" type="radio" name="gender" id="rdoFemale"
                                               value="Female" />
                                        <label class="form-check-label" for="rdoFemale">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="rdoMale"
                                               value="Male" />
                                        <label class="form-check-label" for="rdoMale">Male</label>
                                    </div>

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

                    <table class="table table-striped table-hover" id="patients">

                        <thead>

                            <tr>

                                <th>First name(s)</th>
                                <th>Last name</th>
                                <th>ID number</th>
                                <th>Date of birth</th>
                                <th>Gender</th>
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

    @include( 'date_pickers.dob' )

@endsection

@section( 'js_file', 'patients.js' )
