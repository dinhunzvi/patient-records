@extends( 'layouts.app' )

@section( 'title', 'Dashboard' )

@section( 'content' )

    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="card">

                <div class="card-title">

                    <div class="row">

                        <div class="col-md-6">

                            <h4>Patient visits by month</h4>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <canvas id="patient_visits_by_month" height="100px"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!--<div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="row">

                <h4>Admissions by ward</h4>

            </div>

            <canvas id="admissions_by_ward" height="100px"></canvas>

        </div>

    </div>-->

@endsection

@section( 'js_file', 'home.js' )
