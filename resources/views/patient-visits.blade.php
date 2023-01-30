@extends( 'layouts.app' )

@section( 'title', 'Patient visits' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>Visit details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="visit-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="from-group" id="patient_grp">

                                    <label for="patient">Patient name</label>
                                    <input type="text" id="patient" name="patient" class="form-control" autofocus
                                           placeholder="Patient name" autocomplete="off" />
                                    <input type="hidden" name="patient_id" id="patient_id" />

                                </div>

                            </div>


                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="from-group" id="visit_date_grp">

                                    <label for="visit_date">Visit date</label>
                                    <input type="text" id="visit_date" name="visit_date" class="form-control"
                                           placeholder="Visit date" autocomplete="off" />
                                    <input type="hidden" id="patient_visit_id" name="patient_visit_id" />

                                </div>

                            </div>


                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="from-group" id="diagnosis_grp">

                                    <label for="diagnosis">Diagnosis</label>
                                    <textarea id="diagnosis" name="diagnosis" class="form-control"
                                              placeholder="Diagnosis" autocomplete="off"></textarea>

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="from-group" id="symptoms_grp">

                                    <label for="symptoms">Symptoms</label>
                                    <textarea id="symptoms" name="symptoms" class="form-control"
                                              placeholder="Symptoms" autocomplete="off"></textarea>

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

                    <table class="table table-hover table-striped" id="patient-visits">

                        <thead>

                            <tr>

                                <th>Patient</th>
                                <th>Visit date</th>
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

    @include( 'date_pickers.visit_date' )

@endsection

@section( 'js_file', 'patient-visits.js' )
