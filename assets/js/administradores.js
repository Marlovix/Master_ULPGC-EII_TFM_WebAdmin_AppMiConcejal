$(document).ready(function () {
    var table = 'users';
    var tableColumns = 'rest/administrador_rest/table_columns';
    var dataTables = 'rest/administrador_rest/datatables';
    var createButton = {'label': ''};
    var columnDefs = [
        {targets: ['ayuntamiento'], render: function (data, type, full, meta) {
                var color = (data !== null) ? 'info' : 'default';
                var content = (data !== null) ? data : 'Asignar ayuntamiento';
                var html = '<a class="id_row btn btn-' + color + ' btn-xs">' + content + '</a>';

                $('.id_row').click(function () {
                    var idAdministrador = $(this).parent().parent().children('.id').text();
                    window.location.href = '/AppMiConcejal/administradores/asignar_ayuntamiento/' + idAdministrador;
                });

                return html;
            }
        },
        {targets: ['state'], render: function (data, type, full, meta) {
                var color = (data === '1') ? 'success' : 'default';
                var state = (data === '1') ? 'Activo' : 'Inactivo';
                return '<span class="label label-' + color + '" >' + state + '</span>';
            }
        },
        {targets: ['id_ayuntamiento'], visible: false}
    ];
    createDataTable(table, tableColumns, dataTables, columnDefs, createButton);
});