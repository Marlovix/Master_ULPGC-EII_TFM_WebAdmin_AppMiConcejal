/* global deleteButton, inputsToValid, acceptButtonModal, successModal, acceptModal, errorModal, rest */

$(document).ready(function () {
    var form = $('form');
    var id = $('[name=id_concejal]');
    var action = form.prop('action');
    var distrito = $('[name=id_distrito]');
    var vocal = $('[name=vocal]');
    var cargo = $('[name=cargo]');
    var partido_politico = $('[name=id_partido_politico]');
    var state = $('[name=state]');

    createSelect2(distrito);
    createSelect2(vocal);
    createSelect2(cargo);
    createSelect2(partido_politico);
    createSelect2(state);

    $('.invisible-input').parent().css('display', 'none');

    setRequiredInputs(inputsToValid);

    form.on('submit', function (e) {
        if (validate()) {
            var title = (deleteButton.length) ?
                    'Editar concejal' :
                    'Nuevo concejal';
            var message = (deleteButton.length) ?
                    '¿Desea guardar los cambios de este concejal?' :
                    '¿Desea guardar este nuevo concejal?';
            methodRest = (deleteButton.length) ? 'PUT' : 'POST';
            action = (deleteButton.length) ? action + '/' + id.val() : action;
            openAcceptModal(title, message);
        }
        return false; // Do not reload the page after submit //
    });
    acceptButtonModal.on('click', function () {
        if (successModal.css('display') === 'none' &&
                errorModal.css('display') === 'none') {
            var data = form.serializeArray();
            var userData = formatUserData(data);
            console.log(action);
            acceptActionModal(action, methodRest, userData, callback);
        }
    });
    acceptModal.on('hidden.bs.modal', function () {
        if (successModal.css('display') === 'block') {
            window.location.href = '/AppMiConcejal/concejales/editar/' + successModal.children('b').text();
        }
    });
    deleteButton.on('click', function () {
        var title = 'Borrar referencia';
        var message = '¿Está seguro/a que quiere borrar este concejal?';
        action += '/' + id.val();
        methodRest = 'DELETE';
        openAcceptModal(title, message);
    });
    distrito.change(function () {
        if (distrito.val() === '') {
            vocal.select2('val', '0');
            vocal.prop('disabled', true);
        } else {
            console.log(distrito.val());
            vocal.prop('disabled', false);
            vocal.select2('val', '1');
        }
    });
});

function callback(message) {
    var id = message.substring(message.indexOf(">") + 1, message.lastIndexOf("<"));
    var form = $('form');
    var data = form.serializeArray();
    var concejalData = formatConcejalData(data);
    concejalData.id_user = id;
    if (!("vocal" in concejalData))
        concejalData.vocal = 0;
    concejalData = JSON.stringify(concejalData);
    var action = '/AppMiConcejal/rest/concejal_rest';
    if (methodRest !== 'POST') {
        action += '/' + id;
    }

    console.log(concejalData);

    rest(methodRest, action, concejalData).done(function (response) {
        var concejalMessage = response.success;
        var idConcejal = concejalMessage.substring(concejalMessage.indexOf(">") + 1, concejalMessage.lastIndexOf("<"));
        var timeMessage = 2000;
        successModal.html(concejalMessage);
        successModal.fadeIn();
        setTimeout(function () {
            if (methodRest === 'DELETE')
                window.location.href = '/AppMiConcejal/concejales';
            else
                window.location.href = '/AppMiConcejal/concejales/editar/' + idConcejal;
        }, timeMessage);
    }).fail(function (request, error) {
        errorModal.css('display', 'block');
        errorModal.text(error + '|' + request.status + '|' + request.statusText + '|' + request.responseText);
        return false;
    });
}

function formatUserData(data) {
    var formated = [];
    $.each(data, function (i, object) {
        switch (object.name) {
            case 'password':
                var id = $('[name=id_concejal]');
                if (id.val() === '') { // Si es nuevo usuario 
                    formated.push({name: object.name, value: object.value});
                }
                break;
            case 'id_concejal':
            case 'id_distrito':
            case 'vocal':
            case 'id_partido_politico':
            case 'cargo':
            case 'last_login':
            case 'repeat_password':
                break;
            case 'state':
                formated.push({name: 'active', value: object.value});
                break;
            default:
                formated.push(object);
                break;
        }
    });
    return JSON.stringify(dataForm(formated));
}

function formatConcejalData(data) {
    var formated = [];
    $.each(data, function (i, object) {
        switch (object.name) {
            case 'first_name':
            case 'last_name':
            case 'email':
            case 'phone':
            case 'created_on':
            case 'last_login':
            case 'password':
            case 'repeat_password':
                break;
            case 'state':
                formated.push({name: 'active', value: object.value});
                break;
            case 'id_distrito':
                if (object.value === '')
                    formated.push({name: 'id_distrito', value: ''});
                else
                    formated.push({name: 'id_distrito', value: object.value});
                break;
            default:
                formated.push(object);
                break;
        }
    });
    return dataForm(formated);
}