function validate() {
    var valid_global = validate_form(document.form__contact),
        valid_specific = validate_contacts(document.form__contact);

    $(document.form__contact)
        .find('[type="submit"]')
        .prop('disabled', valid_global || valid_specific);
}

function validate_contacts(form) {
    var validates = [
        validate_field(form.name, /^[\wа-яё]+\s+[\wа-яё]+\s*[\wа-яё]*$/i, 'Введите в формате: Фамилия Имя Отчество'),
        validate_field(form.phone, /^\+?(?:380(\d){9}|7\s*\(?\d{3}\)?\s*(?:-?\d){7})$/i, 'Допустимы действительные номера +7 и +380'),
        validate_field(form.email, /^.+@.+\..+$/i, 'Введите действительную почту')
    ];
    for (var i = 0; i < validates.length; i++) {
        if (validates[i]) {
            return true;
        }
    }
    return false;
}

function initValidation() {
    var form = $(document.form__contact),
        inputs = form.find('input'),
        selects = form.find('select');
    inputs.on('change', validate);
    inputs
        .filter(':not([type="checkbox"]):not([type="radio"])')
        .on('keyup', validate);
    selects.on('change', validate);

}

$(document).ready(function () {
    // initValidation();
});