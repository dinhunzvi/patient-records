@extends( 'layouts.app' )

@section( 'title', 'Measurement units' )

@section( 'content')

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>Measurement unit details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="measurement-unit-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="name_grp">

                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name"
                                           autocomplete="off" autofocus />
                                    <input type="hidden" id="measurement_unit_id" name="measurement_unit_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="code_grp">

                                    <label for="code">Code</label>
                                    <input type="text" id="code" name="code" class="form-control" placeholder="Code"
                                           autocomplete="off" />

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

        <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">

            <div class="card">

                <div class="card-body">

                    <table class="table table-striped table-hover" id="measurement_units">

                        <thead>

                            <tr>

                                <th>Name</th>
                                <th>Code</th>
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

@section( 'js_file', 'measurement_units.js' )
