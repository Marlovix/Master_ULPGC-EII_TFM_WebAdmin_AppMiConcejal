/* global deleteButton, inputsToValid, acceptButtonModal, successModal, acceptModal, errorModal, rest */

$(document).ready(function () {
    var form = $('form');
    var id = $('[name=id_ayuntamiento]');
    var action = form.prop('action');

    $('.invisible-input').parent().css('display', 'none');

    setRequiredInputs(inputsToValid);

    form.on('submit', function (e) {
        if (validate()) {
            var title = (deleteButton.length) ?
                    'Editar ayuntamiento' :
                    'Nuevo ayuntamiento';
            var message = (deleteButton.length) ?
                    '¿Desea guardar los cambios de este ayuntamiento?' :
                    '¿Desea guardar este nuevo ayuntamiento?';
            methodRest = (deleteButton.length) ? 'PUT' : 'POST';
            action = (deleteButton.length) ? action + '/' + id.val() : action;
            openAcceptModal(title, message);
        }
        return false; // Do not reload the page after submit //
    });
    acceptButtonModal.on('click', function () {
        if (successModal.css('display') === 'none' &&
                errorModal.css('display') === 'none') {
            var data = JSON.stringify(dataForm(form.serializeArray()));
            acceptActionModal(action, methodRest, data, callback);
        }
    });
    acceptModal.on('hidden.bs.modal', function () {
        if (successModal.css('display') === 'block') {
            window.location.href = '/AppMiConcejal/ayuntamientos/editar/' + successModal.children('b').text();
        }
    });

    deleteButton.on('click', function () {
        var title = 'Borrar ayuntamiento';
        var message = '¿Está seguro/a que quiere borrar este ayuntamiento?';
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
            window.location.href = '/AppMiConcejal/ayuntamientos';
        else
            window.location.href = '/AppMiConcejal/ayuntamientos/editar/' + id;
    }, timeMessage);
}