<script src="{{ asset( 'js/gijgo.min.js' ) }}" type="text/javascript"></script>
<script type="text/javascript">
    const today = new Date( new Date().getFullYear(), new Date().getMonth(), new Date().getDate() );

    let admission_date = $( '#admission_date' );

    admission_date.datepicker({
        uiLibrary   : 'bootstrap4',
        format      : 'yyyy-mm-dd',
        maxDate     : today
    });

    admission_date.on( 'change', function () {
        $( '#discharge_date' ).datepicker({
            uiLibrary   : 'bootstrap4',
            'format'    : 'yyyy-mm-dd',
            minDate     : $( this ).val(),
            maxDate     : today
        });

    });

</script>
