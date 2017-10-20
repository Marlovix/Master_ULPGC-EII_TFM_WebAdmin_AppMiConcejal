$(document).ready(function () {
    var table = 'partido_politico';
    var tableColumns = 'rest/partido_politico_rest/table_columns';
    var dataTables = 'rest/partido_politico_rest/datatables';
    var controller = 'partidos_politicos';
    var createButton = {
        'label': 'Crear nuevo partido politico',
        'action': controller + '/crear'};
    var columnDefs = [
        {targets: ['id_partido_politico'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                var html = '<a href="' + controller + '/editar/' + data + '">';
                html += '<button class="id_row btn btn-primary btn-xs">' + data + '</button>';
                html += '</a>';
                return html;
            }
        },
        {targets: ['logotipo'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                if (data !== null && data !== '') {
                    var html = '<img src="assets/uploads/partidos_politicos/logotipos/' + data + '">';
                    return html;
                }
                return '';
            }
        },
        {targets: ['color'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                if (data === null) {
                    return data;
                }
                var html = '<span class="btn" style="width: 100%; background-color:' + data + ';"></span>';
                return html;
            }
        }
    ];
    createDataTable(table, tableColumns, dataTables, columnDefs, createButton);
});