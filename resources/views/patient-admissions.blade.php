@extends( 'layouts.app' )

@section( 'title', 'Admissions' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>Admission details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="admission-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-sm-12 col-md-6">

                                <div class="form-group" id="patient_grp">

                                    <label for="patient">Patient name</label>
                                    <input type="text" id="patient" name="patient" class="form-control" autofocus
                                           placeholder="Patient name" autocomplete="off" />
                                    <input type="hidden" id="patient_id" name="patient_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-sm-12 col-md-6">

                                <div class="form-group" id="ward_grp">

                                    <label for="ward">Ward</label>
                                    <input type="text" id="ward" name="ward" class="form-control" placeholder="Ward"
                                           autocomplete="off" />
                                    <input type="hidden" id="ward_id" name="ward_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-sm-12 col-md-6">

                                <div class="form-group" id="bed_grp">

                                    <label for="bed">Bed</label>
                                    <input type="text" id="bed" name="bed" class="form-control" placeholder="Bed"
                                           autocomplete="off" />
                                    <input type="hidden" id="bed_id" name="bed_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-sm-12 col-md-6">

                                <div class="form-group" id="admission_date_grp">

                                    <label for="admission_date">Admission date</label>
                                    <input type="text" id="admission_date" name="admission_date" class="form-control"
                                           placeholder="Admission date" autocomplete="off" />
                                    <input type="hidden" id="admission_id" name="admission_id" />

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-sm-12 col-md-6">

                                <div class="form-group" id="discharge_date_grp">

                                    <label for="discharge_date">Discharge date</label>
                                    <input type="text" id="discharge_date" name="discharge_date" class="form-control"
                                           placeholder="Discharge date" autocomplete="off" />

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

                    <table class="table table-striped table-hover" id="admissions">

                        <thead>

                            <tr>

                                <th>Patient</th>
                                <th>Ward</th>
                                <th>Bed</th>
                                <th>Discharged</th>
                                <th>Admission date</th>
                                <th>Date discharged</th>
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

    @include( 'date_pickers.admission_dates' )

@endsection

@section( 'js_file', 'patient-admissions.js' )
