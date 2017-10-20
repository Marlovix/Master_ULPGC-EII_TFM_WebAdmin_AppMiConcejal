$(document).ready(function () {
    var table = 'distrito';
    var tableColumns = 'rest/distrito_rest/table_columns';
    var dataTables = 'rest/distrito_rest/datatables';
    var controller = 'distritos';
    var createButton = {
        'label': 'Crear nuevo distrito',
        'action': controller + '/crear'};
    var columnDefs = [
        {targets: ['id_distrito'], responsivePriority: 1,
            render: function (data, type, full, meta) {
                var html = '<a href="' + controller + '/editar/' + data + '">';
                html += '<button class="id_row btn btn-primary btn-xs">' + data + '</button>';
                html += '</a>';
                return html;
            }
        },{targets: ['id_ayuntamiento'], visible: false}
    ];
    createDataTable(table, tableColumns, dataTables, columnDefs, createButton);
});