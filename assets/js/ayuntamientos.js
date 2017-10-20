$(document).ready(function () {
    var table = 'ayuntamiento';
    var tableColumns = 'rest/ayuntamiento_rest/table_columns';
    var dataTables = 'rest/ayuntamiento_rest/datatables';
    var controller = 'ayuntamientos';
    var createButton = {
        'label': 'Crear nuevo ayuntamiento',
        'action': controller + '/crear'};
    var columnDefs = [
        {targets: ['id_ayuntamiento'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                var html = '<a href="' + controller + '/editar/' + data + '">';
                html += '<button class="id_row btn btn-primary btn-xs">' + data + '</button>';
                html += '</a>';
                return html;
            }
        },
        {targets: ['facebook'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                if (data !== null) {
                    var html = '<a target="_blank" href="' + data + '">';
                    html += '<i class="fa fa-2x fa-facebook-official" aria-hidden="true"></i>';
                    html += '</a>';
                    return html;
                }
                return '';
            }
        }, {targets: ['twitter'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                if (data !== null) {
                    var html = '<a target="_blank" href="' + data + '">';
                    html += '<i class="fa fa-2x fa-twitter-square" aria-hidden="true"></i>';
                    html += '</a>';
                    return html;
                }
                return '';
            }
        }
    ];
    createDataTable(table, tableColumns, dataTables, columnDefs, createButton);
});