/* global getColumns, getData, rest */
function createDataTable(table, tableColumns, dataTables, defs, createButton) {
    $.when(rest('GET', tableColumns),
            rest('GET', dataTables))
            .done(function (responseColumns, responseData) {
                var dataTablesColumns = responseColumns[0].success;
                var data = responseData[0].success;
                var columnsTable = [{data: null, className: 'control', sortable: false, defaultContent: ''}];
                $.each(dataTablesColumns, function (field, column) {
                    // check if field exists in data //
                    columnsTable.push({'title': column, 'data': field, 'className': 'center-th ' + field});
                });
                columnDefs = [];
                $.each(defs, function (index, def) {
                    var targets = def.targets;
                    def.targets = getColumnIndexesWithClass(dataTablesColumns, targets);
                    columnDefs.push(def);
                });
                var numRows = [10, 20, 30];
                $('#' + table).DataTable({
                    aoColumns: columnsTable,
                    aaData: data,
                    aoColumnDefs: columnDefs,
                    aaSorting: [[1, 'asc']],
                    lengthMenu: numRows,
                    iDisplayLength: numRows[0],
                    bLengthChange: false,
                    language: {
                        'url': 'assets/json/datatable.es.json', 'decimal': ',', 'thousands': '.'
                    },
                    responsive: {
                        details: {
                            type: 'column'
                        }
                    },
                    fnDrawCallback: function (oSettings) {
                        $(".buttons-page-length").text("Mostrar " + oSettings._iDisplayLength + " filas");
                    },
                    initComplete: function () {
                        $(this).css('width', '100%');

                        var api = this.api();

                        var half = '.col-sm-6:eq(0)';
                        if (createButton.label !== '') {
                            half = '.dataTables_filter';
                            var html = '<div class="dt-buttons">';
                            html += '<a href="' + createButton.action + '" class="btn btn-primary btn-sm">';
                            html += '<span class="glyphicon glyphicon-plus"></span>&nbsp;' + createButton.label + '</a></div>';
                            $('#' + api.table().container().id + ' .col-sm-6:eq(0)').prepend(html);
                        }

                        new $.fn.dataTable.Buttons(api, {
                            buttons: [
                                {
                                    extend: 'excel',
                                    className: 'btn-primary btn-sm',
                                    title: table + "-" + getCurrentDateTime(),
                                    text: '<i class="fa fa-file-excel-o fa-fw"></i> Exportar',
                                    exportOptions: {
                                        modifier: {
                                            page: 'current'
                                        }
                                    }
                                },
                                {
                                    extend: 'pageLength',
                                    className: 'btn-primary btn-sm',
                                    text: "Mostrar " + numRows[0] + " filas"
                                }
                            ]
                        });
                        api.buttons().container().prependTo('#' + api.table().container().id + ' ' + half);
                    }
                });
            }).fail(function (request, error) {
        console.log('Error: ' + error);
        console.log('Service call failed: ' + request.status + ' ' + request.statusText);
        console.log(request.responseText);
        return false;
    });
}

function getColumnIndexesWithClass(columns, classNames) {
    var indexes = [];
    $.each(classNames, function (i, className) {
        var index = 1;
        $.each(columns, function (field, columnInfo) {
            if (field === className) {
                indexes.push(index);
            } else {
                index++;
            }
        });
    });
    return indexes;
}