$( function () {

    let button = $( '#btnSave' );

    let current_patient = {};

    let patient_details_form = $( '#patient-details' );

    get_patients();


    patient_details_form.on( 'submit', function () {
       clear_error_messages();

       disable_button( button );

       if ( $( '#patient_id' ).val() === "" ) {
           add_patient();
       } else {
           edit_patient();
       }

       enable_button( button );

       return false;

    });

    function add_patient() {
        $.ajax({
            data        : patient_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.address ) {
                        display_error( $( '#address_grp' ), errors.address );
                    }

                    if ( errors.first_name ) {
                        display_error( $( '#first_name_grp' ), errors.first_name );
                    }

                    if ( errors.id_number ) {
                        display_error( $( '#id_number_grp' ), errors.id_number );
                    }

                    if ( errors.dob ) {
                        display_error( $( '#dob_grp' ), errors.dob );
                    }

                    if ( errors.gender ) {
                        display_error( $( '#gender_grp' ), errors.gender );
                    }

                    if ( errors.last_name ) {
                        display_error( $( '#last_name_grp' ), errors.last_name );
                    }

                }
            }, method   : 'POST',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Patiend details saved</div>' );
                get_patients();
                current_patient = {};
                show_patient( current_patient );

            }, url      : 'api/patients'
        });

    }

    function edit_patient() {
        $.ajax({
            data        : patient_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.address ) {
                        display_error( $( '#address_grp' ), errors.address );
                    }

                    if ( errors.first_name ) {
                        display_error( $( '#first_name_grp' ), errors.first_name );
                    }

                    if ( errors.id_number ) {
                        display_error( $( '#id_number_grp' ), errors.id_number );
                    }

                    if ( errors.dob ) {
                        display_error( $( '#dob_grp' ), errors.dob );
                    }

                    if ( errors.gender ) {
                        display_error( $( '#gender_grp' ), errors.gender );
                    }

                    if ( errors.last_name ) {
                        display_error( $( '#last_name_grp' ), errors.last_name );
                    }

                }
            }, method   : 'POST',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Patiend details updated</div>' );
                get_patients();
                current_patient = {};
                show_patient( current_patient );

            }, url      : 'api/patients/' + $( '#patient_id' ).val()
        });

    }

    function get_patients() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( patients ) {

                let table = $( '#patients' );

                table.DataTable().clear();

                table.DataTable({
                    data            : patients,
                    destroy         : true,
                    columns         : [
                        { "title"   : "First name(s)" },
                        { "title"   : "Last name" },
                        { "title"   : "ID number" },
                        { "title"   : "Date of birth" },
                        { "title"   : "Gender" },
                        { "title"   : "Date created" },
                        { "title"   : "Date updated" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "first_name" },
                        { "data"    : "last_name" },
                        { "data"    : "id_number" },
                        { "data"    : "dob" },
                        { "data"    : "gender" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-trash" data-toggle="tooltip" title="Delete" id="' + row.id
                                    + '" data-placement="bottom"></i></a><a><i class="fas fa-edit" title="Edit" id="'
                                    + row.id + '" data-toggle="tooltip" data-placement="bottom"></i></a>';
                            }
                        }
                    ]
                });

            }, url      : 'api/patients'
        });
    }

    function show_patient( patient ) {
        if ( $.isEmptyObject( patient ) ) {
            $( '#patient_id' ).val( '' );
            $( '#first_name' ).val( '' );
            $( '#last_name' ).val( '' );
            $( '#id_number' ).val( '' );
            $( '#dob' ).val( '' );
            $( '#address' ).val( '' );
            $( 'input[type="radio"]' ).prop( 'checked', false );
        } else {
            $( '#patient_id' ).val( patient.id );
            $( '#first_name' ).val( patient.first_name );
            $( '#last_name' ).val( patient.last_name );
            $( '#id_number' ).val( patient.id_number );
            $( '#dob' ).val( patient.dob );
            $( '#address' ).val( patient.address );
            $( 'input[name="gender"][value="' + patient.gender + '"]' ).prop( 'checked', true );
        }
    }

});
