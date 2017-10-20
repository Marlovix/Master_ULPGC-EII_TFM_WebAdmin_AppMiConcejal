/* global deleteButton, inputsToValid, acceptButtonModal, successModal, acceptModal, errorModal, rest */

$(document).ready(function () {
    var form = $('form');
    var id = $('[name=id_distrito]');
    var action = form.prop('action');

    $('.invisible-input').parent().css('display', 'none');

    $.each(inputsToValid, function (i, input) {
        var labelFor = $(input).prop('name');
        var label = $('label[for="' + labelFor + '"]').text();
        $('label[for="' + labelFor + '"]').text(label + ' *');
    });

    form.on('submit', function (e) {
        if (validate()) {
            var title = (deleteButton.length) ?
                    'Editar distrito' :
                    'Nuevo distrito';
            var message = (deleteButton.length) ?
                    '¿Desea guardar los cambios de este distrito?' :
                    '¿Desea guardar este nuevo distrito?';
            methodRest = (deleteButton.length) ? 'PUT' : 'POST';
            action = (deleteButton.length) ? action + '/' + id.val() : action;
            openAcceptModal(title, message);
        }
        return false; // Do not reload the page after submit //
    });
    acceptButtonModal.on('click', function () {
        if (successModal.css('display') === 'none' &&
                errorModal.css('display') === 'none') {
            var data = formatData(form.serializeArray());
            acceptActionModal(action, methodRest, data, callback);
        }
    });
    acceptModal.on('hidden.bs.modal', function () {
        if (successModal.css('display') === 'block') {
            window.location.href = '/AppMiConcejal/distritos/editar/' + successModal.children('b').text();
        }
    });

    deleteButton.on('click', function () {
        var title = 'Borrar referencia';
        var message = '¿Está seguro/a que quiere borrar este distrito?';
        action += '/' + id.val();
        methodRest = 'DELETE';
        openAcceptModal(title, message);
    });
});

function callback(message) {
    var timeMessage = 2500;
    var id = message.substring(message.indexOf(">") + 1, message.lastIndexOf("<"));
    successModal.html(message);
    successModal.fadeIn();
    setTimeout(function () {
        if (methodRest === 'DELETE')
            window.location.href = '/AppMiConcejal/distritos';
        else
            window.location.href = '/AppMiConcejal/distritos/editar/' + id;
    }, timeMessage);
}

function formatData(data) {
    var formated = [];
    $.each(data, function (i, object) {
        switch (object.name) {
            case 'id_distrito':
                break;
            default:
                formated.push(object);
                break;
        }
    });
    return JSON.stringify(dataForm(formated));
}