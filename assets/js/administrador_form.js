/* global deleteButton, inputsToValid, acceptButtonModal, successModal, acceptModal, errorModal, rest */

$(document).ready(function () {
    var idAyuntamiento = $('[name=id_ayuntamiento]');
    var idUser = $('[name=id_user]');
    var submit = $('[name=submit]');
    var method = $('[name=method_ayuntamiento]');
    var form = $('form');
    var action = form.prop('action');

    createSelect2(idAyuntamiento);

    setRequiredInputs(inputsToValid);

    submit.click(function () {
        if (validate()) {
            var title = 'Asignar ayuntamiento';
            var message = '¿Desea asignar este ayuntamiento?';
            methodRest = method.val();
            openAcceptModal(title, message);
        }
        return false;
    });

    acceptButtonModal.on('click', function () {
        if (successModal.css('display') === 'none' &&
                errorModal.css('display') === 'none') {
            if (methodRest === 'PUT') {
                action += '/' + idUser.val();
            }

            var data = JSON.stringify(dataForm(form.serializeArray()));
            acceptActionModal(action, methodRest, data, callback);
        }
        return false;
    });
    acceptModal.on('hidden.bs.modal', function () {
        if (successModal.css('display') === 'block') {
            window.location.href = '/AppMiConcejal/administradores';
        }
    });
});
function callback() {
    var timeMessage = 5000;
    var idUser = $('[name=id_user]');
    var message = 'Nuevo registro creado con número de identificación: <b>' + idUser.val() + '</b>';
    successModal.html(message);
    successModal.fadeIn();
    setTimeout(function () {
        acceptModal.modal('hide');
    }, timeMessage);
}