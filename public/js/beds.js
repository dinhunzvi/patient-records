$( function () {

    let bed_details_form = $( '#bed-details' );

    let bed_id = 0;

    let button = $( '#btnSave' );

    let current_bed = {};

    let ward_id_field = $( '#ward_id' );

    let ward_name_field = $( '#ward' );

    get_beds();

    bed_details_form.on( 'submit', function () {
        clear_error_messages();

        disable_button( button );

        if ( $( '#bed_id' ).val() === "" ) {
            add_bed();
        } else {
            edit_bed();
        }

        enable_button( button );

        return false;

    });

    function add_bed() {

        let form_data = {
            ward_id : ward_id_field.val(),
            name    : $( '#name' ).val()
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }

                    if ( errors.ward_id ) {
                        display_error( $( '#ward_grp' ), errors.name );
                    }

                }

            }, method   : 'POST',
            success     : function () {

                current_bed = {};
                show_bed( current_bed );
                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Bed successfully saved</div>' );
                get_beds();

            }, url      : 'api/beds'
        });

    }

    function edit_bed() {
        $.ajax({
            data        : bed_details_form.serializeArray(),
            dataType    : 'json',
            error       : function ( data ) {

                if ( data.status === 422 ) {

                    let response = $.parseJSON( data.responseText );

                    let errors = response.errors;

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name );
                    }

                    if ( errors.ward_id ) {
                        display_error( $( '#ward_id' ), errors.ward_id );
                    }

                }

            }, method   : 'PUT',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Bed successfully updated</div>' );
                get_beds();
                current_bed = {};
                show_bed( current_bed );

            }, url      : 'api/beds/' + $( '#bed_id' ).val()
        });

    }

    function get_beds() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( beds ) {

                let table = $( '#beds' );

                table.DataTable().clear();

                table.DataTable({
                    data            : beds,
                    destroy         : true,
                    columns         : [
                        { "title"   : "Ward" },
                        { "title"   : "Name" },
                        { "title"   : "Date updated" },
                        { "title"   : "Date updated" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "ward" },
                        { "data"    : "name" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-times" data-toggle="toolitp" title="Delete" id="' + row.id
                                    + '" data-placement="bottom"></i></a><a><i class="fas fa-edit" title="Delete" id="'
                                    + row.id + '" data-placement="bottom" data-toggle="tooltip"></i></a>';
                            }
                        }
                    ]
                });

            }, url      : 'api/beds'
        });

    }

    function show_bed( bed ) {
        if ( $.isEmptyObject( bed ) ) {
            $( '#bed_id' ).val( '' );
            ward_id_field.val( '' );
            $( '#name' ).val( '' );
            ward_name_field.val( '' );
        } else {
            $( '#bed_id' ).val( bed.id );
            ward_id_field.val( bed.ward_id );
            $( '#name' ).val( bed.name );
            ward_name_field.val( bed.ward );
        }
    }

    ward_name_field.typeahead({
        afterSelect     : function ( ward ) {
            ward_id_field.val( ward.id );
        }, displayText  : function ( ward ) {
            return ward.name;
        }, items        : 10,
        minLength       : 1,
        source          : function ( request, response ) {
            $.ajax({
                data        : { name: ward_name_field.val() },
                dataType    : 'json',
                method      : 'POST',
                success     : function ( data ) {

                    response( data );

                }, url      : 'api/wards/search'
            });

        }
    });

});
