$( function () {

    get_visits_by_month();
    function get_visits_by_month() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( patient_visits ) {

                let visits_by_month_data = patient_visits.patient_visits;

                let month_names = [];

                let monthly_visits = [];

                for( let i in visits_by_month_data ) {
                    month_names.push( visits_by_month_data[i].visit_month );
                    monthly_visits.push( visits_by_month_data[i].patient_visits );
                }

                let entries_by_month_data_graph = {
                    labels      : month_names,
                    datasets    : [
                        {
                            label                   : "Number of visits",
                            backgroundColor         : "#efecec",
                            borderColor             : "#432774",
                            hoverBackgroundColor    : "#ec3437",
                            hoverBorderColor        : "#f4f4f4",
                            data                    : monthly_visits
                        }
                    ]
                }

                let monthly_entry_options = {
                    legend: {
                        display     : true,
                        position    : "bottom",
                        labels      : {
                            fontColor: "#000080",
                        }
                    },
                    title: {
                        display     : true,
                        position    : "top",
                        text        : "Number of visits",
                        fontSize    : 18,
                        fontColor   : "#432774"
                    },
                    responsive      : true,
                    scales: {
                        xAxes: [{
                            display: true
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                };

                let monthly_visits_context = $( '#patient_visits_by_month' );

                let monthly_entries_chart = new Chart( monthly_visits_context, {
                    type    : 'line',
                    data    : entries_by_month_data_graph,
                    options : monthly_entry_options
                });

            }, url      : 'api/patient-visits-by-month'
        });

    }

});
