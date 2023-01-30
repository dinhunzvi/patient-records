<script src="{{ asset( 'js/gijgo.min.js' ) }}" type="text/javascript"></script>
<script type="text/javascript">
    const today = new Date( new Date().getFullYear(), new Date().getMonth(), new Date().getDate() );

    $( '#visit_date' ).datepicker({
        uiLibrary   : 'bootstrap4',
        format      : 'yyyy-mm-dd',
        maxDate     : today
    });

</script>
