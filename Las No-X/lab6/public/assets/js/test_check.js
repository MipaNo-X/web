function validate() {
    var valid_global = validate_form(document.form__test),
        valid_specific = validate_test(document.form__test);

    $(document.form__test)
        .find('[type="submit"]')
        .prop('disabled', valid_global || valid_specific);
}

function validate_test(form) {
    var validates = [
        validate_field(form.name, /^[\wа-яё]+\s+[\wа-яё]+\s*[\wа-яё]*$/i, 'Введите в формате: Фамилия Имя Отчество'),
        validate_field(form.ans, /^([a-zа-яё0-9]+[\.,;!\?\s]+){34}[a-zа-яё0-9]+[\.,;!\?\s]*/i, 'Должно быть введено не меньше 35 слов')
    ];
    for (var i = 0; i < validates.length; i++) {
        if (validates[i]) {
            return true;
        }
    }
    return false;
}

function initValidation() {
    var form = $(document.form__test),
        inputs = form.find('input'),
        selects = form.find('select');
    inputs.on('change', validate);
    inputs
        .filter(':not([type="checkbox"]):not([type="radio"])')
        .on('keyup', validate);
    selects.on('change', validate);
}

//$(document).ready(function() {
//    initValidation();
//});