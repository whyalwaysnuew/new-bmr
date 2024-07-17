"use strict";

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

// Class definition
var KTDatatablesAdvanced = function () {
    // Private functions

    var handleDataTableServerSide = function () {
        if ($('#datatable-serverside').length !== 0) {
            var protocol = $(location).attr('protocol');
            var host = $(location).attr('host');
            var url = $(location).attr('href').split('/');
            var value = url[3].split('?');
            

            $.getJSON(protocol + '//' + host + '/' + value[0] + '/getColumns',function(column){
                $('#datatable-serverside').DataTable({
                    dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    filter: true,
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        type: "POST",
                        url: protocol + '//' + host + '/' + value[0] + '/getData',
                        dataType: "json",
                        data: function (d) {
                            // Office & Employee Presence
                            d.office = ($('#office').val()) ? $('#office').val() : "";
                            d.employee = ($('#employee').val()) ? $('#employee').val() : "";
                            d.start_date = ($('#start_date').val()) ? $('#start_date').val() : "";
                            d.end_date = ($('#end_date').val()) ? $('#end_date').val() : "";
                            d.shift = ($('#shift').val()) ? $('#shift').val() : "";
                            d.airlines = ($('#airlines').val()) ? $('#airlines').val() : "";
                            d.payment = ($('#payment').val()) ? $('#payment').val() : "";
                            d.shipper = ($('#shipper').val()) ? $('#shipper').val() : "";
                            d.date = ($('#date').val()) ? $('#date').val() : "";
                            var split_dates = d.date.split("-");
                            d.date1 = formatDate(split_dates[0]) ? split_dates[0] : "";
                            d.date2 = formatDate(split_dates[1]) ? split_dates[1] : "";
                        }
                    },
                    columns: column
                });
            });
        }
    }

    var initZeroConfiguration = function() {
        $("#datatable-clientside").DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            filter: true,
            responsive: true,
        });
    }

    var initZeroConfiguration1 = function() {
        $("#datatable-clientside-scroll").DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>",
            scrollX: true,
            scrollY: 350,
            scrollCollapse: true,
            paging: false,
            filter: true,
            // responsive: true,
        });
    }

    // Public methods
    return {
        init: function () {
            handleDataTableServerSide();
            initZeroConfiguration();
            initZeroConfiguration1();
        }
    }
}();


function reloadTable() {
    var table = $('#datatable-serverside').DataTable();
    table.ajax.reload();
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTDatatablesAdvanced.init();
});
