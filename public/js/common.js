    let authorization_token = 'user_token';

    let user_id = 'user_session';

    let change_password_modal = $( '#change_password_modal' );

    function clear_error_messages() {
        $( '.form-group' ).removeClass( 'has-danger' ); // remove the has-danger class from all form groups
        $( '.text-danger' ).remove(); // remove the error message and error message class from all form controls
        $( '#message' ).children().remove(); // clear the error_message div
        $( '#modal_message' ).children().remove(); // clear the modal_error_message div
        $( '#auth_message' ).children().remove(); // clear the modal_error_message div
    }

    function display_error( display_element, error ) {
        display_element.addClass( 'has-danger' );
        display_element.append( '<div class="form-text text-danger">' + error + '</div>' );
    }

    function enable_button( button ) {

        button.prop( 'disabled', false );

    }

    function disable_button( button ) {

        button.prop( 'disabled', true );

    }

    function redirect( page ) {
        window.location.href = page;
    }

    $( '#sign_out' ).click( function () {
        $( '#sign_out_modal' ).modal( 'show' );
    });

    $( '#change_password' ).click( function () {
        change_password_modal.modal( 'show' );
    });

    $( '#btnLogout' ).click( function () {

        $.ajax({
            dataType    : 'json',
            contentType : 'application/json',
            headers     : {
                "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token)
            }, method   : 'GET',
            success     : function () {

                localStorage.removeItem( user_id );
                localStorage.removeItem( authorization_token );
                redirect( 'login' );

            }, url      : 'api/auth/logout/' + localStorage.getItem( user_id )
        });

    });

    $( '#change_password_form' ).submit( function () {
        clear_error_messages();

        let button = $( '#btnChangePassword' );

        disable_button( button );

        let form_data = $( this ).serializeArray();

        $.ajax({
            data        : form_data,
            dataType    : 'json',
            error       : function ( response ) {

                $( 'input[type="password"]' ).val( '' );

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.current ) {
                        display_error( $( '#current_grp' ), errors.current );
                    }

                    if ( errors.password ) {
                        display_error( $( '#password_grp' ), errors.password[0] );
                    }

                    if ( errors.password_confirmation ) {
                        display_error( $( '#password_confirmation_grp' ), errors.password_confirmation[0] );
                    }

                }

            }, headers  : {
                "Authorization" : 'Bearer ' + localStorage.getItem( authorization_token )
            }, method   : 'PUT',
            success     : function ( data ) {

                $( 'input[type="password"]' ).val( '' );
                $( '#modal_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>' + data.message + '</div>' );
                setTimeout( function (){
                    change_password_modal.modal( 'hide' );
                }, 7500 );

            }, url      : 'api/auth/change-password/' + localStorage.getItem( user_id )
        });

        enable_button( button );

        return false;

    });
