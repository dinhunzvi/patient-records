$( function () {

    let add_button = $( '#btnAdd' );

    let current_prescription_item = {};

    let medicine_details_form = $( '#medicine-details' );

    let medicine_id_field = $( '#medicine_id' );

    let medicine_name_field = $( '#medicine' );

    let patient_id_field = $( '#patient_id' );

    let patient_name_field = $( '#patient' );

    let prescription_form_details = $( '#prescription-details' );

    let save_button = $( '#btnSave' );

    get_prescriptions();

    get_prescription_items();

    $( document ).on( 'click', '.fa-trash', function () {
        clear_error_messages();
        if ( confirm( 'Are you sure you want to remove from prescription?' ) ) {
            $.ajax({
                dataType    : 'json',
                method      : 'DELETE',
                success     : function () {

                    $( '#modal_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                        'aria-hidden="true">&times;</span></button>Medicine successfully removed from prescription</div>' );
                    get_prescription_items();

                }, url      : 'api/items/' + $( this ).attr( "id" )
            });

        }

    });

    medicine_details_form.on( 'submit', function () {
        clear_error_messages();

        disable_button( add_button );

        $.ajax({
            data        : { medicine_id: medicine_id_field.val(), dosage: $( '#dosage' ).val(),
                quantity : $( '#quantity' ).val(), },
            dataType    : 'json',
            error       : function ( response ) {

                if ( response.status === 422 ) {

                    let errors = response.responseJSON.errors;

                    if ( errors.dosage ) {
                        display_error( $( '#dosage_grp' ), errors.dosage );
                    }

                    if ( errors.medicine_id ) {
                        display_error( $( '#medicine_grp' ), errors.medicine_id[0] );
                    }

                    if ( errors.quantity ) {
                        display_error( $( '#quantity_grp' ), errors.quantity[0] );
                    }

                }

            }, method   : "POST",
            success     : function () {

                $( '#modal_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                    'aria-hidden="true">&times;</span></button>Medicine successfully added to prescription</div>' );
                get_prescription_items();
                current_prescription_item = {};
                show_prescription_item( current_prescription_item );

            }, url      : 'api/items'
        });

        enable_button( add_button );

        return false;

    });
    prescription_form_details.on( 'submit', function () {
       clear_error_messages();

       disable_button( save_button );

       $.ajax({
           data         : { patient_id : patient_id_field.val(), prescription_date: $( '#prescription_date' ).val() },
           dataType     : 'json',
           error        : function ( response ) {

               if ( response.status === 422 ) {
                    let response_errors = $.parseJSON( response.responseText );

                    let errors = response_errors.errors;

                    if ( errors.patient_id ) {
                        display_error( $( '#patient_grp' ), errors.patient_id[0] );
                    }

                    if ( errors.prescription_date ) {
                        display_error( $( '#prescription_date_grp' ), errors.prescription_date[0] );
                    }

               }

           }, method    : 'POST',
           success      : function () {

               $( '#alt_message' ).append( '<div class="alert alert-success alert-dismissible fade show">' +
                   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ' +
                   'aria-hidden="true">&times;</span></button>Prescription successfully saved</div>' );
               get_prescriptions();

           }, url       : 'api/prescriptions'
       });

       enable_button( save_button );

       return false;

    });

    function get_prescriptions() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( prescriptions ) {

                $.fn.dataTable.moment( 'YYYY-MM-DD' );

                let table = $( '#prescriptions' );

                table.DataTable().clear();

                table.DataTable({
                    data            : prescriptions,
                    destroy         : true,
                    order           : [ [ 2, 'desc' ] ],
                    columns         : [
                        { "title"   : "Patient" },
                        { "title"   : "Prescription date" },
                        { "title"   : "Date created" },
                        { "title"   : "Date updated" },
                    ],columns       : [
                        { "data"    : "patient_name" },
                        { "data"    : "prescription_date" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                    ]
                });

            }, url      : 'api/prescriptions'
        });

    }

    function get_prescription_items() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( items ) {

                let table = $( '#prescription-items' );

                table.DataTable().clear();

                table.DataTable({
                    data            : items,
                    destroy         : true,
                    columns         : [
                        { "title"   : "Medicine" },
                        { "title"   : "Quantity" },
                        { "title"   : "Dosage" },
                        { "title"   : "Actions" },
                    ], columns      : [
                        { "data"    : "name" },
                        { "data"    : "quantity" },
                        { "data"    : "dosage" },
                        {
                            mRender : function ( data, type, row ) {
                                return '<a><i class="fas fa-trash" data-toggle="tooltip" title="Delete" id="' + row.id
                                    + '" data-placement="bottom"></i></a>';
                            }
                        }
                    ]
                });

            }, url      : 'api/items'
        });

    }

    medicine_name_field.typeahead({
        afterSelect     : function ( medicine ) {
            medicine_id_field.val( medicine.id );
        }, displayText  : function ( medicine ) {
            return medicine.name;
        }, items        : 10,
        minLength       : 3,
        source          : function ( request, response ) {

            $.ajax({
                data        : { name : medicine_name_field.val() },
                dataType    : 'json',
                method      : 'POST',
                success     : function ( data ) {

                    response( data );

                }, url      : 'api/medicines/search'
            });

        }
    });

    patient_name_field.typeahead({
        afterSelect     : function ( patient ) {
            patient_id_field.val( patient.id );
        }, displayText  : function ( patient ) {
            return patient.patient_name;
        }, items        : 10,
        minLength       : 4,
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

    function show_prescription_item( prescription_item ) {
        if ( $.isEmptyObject( prescription_item ) ) {
            medicine_id_field.val( '' );
            medicine_name_field.val( '' );
            $( '#quantity' ).val( '' );
            $( '#dosage' ).val( '' );
        } else {
            medicine_id_field.val( prescription_item.id );
            medicine_name_field.val( prescription_item.name );
            $( '#quantity' ).val( prescription_item.quantity );
            $( '#dosage' ).val( prescription_item.dosage );
        }
    }

    function show_patient( patient ) {
        if ( $.isEmptyObject( patient ) ) {
            patient_id_field.val( '' );
            patient_name_field.val( '' );
        } else {
            patient_id_field.val( patient.id );
            patient_name_field.val( patient.name );
        }
    }
});
