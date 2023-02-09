$( function () {

    let admission_details_form = $( '#admission-details' );

    let bed_id_field = $( '#bed_id' );

    let bed_name_field = $( '#bed' );

    let button = $( '#btnSave' );

    let current_admission = {};

    let patient_id_field = $( '#patient_id' );

    let patient_name_field = $( '#patient' );

    let ward_id_field = $( '#ward_id' );

    let ward_name_field = $( '#ward' );

    get_admissions();

    admission_details_form.on( 'submit', function () {
        clear_error_messages();

        disable_button( button );

        if ( $( '#admission_id' ).val() === "" ) {
            add_admission();
        } else {
            edit_admission();
        }

        enable_button( button );

        return false;

    });
    function add_admission() {
        let form_data = {
            'patient_id'        : patient_id_field.val(),
            'ward_id'           : ward_id_field.val(),
            'bed_id'            : bed_id_field.val(),
            'admission_date'    : $( '#admission_date' ).val(),
            'discharge_date'    : $( '#discharge_date' ).val()
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.admission_date ) {
                        display_error( $( '#admission_date_grp' ), errors.admission_date );
                    }

                    if ( errors.bed_id ) {
                        display_error( $( '#bed_grp' ), errors.bed_id )
                    }

                    if ( errors.discharge_date ) {
                        display_error( $( '#discharge_date_grp' ), errors.discharge_date );
                    }

                    if ( errors.patient_id ) {
                        display_error( $( '#patient_grp' ), errors.patient_id );
                    }

                    if ( errors.ward_id ) {
                        display_error( $( '#ward_grp' ), errors.ward_id );
                    }

                }

            }, method   : 'POST',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Patient admission successfully saved</div>' );
                get_admissions();
                current_admission = {};
                show_admission( current_admission );

            }, url      : 'api/patient-admissions'
        });

    }

    function edit_admission() {
        $.ajax({
            data        : admission_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( data ) {

                if ( data.status === 422 ) {

                    let response = $.parseJSON( data );

                    let errors = response.errors;

                    if ( errors.admission_date ) {
                        display_error( $( '#admission_date_grp' ), errors.admission_date );
                    }

                    if ( errors.bed_id ) {
                        display_error( $( '#bed_grp' ), errors.bed_id );
                    }

                    if ( errors.discharge_date ) {
                        display_error( $( '#discharge_date_grp' ), errors.discharge_date );
                    }

                    if ( errors.patient_id ) {
                        display_error( $( '#patient_grp' ), errors.patient_id );
                    }

                    if ( errors.ward_id ) {
                        display_error( $( '#ward_grp' ), errors.ward_id );
                    }

                }

            }, method   : 'PUT',
            success     : function () {

                get_admissions();
                current_admission = {};
                show_admission( current_admission );
                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Patient admission successfully updated</div>' );

            }, url      : 'api/patient-admissions/' + $( '#admission_id' ).val()
        });

    }

    function get_admissions() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( admissions ) {

                $.fn.dataTable.moment( 'YYYY-MM-DD' );

                let table = $( '#admissions' );

                table.DataTable().clear();

                table.DataTable({
                    data            : admissions,
                    destroy         : true,
                    order           : [ [ 4, 'desc' ] ],
                    columns         : [
                        { "title"   : "Patient" },
                        { "title"   : "Ward" },
                        { "title"   : "Bed" },
                        { "title"   : "Discharged" },
                        { "title"   : "Admission date" },
                        { "title"   : "Discharge date" },
                        { "title"   : "Date created" },
                        { "title"   : "Date updated" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "patient_name" },
                        { "data"    : "ward_name" },
                        { "data"    : "bed_name" },
                        { "data"    : "discharged" },
                        { "data"    : "admission_date" },
                        { "data"    : "discharge_date" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                if ( row.discharged === 'Yes' ) {
                                    return '<a><i class="fas fa-times" data-toggle="tooltip" title="Delete" id="'
                                        + row.id + '" data-placement="bottom"></i></a>';
                                } else {
                                    return '<a><i class="fas fa-check" data-toggle="tooltip" title="Discharge" id="'
                                        + row.id + '" data-placement="bottom"></i></a><a><i class="fas fa-edit" id="'
                                        + row.id + '" data-toggle="tooltip" data-placement="bottom" title="Edit"></i></a>';
                                }
                            }
                        }
                    ]
                });

            }, url      : 'api/patient-admissions'
        });

    }

    function show_admission( admission ) {
        if ( $.isEmptyObject( admission ) ) {
            $( '#admission_id' ).val( '' );
            patient_id_field.val( '' );
            patient_name_field.val( '' );
            ward_id_field.val( '' );
            ward_name_field.val( '' );
            bed_id_field.val( '' );
            bed_name_field.val( '' );
            $( '#admission_date' ).val( '' );
            $( '#discharge_date' ).val( '' );
        } else {
            $( '#admission_id' ).val( admission.id );
            patient_id_field.val( admission.patient_id );
            patient_name_field.val( admission.patient_name );
            ward_id_field.val( admission.ward_id );
            ward_name_field.val( admission.ward_name );
            bed_id_field.val( admission.bed_id );
            bed_name_field.val( admission.bed_name );
            $( '#admission_date' ).val( admission.admission_date );
            $( '#discharge_date' ).val( admission.discharge_date );
        }
    }

    bed_name_field.typeahead({
        afterSelect     : function ( bed ) {
            bed_id_field.val( bed.id );
        }, displayText  : function ( bed ) {
            return bed.name;
        }, items        : 10,
        minLength       : 1,
        source          : function ( request, response ) {

            $.ajax({
                data        : { name : bed_name_field.val() },
                dataType    : 'json',
                method      : 'POST',
                success     : function ( data ) {

                    response( data );

                }, url      : 'api/beds/search'
            });

        }

    });

    patient_name_field.typeahead({
        afterSelect     : function ( patient ) {
            patient_id_field.val( patient.id );
        }, displayText  : function ( patient ) {
            return patient.patient_name;
        }, items        : 10,
        minLength       : 3,
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

    ward_name_field.typeahead({
        afterSelect     : function ( ward ) {
            ward_id_field.val( ward.id );
        }, displayText  : function ( ward ) {
            return ward.name;
        }, items        : 5,
        minLength       : 1,
        source          : function ( request, response ) {

            $.ajax({
                data        : { name : ward_name_field.val() },
                dataType    : 'json',
                method      : 'POST',
                success     : function ( data ) {

                    response( data );

                }, url      : 'api/wards/search'
            });

        }
    });

});
