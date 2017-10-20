function getCurrentDateTime() {
    var currentdate = new Date();
    var fecha = currentdate.getFullYear() + '-';
    if (((currentdate.getMonth() + 1).toString().length === 1)) {
        fecha += '0';
    }
    fecha += (currentdate.getMonth() + 1).toString() + '-';
    if (currentdate.getDate().toString().length === 1) {
        fecha += '0';
    }
    fecha += currentdate.getDate().toString() + '_';
    if (currentdate.getHours().toString().length === 1) {
        fecha += '0';
    }
    fecha += currentdate.getHours().toString() + '.';
    if (currentdate.getMinutes().toString().length === 1) {
        fecha += '0';
    }
    fecha += currentdate.getMinutes().toString() + '.';
    if (currentdate.getSeconds().toString().length === 1) {
        fecha += '0';
    }
    fecha += currentdate.getSeconds().toString();
    return fecha;
}

function setRequiredInputs(inputs) {
    $.each(inputs, function (i, input) {
        var labelFor = $(input).prop('name');
        var label = $('label[for="' + labelFor + '"]').text();
        $('label[for="' + labelFor + '"]').text(label + ' *');
    });
}