/* global deleteButton, inputsToValid, acceptButtonModal, successModal, acceptModal, errorModal, rest, dataForm */

$(document).ready(function () {
    var form = $('form');
    var id = $('[name=id_partido_politico]');
    var action = form.prop('action');
    var logotipo = $('[name=logotipo]');
    var color = $('#color');

    createFileInput(logotipo);
    createColorPicker(color);

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
            if (logotipo.val() !== '') {
                uploadLogotipo(logotipo, form, action); // After upload file data will be sent
            } else {
                var data = JSON.stringify(dataForm(form.serializeArray()));
                acceptActionModal(action, methodRest, data, callback);
            }
        }
    });
    acceptModal.on('hidden.bs.modal', function () {
        if (successModal.css('display') === 'block') {
            window.location.href = '/AppMiConcejal/partidos_politicos/editar/' + successModal.children('b').text();
        }
    });

    deleteButton.on('click', function () {
        var title = 'Borrar referencia';
        var message = '¿Está seguro/a que quiere borrar este partido político?';
        action += '/' + id.val();
        methodRest = 'DELETE';
        openAcceptModal(title, message);
    });
});

function uploadLogotipo(logotipo, form, action) {
    if (logotipo.val() !== '') {
        var file = logotipo.prop('files')[0];
        var fileData = new FormData();
        fileData.append('logotipo', file);

        $.ajax({
            url: '/AppMiConcejal/partidos_politicos/upload_controller/do_upload',
            contentType: false,
            processData: false,
            data: fileData,
            type: 'post',
            success: function (response) {
                var status = $.parseJSON(response);
                var uploadFile = status.success;
                var data = dataForm(form.serializeArray());
                data.logotipo = uploadFile.file_name;
                acceptActionModal(action, methodRest, JSON.stringify(data), callback);
                return false;
            }
        });
    }
}

function callback(message) {
    var timeMessage = 2000;
    var id = message.substring(message.indexOf(">") + 1, message.lastIndexOf("<"));
    successModal.html(message);
    successModal.fadeIn();
    setTimeout(function () {
        if (methodRest === 'DELETE')
            window.location.href = '/AppMiConcejal/partidos_politicos';
        else
            window.location.href = '/AppMiConcejal/partidos_politicos/editar/' + id;
    }, timeMessage);
}