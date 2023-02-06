$( function () {

    let button = $( '#btnSave' );

    let current_ward = {};

    let delete_modal = {};

    let ward_details_form = $( '#ward-details' );

    let ward_id = 0;

    get_wards();

    ward_details_form.on( 'submit', function () {
        clear_error_messages();

        disable_button( button );

        if ( $( '#ward_id' ).val() === "" ) {
            add_ward();
        } else {
            edit_ward();
        }

        enable_button( button );

        return false;

    });
    function add_ward() {
        $.ajax({
            data        : { name : $( '#name' ).val() },
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }

                }

            }, method   : 'POST',
            success     : function () {

                get_wards();
                current_ward = {};
                show_ward( current_ward );
                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Ward successfully saved</div>' );

            }, url      : 'api/wards'
        });

    }

    function edit_ward() {
        $.ajax({
            data        : ward_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let response_errors = $.parseJSON( response.responseText );

                    let errors = response_errors.errors;

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }

                }

            }, method   : 'PUT',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Ward successfully updated</div>' );
                get_wards();
                current_ward = {};
                show_ward( current_ward );

            }, url      : 'api/wards/' + $( '#ward_id' ).val()
        });

    }

    function get_wards() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( wards ) {

                let table = $( '#wards' );

                table.DataTable().clear();

                table.DataTable({
                    data            : wards,
                    destroy         : true,
                    columns         : [
                        { "title"   : "Name" },
                        { "title"   : "Date created" },
                        { "title"   : "Date updated" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "name" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-times" data-toggle="tooltip" title="Delete" id="' + row.id
                                    + '" data-placement="bottom"></i></a><a><i class="fas fa-edit" id="' + row.id
                                    + '" title="Edit" data-toggle="tooltip" data-placement="bottom"></i></a>';
                            }
                        }
                    ]
                });

            }, url      : 'api/wards'
        });

    }

    function show_ward( ward ) {
        if ( $.isEmptyObject( ward ) ) {
            $( '#ward_id' ).val( '' );
            $( '#name' ).val( '' );
        } else {
            $( '#ward_id' ).val( ward.id );
            $( '#name' ).val( ward.name );
        }
    }

});
