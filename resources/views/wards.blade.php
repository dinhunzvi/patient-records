@extends( 'layouts.app' )

@section( 'title', 'Wards' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>Ward details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="ward-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="name_grp">

                                    <label for="name">Ward name</label>
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off"
                                           placeholder="Ward name" autofocus />
                                    <input type="hidden" id="ward_id" name="ward_id" />

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

                    <table class="table table-striped table-hover" id="wards">

                        <thead>

                            <tr>

                                <th>Name</th>
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

@section( 'js_file', 'wards.js' )
