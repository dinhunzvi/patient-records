$( function () {

    let button = $( '#btnSave' );

    let current_medicine = {};

    let measurement_unit_id_field = $( '#measurement_unit_id' );

    let measurement_unit_name_field = $( '#measurement_unit' );

    let medicine_details_form = $( '#medicine-details' );

    get_medicines();

    medicine_details_form.on( 'submit', function () {
        clear_error_messages();

        disable_button( button );

        if ( $( '#medicine_id' ).val() === "" ) {
            add_medicine();
        } else {
            edit_medicine();
        }

        enable_button( button );

        return false;

    });

    function add_medicine() {
        $.ajax({
            data        : medicine_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let response_errors = $.parseJSON( response.responseText );

                    let errors = response_errors.errors;

                    if ( errors.measurement_unit_id ) {
                        display_error( $( '#measurement_unit_grp' ), errors.measurement_unit_id );
                    }

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }

                }
            }, method   : '',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Medicine successfully saved</div>' );
                get_medicines();
                current_medicine = {};
                show_medicine( current_medicine );

            }, url      : 'api/medicines'
        });

    }

    function edit_medicine() {
        $.ajax({
            data        : medicine_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.measurement_unit_id ) {
                        display_error( $( '#measurement_unit_grp' ), errors.measurement_unit_id );
                    }

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }

                }

            }, method   : 'PUT',
            success     : function () {

                get_medicines();
                current_medicine = {};
                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Medicine successfully updated</div>' );
                show_medicine( current_medicine );

            }, url      : 'api/medicines/' + $( '#medicine_id' ).val()
        });

    }

    function get_medicines() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( medicines ) {

                let table = $( '#medicines' );

                table.DataTable().clear();

                table.DataTable({
                    data            : medicines,
                    destroy         : true,
                    columns         : [
                        { "title"   : "Measurement unit" },
                        { "title"   : "Medicine" },
                        { "title"   : "Date created" },
                        { "title"   : "Date updated" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "measurement_unit_name" },
                        { "data"    : "name" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-trash" data-toggle="tooltip" title="Delete" id="' + row.id
                                    + '" data-placement="bottom"></i></a><a><i class="fas fa-edit" title="Edit" id="'
                                    + row.id +'" data-toggle="tooltip" data-placement="bottom"></i></a>';
                            }
                        }
                    ]
                });

            }, url      : 'api/medicines'
        });

    }

    function show_medicine( medicine ) {
        if ( $.isEmptyObject( medicine ) ) {
            $( '#medicine_id' ).val( '' );
            measurement_unit_id_field.val( '' );
            measurement_unit_name_field.val( '' );
            $( '#name' ).val( '' );
        } else {
            $( '#medicine_id' ).val( medicine.id );
            measurement_unit_id_field.val( medicine.measurement_unit_id );
            measurement_unit_name_field.val( medicine.measurement_unit_name );
            $( '#name' ).val( medicine.name );
        }
    }

    measurement_unit_name_field.typeahead({
        afterSelect     : function ( measurement_unit ) {

            measurement_unit_id_field.val( measurement_unit.id );

        }, displayText  : function ( measurement_unit ) {
            return measurement_unit.name;
        }, items        : 10,
        minLength       : 1,
        source          : function ( request, response ) {
            $.ajax({
                data        : { name : measurement_unit_name_field.val() },
                dataType    : 'json',
                /**headers     : {
                    "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token )
                },*/ method   : 'POST',
                success     : function ( data ) {

                    response( data );

                }, url      : 'api/measurement-units/search'
            });
        }
    });

});
