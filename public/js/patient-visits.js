$( function () {

    let button = $( '#btnSave' );

    let current_patient_visit = {};

    let patient_id_field = $( '#patient_id' );

    let patient_name_field = $( '#patient' );

    let patient_visit_details_form = $( '#visit-details' );

    get_patient_visits();

    patient_visit_details_form.on( 'submit', function () {
        clear_error_messages();

        disable_button( button );

        if ( $( '#patient_visit_id' ).val() === "" ) {
            add_patient_visit();
        } else {
            edit_patient_visit();
        }

        enable_button( button );

        return false;

    });
    function add_patient_visit() {
        $.ajax({
            data        : patient_visit_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.diagnosis ) {
                        display_error( $( '#diagnosis_grp' ), errors.diagnosis );
                    }

                    if ( errors.patient_id ) {
                        display_error( $( '#patient_grp' ), errors.patient_id );
                    }

                    if ( errors.symptoms ) {
                        display_error( $( '#symptoms_grp' ), errors.symptoms );
                    }

                    if ( errors.visit_date ) {
                        display_error( $( '#visit_date_grp' ), errors.visit_date );
                    }

                }

            }, method   : 'POST',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Patient visit successfully saved</div>' );
                get_patient_visits();
                current_patient_visit = {};
                show_patient_visit( current_patient_visit );

            }, url      : 'api/patient-visits'
        });

    }

    function edit_patient_visit() {
        $.ajax({
            data        : patient_visit_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let response_errors = $.parseJSON( response.responseText );

                    let errors = response_errors.errors;

                    if ( errors.diagnosis ) {
                        display_error( $( '#diagnosis_grp' ), errors.diagnosis );
                    }

                    if ( errors.patient_id ) {
                        display_error( $( '#patient_grp' ), errors.patient_id );
                    }

                    if ( errors.symptoms ) {
                        display_error( $( '#symptoms_grp' ), errors.symptoms );
                    }

                    if ( errors.visit_date ) {
                        display_error( $( '#visit_date_grp' ), errors.visit_date );
                    }

                }

            }, method   : 'PUT',
            success     : function () {

                current_patient_visit = {};
                show_patient_visit( current_patient_visit );
                get_patient_visits();
                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Patient visit successfully updated</div>' );

            }, url      : 'api/patient-visits/' + $( '#patient_visit_id' ).val()
        });

    }

    function get_patient_visits() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( patient_visits ) {

                $.fn.dataTable.moment( 'YYYY-MM-DD' );

                let table = $( '#patient-visits' );

                table.DataTable().clear();

                table.DataTable({
                    data            : patient_visits,
                    destroy         : true,
                    order           : [ [ 1, 'desc' ] ],
                    columns         : [
                        { "title"   : "Patient" },
                        { "title"   : "Visit date" },
                        { "title"   : "Date created" },
                        { "title"   : "Date updated" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "patient" },
                        { "data"    : "visit_date" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-trash" data-toggle="tooltip" title="Delete" id="'
                                    + row.id + '" data-placement="bottom"></i></a><a><i class="fas fa-edit" id="'
                                    + row.id + '" data-toggle="tooltip" data-placement="bottom" title="Edit"></i></a>';
                            }
                        }
                    ]
                });

            }
        });

    }

    function show_patient_visit( patient_visit ) {
        if ( $.isEmptyObject( patient_visit ) ) {
            $( '#patient_visit_id' ).val( '' );
            patient_id_field.val( '' );
            patient_name_field.val( '' );
            $( '#visit_date' ).val( '' );
            $( '#diagnosis' ).val( '' );
            $( '#symptoms' ).val( '' );
        } else {
            $( '#patient_visit_id' ).val( patient_visit.id );
            patient_id_field.val( patient_visit.patient_id );
            patient_name_field.val( patient_visit.patient );
            $( '#visit_date' ).val( patient_visit.visit_date );
            $( '#diagnosis' ).val( patient_visit.diagnosis );
            $( '#symptoms' ).val( patient_visit.symptoms );
        }
    }

    patient_name_field.typeahead({
        afterSelect     : function ( patient ) {
            patient_id_field.val( patient.id );
        }, displayText  : function ( patient ) {
            return patient.patient_name;
        }, items        : 15,
        minLength       : 5,
        source          : function ( request, response ) {
            $.ajax({
                data        : { name : patient_name_field.val() },
                dataType    : 'json',
                method      : 'POST',
                success     : function ( data ) {

                    response( data );

                }, url      : 'api/patients/search'
            });

        }
    });

});
