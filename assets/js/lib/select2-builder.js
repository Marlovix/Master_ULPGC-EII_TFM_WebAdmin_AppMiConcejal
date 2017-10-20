function createSelect2(select) {
    var select2 = select;
    select2.select2({
        language: "es",
        allowClear: true,
        theme: "bootstrap",
        minimumResultsForSearch: Infinity, /* global Infinity */
        placeholder: 'No hay selección',
        height: 'resolve'
    });
    return select2;
}