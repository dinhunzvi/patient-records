@extends( 'layouts.app' )

@section( 'title', 'Prescriptions' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-4">

                            <div class="row">

                                <div class="col-12">

                                    <h4>Prescription details</h4>

                                </div>

                            </div>

                            @include( 'includes.message' )

                            <form method="post" id="prescription-details">

                                <div class="row">

                                    <div class="col-12">

                                        <div class="form-group" id="_patient_grp">

                                            <label for="patient">Patient</label>
                                            <input type="text" id="patient" name="patient" placeholder="Patient"
                                                   autofocus autocomplete="off" class="form-control" />
                                            <input type="hidden" id="patient_id" name="patient_id" />

                                        </div>

                                    </div>

                                </div>

                                <button type="submit" id="btnSave" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>

                            </form>

                        </div>

                        <div class="col-8">

                            <div class="row">

                                <div class="col-md-6">

                                    <h3>Medicine details</h3>

                                </div>

                            </div>

                            @include( 'includes.modal_message' )

                            <form method="post" id="medicine-details">

                                <div class="row">

                                    <div class="col-4">

                                        <div class="form-group" id="medicine_grp">

                                            <label for="medicine">Medicine</label>

                                            <input type="text" id="medicine" name="medicine" class="form-control"
                                                   autocomplete="off" placeholder="Medicine" />
                                            <input type="hidden" id="medicine_id" name="mediceine_id" />

                                        </div>

                                    </div>

                                    <div class="col-4">

                                        <div class="form-group" id="quantity_grp">

                                            <label for="quantity">Quantity</label>
                                            <input type="text" id="quantity" name="quantity" class="form-control"
                                                   autocomplete="off" placeholder="Quantity" />

                                        </div>

                                    </div>

                                    <div class="col-4">

                                        <div class="form-group" id="dosage_grp">

                                            <label for="dosage">Dosage</label>
                                            <textarea id="dosage" name="dosage" class="form-control" autocomplete="off"
                                                   placeholder="Dosage"></textarea>

                                        </div>

                                    </div>

                                </div>

                                <button type="submit" id="btnAdd" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add to prescription
                                </button>

                            </form>

                            <div class="row">

                                <div class="col-md-6">

                                    <h5>Prescription items</h5>

                                </div>

                                <table class="table table-striped table-hover" id="prescription-items">

                                    <thead>

                                    <tr>

                                        <th>Medicine</th>
                                        <th>Quantity</th>
                                        <th>Dosage</th>
                                        <th>Actions</th>

                                    </tr>

                                    </thead>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <table class="table table-striped table-hover" id="prescriptions">

                        <thead>

                            <tr>

                                <th>Patient</th>
                                <th>Prescription date</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                                <!--<th>Actions</th> -->

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection

@section( 'js_file', 'prescriptions.js' )
