$( function () {

    let button = $( '#btnSave' );

    let current_measurement_unit = {};

    let measurement_unit_details_form = $( '#measurement-unit-details' );

    get_measurement_units();

    measurement_unit_details_form.on( 'submit', function () {
       clear_error_messages();

       disable_button( button );

       if ( $( '#measurement_unit_id' ).val() === "" ) {
           add_measurement_unit();
       } else {
           edit_measurement_unit();
       }

       enable_button( button );

       return false;

    });

    function add_measurement_unit() {
        $.ajax({
            data        : measurement_unit_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.code ) {
                        display_error( $( '#code_grp' ), errors.code );
                    }

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }
                }
            }, method   : 'POST',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Measurement unit successfully saved</div>' );
                get_measurement_units();
                current_measurement_unit = {};
                show_measurement_unit( current_measurement_unit );

            }, url      : 'api/measurement-units'
        });

    }

    function edit_measurement_unit() {
        $.ajax({
            data        : measurement_unit_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors_response = $.parseJSON( response.responseText );

                    let errors = errors_response.errors;

                    if ( errors.code ) {
                        display_error( $( '#code_grp' ), errors.code );
                    }

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }

                }

            }, method   : 'PUT',
            success     : function () {

                get_measurement_units();
                current_measurement_unit = {};
                show_measurement_unit( current_measurement_unit );
                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Measurement unit successfully updated</div>' );

            }, url      : 'api/measurement-units'
        });

    }

    function get_measurement_units() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( measurement_units ) {

                let table = $( '#measurement_units' );

                table.DataTable().clear();

                table.DataTable({
                    data            : measurement_units,
                    destroy         : true,
                    columns         : [
                        { "title"   : "Name" },
                        { "title"   : "Code" },
                        { "title"   : "Date created" },
                        { "title"   : "Date updated" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "name" },
                        { "data"    : "code" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-trash" data-toggle="tooltip" title="Delete" id="' + row.id
                                    + '" data-placement="bottom"></i></a><a><i class="fas fa-edit" title="Edit" id="'
                                    + row.id + '" data-toggle="tooltip" data-placement="bottom"></i></a>'
                            }
                        }
                    ]
                });

            }, url      : 'api/measurement-units'
        });

    }

    function show_measurement_unit( measurement_unit ) {
        if ( $.isEmptyObject( measurement_unit ) ) {
            $( '#measurement_unit_id' ).val( '' );
            $( '#name' ).val( '' );
            $( '#code' ).val( '' );
        } else {
            $( '#measurement_unit_id' ).val( measurement_unit.id );
            $( '#name' ).val( measurement_unit.name );
            $( '#code' ).val( measurement_unit.code );
        }
    }

});
