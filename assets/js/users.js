$(document).ready(function () {
    var table = 'users';
    var tableColumns = 'rest/user_rest/table_columns';
    var dataTables = 'rest/user_rest/datatables';
    var controller = 'usuarios';
    var columnDefs = [
        {targets: ['id'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                var html = '<a href="' + controller + '/editar/' + data + '">';
                html += '<button class="id_row btn btn-primary btn-xs">' + data + '</button>';
                html += '</a>';
                return html;
            }
        },
        {targets: ['name'], responsivePriority: 2, render:
                    function (data, type, full, meta) {
                        var color = (data === 'SUPERUSUARIO') ? 'default' : 'info';
                        return '<label class="label label-' + color + '" >' + data + '</label>';
                    }
        },
        {targets: ['password', 'id_group'], visible: false},
        {targets: ['state'], responsivePriority: 2, render:
                    function (data, type, full, meta) {
                        var color = (data === '1') ? 'success' : 'danger';
                        var state = (data === '1') ? 'Activo' : 'Inactivo';
                        return '<span class="label label-' + color + '" >' + state + '</span>';
                    }
        }
    ];
    var createButton = {
        'label': 'Crear nuevo usuario',
        'action': controller + '/crear'};
    createDataTable(table, tableColumns, dataTables, columnDefs, createButton);
});