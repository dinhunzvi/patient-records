$( function () {

    let medicine_id_field = $( '#medicine_id' );

    let medicine_name_field = $( '#medicine' );

    let patient_id_field = $( '#patient_id' );

    let patient_name_field = $( '#patient' );

    get_prescriptions();

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
                        { "data"    : "patient" },
                        { "data"    : "prescription_date" },
                        { "data"    : "created_at" },
                        { "data"    : "updated_at" },
                    ]
                });

            }, url      : 'api/prescriptions'
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

});
