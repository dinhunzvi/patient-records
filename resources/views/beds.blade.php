@extends( 'layouts.app' )

@section( 'title', 'Beds' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <h4>Bed details</h4>

                        </div>

                    </div>

                    @include( 'includes.message' )

                    <form method="post" id="bed-details">

                        <div class="row">

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="ward_grp">

                                    <label for="ward">Ward</label>
                                    <input type="text" id="ward" name="ward" class="form-control" placeholder="Ward"
                                           autocomplete="off" autofocus />
                                    <input type="hidden" id="ward_id" name="ward_id" />

                                </div>

                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

                                <div class="form-group" id="name_grp">

                                    <label for="name">Name of bed</label>
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off"
                                           placeholder="Name of bed"/>
                                    <input type="hidden" id="bed_id" name="bed_id" />

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

                    <table class="table table-striped table-hover" id="beds">

                        <thead>

                            <tr>

                                <th>Ward</th>
                                <th>Bed name</th>
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

@section( 'js_file', 'beds.js' )
