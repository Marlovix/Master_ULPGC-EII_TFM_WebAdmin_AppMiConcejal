var inputsToValid = $('input,textarea,select').filter('[required]:visible');

function validate() {
    var isValid = true;
    for (var i = 0; i < inputsToValid.length; i++) {
        if (!checkEmptyInput($(inputsToValid[i]))) {
            isValid = false;
        }
    }
    return isValid;
}

function checkEmptyInput(input) {
    input.parent().removeClass('has-error');
    hideErrorMessage(input);

    if (input.val() === '' || input.val() === null) {
        var message = 'Rellene este campo';
        showErrorMessage(input, message);
        return false;
    }

    if (input.prop('type') === 'email') {
        if (!validateEmail(input.val())) {
            var message = 'Introduzca un email válido';
            showErrorMessage(input, message);
            return false;
        }
    }

    if (input.prop('type') === 'password') {

        if (input.val().length < 6 || input.val().length > 15) {
            var message = 'La contraseña debe contener entre 6 y 15 caracteres';
            showErrorMessage(input, message);
            return false;
        }

        if (input.prop('name') === 'repeat_password') {
            if (input.val() !== $('[name=password]').val()) {
                var message = 'Las contraseñas no coinciden';
                showErrorMessage(input, message);
                return false;
            }
        }
    }
    return true;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function showErrorMessage(input, message) {
    if (!input.parent().hasClass('has-error')) {
        input.parent().addClass('has-error');
        input.parent().append('<div class="input-error alert alert-danger">' + message + '</div>');
    }
}

function hideErrorMessage(input) {
    input.parent().children('.input-error').remove();
}