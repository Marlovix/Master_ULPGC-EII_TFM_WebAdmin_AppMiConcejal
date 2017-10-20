$(document).ready(function () {
    var table = 'concejal';
    var tableColumns = 'rest/concejal_rest/table_columns';
    var dataTables = 'rest/concejal_rest/datatables';
    var controller = 'concejales';
    var createButton = {
        'label': 'Crear nuevo concejal',
        'action': controller + '/crear'};
    var columnDefs = [
        {targets: ['id_concejal'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                var html = '<a href="' + controller + '/editar/' + data + '">';
                html += '<button class="id_row btn btn-primary btn-xs">' + data + '</button>';
                html += '</a>';
                return html;
            }
        },
        {targets: ['state'], render: function (data, type, full, meta) {
                var color = (data === '1') ? 'success' : 'default';
                var state = (data === '1') ? 'Activo' : 'Inactivo';
                return '<span class="label label-' + color + '" >' + state + '</span>';
            }
        },
        {targets: ['vocal'], render: function (data, type, full, meta) {
                var color = (data === '1') ? 'success' : 'danger';
                var state = (data === '1') ? 'Sí' : 'No';
                return '<span class="label label-' + color + '" >' + state + '</span>';
            }
        },
        {targets: ['id_user', 'id_distrito', 'id_ayuntamiento', 'id_partido_politico', 'password', 'last_login'], visible: false}
    ];
    createDataTable(table, tableColumns, dataTables, columnDefs, createButton);
});