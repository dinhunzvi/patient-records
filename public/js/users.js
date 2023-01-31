$( document ).ready( function () {

    get_users();

    let button = $( '#btnSave' );

    let current_user = {};

    let delete_modal = $( '#delete_user_modal' );

    let user_id = 0;

    function get_users() {
        $.ajax({
            dataType    : 'json',
            /*headers     : {
                "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token )
            },*/ method   : 'GET',
            success     : function ( users ) {

                let table = $( '#users' );

                table.DataTable().clear();

                table.DataTable({
                    "data"          : users,
                    "destroy"       : true,
                    "responsive"    : false,
                    "autoWidth"     : false,
                    columns         : [
                        { 'title'   : "Name" },
                        { 'title'   : "Email address" },
                        { 'title'   : "Date created" },
                        { 'title'   : "Date updated" },
                        { 'title'   : "Actions" },
                    ], columns      : [
                        { "data"    : "name" },
                        { "data"    : "email" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-user-times" data-toggle="tooltip" '
                                    + 'data-placement="bottom" title="Delete" id="' + row.id + '"></i></a><a><i '
                                    + 'class="fas fa-user-edit" id="' + row.id + '" data-toggle="tooltip" '
                                    + 'data-placement="bottom" title="Edit"></i></a>';
                            }
                        },
                    ]
                });

            }, url      : 'api/users'
        });
    }

    $( document ).on( 'click', '.fa-user-edit', function () {

        $.ajax({
           dataType : 'json',
            /*headers     : {
                "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token )
            },*/ method: 'GET',
           success  : function ( user ) {

               current_user = user;

               show_user( current_user );

           }, url    : 'api/users/' + $( this ).attr( "id" )
        });

    });

    $( document ).on( 'click', '.fa-user-times', function () {
       user_id = $( this ).attr( "id" );

       delete_modal.modal( 'show' );

    });

    function show_user( user ) {
        if ( $.isEmptyObject( user ) ) {
            $( '#user_id' ).val( '' );
            $( '#name' ).val( '' );
            $( '#email' ).val( '' );
        } else {
            $( '#user_id' ).val( user.id );
            $( '#name' ).val( user.name );
            $( '#email' ).val( user.email );
        }
    }

    $( '#btnDeleteUser' ).on( 'click', function () {
        clear_error_messages();

        $.ajax({
            dataType    : 'json',
            /*headers     : {
                "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token )
            },*/ method   : 'DELETE',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>User deleted</div>' );
                get_users();
                user_id = 0;
                delete_modal.modal( 'hide' );

            }, url      : 'api/users/' + user_id
        });

    });

    $( '#user-details' ).submit( function () {
        clear_error_messages();

        disable_button( button );

        if ( $( '#user_id' ).val() === "" ) {
            add_user();
        } else {
            edit_user();
        }

        enable_button( button );

        return false;

    });

    function add_user() {
        let form_data = {
            'name'    : $( '#name' ).val(),
            'email'   : $( '#email' ).val(),
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.email ) {
                        display_error( $( '#email_grp' ), errors.email[0] );
                    }

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name[0] );
                    }

                }

            }/*, headers  : {
                "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token )
            }*/, method   : 'POST',
            success     : function () {

                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>User successfully saved</div>' );
                get_users();
                current_user = {};
                show_user( current_user );

            }, url      : 'api/users'
        });

    }

    function edit_user() {
        let form_data = {
            'email'     : $( '#email' ).val(),
            'name'      : $( '#name' ).val(),
        };

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( data ) {

                if ( data.status === 422 ) {

                    let response = $.parseJson( data.responseText );

                    let errors = response.errors;

                    if ( errors.email ) {
                        display_error( $( '#email_grp' ), errors.email[0] );
                    }

                    if ( errors.name ) {
                        display_error( $( '#name_grp' ), errors.name[0] );
                    }

                }

            }/*, headers  : {
                "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token )
            }*/, method   : 'PUT',
            success     : function () {

                get_users();
                current_user = {};
                $( '#message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>User successfully updated</div>' );
                show_user( current_user );

            }, url      : 'api/users/' + $( '#user_id' ).val()
        });

    }

});

