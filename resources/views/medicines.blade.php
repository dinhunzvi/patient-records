@extends( 'layouts.app' )

@section( 'title', 'Medicines' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>Medicine details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="medicine-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="measurement_unit_grp">

                                    <label for="measurement_unit">Measurement unit</label>
                                    <input type="text" name="measurement_unit" id="measurement_unit" autofocus
                                           class="form-control" placeholder="Measurement unit" autocomplete="off" />
                                    <input type="hidden" name="measurement_unit_id" id="measurement_unit_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="name_grp">

                                    <label for="name">Medicine name</label>
                                    <input type="text" name="name" id="name" class="form-control" autocomplete="off"
                                           placeholder="Medicine name" />
                                    <input type="hidden" name="medicine_id" id="medicine_id" />

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

                    <table class="table table-hover table-striped" id="medicines">

                        <thead>

                            <tr>

                                <th>Measurement unit</th>
                                <th>Medicine</th>
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

@section( 'js_file', 'medicines.js' )
