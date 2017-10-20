/* global deleteButton, inputsToValid, acceptButtonModal, successModal, acceptModal, errorModal, rest */

$(document).ready(function () {
    var form = $('form');
    var id = $('[name=id]');
    var action = form.prop('action');
    var state = $('[name=state]');
    var name = $('[name=id_group]');

    createSelect2(name);
    createSelect2(state);

    $('.invisible-input').parent().css('display', 'none');

    $.each(inputsToValid, function (i, input) {
        var labelFor = $(input).prop('name');
        var label = $('label[for="' + labelFor + '"]').text();
        $('label[for="' + labelFor + '"]').text(label + ' *');
    });

    form.on('submit', function (e) {
        if (validate()) {
            var title = (deleteButton.length) ?
                    'Editar usuario' :
                    'Nuevo usuario';
            var message = (deleteButton.length) ?
                    '¿Desea guardar los cambios de este usuario?' :
                    '¿Desea guardar este nuevo usuario?';
            methodRest = (deleteButton.length) ? 'PUT' : 'POST';
            action = (deleteButton.length) ? action + '/' + id.val() : action;
            openAcceptModal(title, message);
        }
        return false; // Do not reload the page after submit //
    });
    acceptButtonModal.on('click', function () {
        if (successModal.css('display') === 'none' &&
                errorModal.css('display') === 'none') {
            if (methodRest === 'DELETE') {
                acceptActionModal(action, methodRest, null, callbackDelete);
            } else {
                var data = formatData(form.serializeArray());
                acceptActionModal(action, methodRest, data, callback);
            }
        }
    });
    acceptModal.on('hidden.bs.modal', function () {
        if (successModal.css('display') === 'block') {
            window.location.href = '/AppMiConcejal/usuarios/editar/' + successModal.children('b').text();
        }
    });

    deleteButton.on('click', function () {
        var title = 'Borrar referencia';
        var message = '¿Está seguro/a que quiere borrar este usuario?';
        action += '/' + id.val();
        methodRest = 'DELETE';
        openAcceptModal(title, message);
    });
});



function callback(message) {
    var id = message.substring(message.indexOf(">") + 1, message.lastIndexOf("<"));
    var action = '/AppMiConcejal/rest/asignar_perfil_rest';
    if (methodRest === 'PUT') {
        action += '/' + id;
    }
    var data = {user_id: id, group_id: $('[name=id_group]').val()};
    
    console.log(action);
    console.log(JSON.stringify(data));
    rest(methodRest, action, JSON.stringify(data)).done(function () {
        var timeMessage = 2000;
        successModal.html(message);
        successModal.fadeIn();
        setTimeout(function () {
            acceptModal.modal('hide');
        }, timeMessage);
    }).fail(function (request, error) {
        errorModal.css('display', 'block');
        errorModal.text(error + '|' + request.status + '|' + request.statusText + '|' + request.responseText);
        return false;
    });
}

function callbackDelete(message) {
    var timeMessage = 2000;
    successModal.html(message);
    successModal.fadeIn();
    setTimeout(function () {
        window.location.href = '/AppMiConcejal/usuarios';
    }, timeMessage);
}

function formatData(data) {
    var formated = [];
    $.each(data, function (i, object) {
        switch (object.name) {
            case 'password':
                if ($('[name=id]').val() === '') { // Si es nuevo usuario 
                    formated.push({name: object.name, value: object.value});
                }
                break;
            case 'last_login':
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