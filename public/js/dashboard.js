$( document ).ready( function () {

    get_orders_by_month();

    get_monthly_volumes();

    function get_orders_by_month() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( data ) {

                let orders_by_month_data = data.orders;

                let month_names = [];

                let month_orders = [];

                for( let i in orders_by_month_data ) {
                    month_names.push( orders_by_month_data[i].order_month );
                    month_orders.push( orders_by_month_data[i].number_orders );
                }

                let orders_by_month_data_graph = {
                    labels      : month_names,
                    datasets    : [
                        {
                            label                   : "Number of orders",
                            backgroundColor         : "#efecec",
                            borderColor             : "#432774",
                            hoverBackgroundColor    : "#807d7d",
                            hoverBorderColor        : "#f4f4f4",
                            data                    : month_orders
                        }
                    ]
                }

                let monthly_orders_options = {
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
                        text        : "Number of orders",
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

                let monthly_orders_context = $( '#orders_by_month' );

                let monthly_orders_chart = new Chart( monthly_orders_context, {
                    type        : 'bar',
                    data        : orders_by_month_data_graph,
                    options     : monthly_orders_options
                });

            }, url      : 'api/orders_by_month'
        });

    }

    function get_monthly_volumes() {
        $.ajax({
            dataType    : 'json',
            method      : 'GET',
            success     : function ( monthly_volumes ) {

                let volume_moved = [];

                let order_month = [];

                for( let i in monthly_volumes ) {
                    volume_moved.push( monthly_volumes[i].volume_moved );
                    order_month.push( monthly_volumes[i].order_month );
                }

                let monthly_volumes_data_graph = {
                    labels      : order_month,
                    datasets    : [
                        {
                            label                   : "Volume moved",
                            backgroundColor         : "#efecec",
                            borderColor             : "#432774",
                            hoverBackgroundColor    : "#807d7d",
                            hoverBorderColor        : "#f4f4f4",
                            data                    : volume_moved
                        }
                    ]
                }

                let monthly_volumes_options = {
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
                        text        : "Volume moved",
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

                let monthly_volume_context = $( '#monthly_volume' );

                let monthly_volume_chart = new Chart( monthly_volume_context, {
                    type        : 'line',
                    data        : monthly_volumes_data_graph,
                    options     : monthly_volumes_options
                });

            }, url      : 'api/monthly_volumes'
        });
    }


});
