function createTypeahead(source, table, field) {
    var input = $('.typeahead');
    input.typeahead({hint: true, highlight: true, minLength: 1}, {
        name: table,
        display: field, // This is setted in the input after select an option //
        source: source,
        templates: {
            suggestion: function (obj) {
                return '<div>' + obj.name + '</div>';
            },
            empty: [
                '<div class="no-typeahead-results">',
                'No hay resultados.',
                '</div>'
            ].join('\n')
        }
    });

    return input;
}