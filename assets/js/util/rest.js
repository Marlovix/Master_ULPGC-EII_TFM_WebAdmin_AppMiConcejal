var acceptModal = $('#accept-modal');
var titleModal = $('#accept-modal .js-title-step');
var acceptButtonModal = $('#accept-modal .btn-success');
var successModal = $('#accept-modal .alert-success');
var errorModal = $('#accept-modal .alert-danger');
var messageModal = $('#modal-message');
var deleteButton = $('[name=delete]');
var methodRest = '';

var overlay = $('.overlay');
overlay.css('display', 'none');

//serialize data function
function dataForm(formArray) {
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++) {
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

function filterForm(formArray) {
    var getURL = '?';
    for (var i = 0; i < formArray.length; i++) {
        if (formArray[i].value !== null && formArray[i].value !== '') {
            getURL += formArray[i]['name'] + '=' + formArray[i]['value'];
            if (i !== formArray.length - 1) {
                getURL += '&';
            }
        }
    }
    return getURL;
}

function rest(method, action, data) {
    return $.ajax({
        type: method,
        url: action,
        data: data,
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        processdata: false,
        beforeSend: function () {
            acceptButtonModal.button('loading');
            overlay.fadeIn();
        },
        complete: function () {
            acceptButtonModal.button('reset');
            overlay.fadeOut();
        }
    });
}

function openAcceptModal(title, message) {
    titleModal.text(title);
    messageModal.text(message);
    successModal.css('display', 'none');
    errorModal.css('display', 'none');
    acceptModal.modal({
        backdrop: 'static',
        keyboard: true
    });
}

function acceptActionModal(action, method, data, callback) {
    console.log(method);
    console.log(action);
    console.log(data);
    rest(method, action, data).done(function (response) {
        callback(response.success);
    }).fail(function (request, error) {
        errorModal.css('display', 'block');
        errorModal.text(error + '|' + request.status + '|' + request.statusText + '|' + request.responseText);
        return false;
    });
}