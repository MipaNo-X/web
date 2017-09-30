$(document).ready(function () {
    initDropdown();
    initHover();
    visit();
});

// Storage functions
var storage = typeof(Storage) !== undefined ? localStorage : undefined;
function localStore(action, key, val) {
    var ret_val = undefined;
    if (storage !== undefined) {
        var data;
        try {
            data = JSON.parse(storage[key]);
        } catch (e) {
            data = {};
        }
        ret_val = data;
        if (action === 'set' && val !== undefined) {
            data = val;
        }
        storage[key] = JSON.stringify(data);
    }
    return ret_val;
}
function localSet(key, val) {
    return localStore('set', key, val);
}
function localGet(key, def) {
    return localStore('get', key, def);
}
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + JSON.stringify(value);
}
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? JSON.parse(decodeURIComponent(matches[1])) : undefined;
}

function visit() {
    var local = localGet('visits', {}),
        cookie = getCookie('visits'),
        loc = window.location.pathname;
    if (cookie === undefined) {
        cookie = {};
    }
    if (!local[loc]) {
        local[loc] = 0;
    }
    if (!cookie[loc]) {
        cookie[loc] = 0;
    }
    local[loc]++;
    cookie[loc]++;
    localSet('visits', local);
    setCookie('visits', local);
}

function leftPad(str, len, ch) {
    str = str + '';
    len = len - str.length;
    if (len <= 0) return str;
    if (!ch && ch !== 0) ch = ' ';
    ch = ch + '';
    var pad = '';
    while (true) {
        if (len & 1) pad += ch;
        len >>= 1;
        if (len) ch += ch;
        else break;
    }
    return pad + str;
}

function validate_field(field, regex, message) {
    var hasError = false;
    if (field) {
        var $field = $(field),
            value = $field.val(),
            p = $field.parent('.form-group'); // parent(field, 'form-group');
        if (!regex.test(value)) {
            p.removeClass('has-success');
            p.addClass('has-error');
            hasError = true;
            if (message) {
                var msg = $('<div></div>')
                    .addClass('validation-message');
                msg.text(message);
                p.append(msg);
                field.setCustomValidity(message);
            } else {
                field.setCustomValidity('Поле заполнено некорректно')
            }
        } else {
            p.addClass('has-success');
            p.removeClass('has-error');
            field.setCustomValidity('');
        }
    }
    return hasError;
}

function initDropdown() {
    $('.dropdown')
        .on('mouseenter', function () {
            $(this).addClass('open');
        })
        .on('mouseleave', function () {
            $(this).removeClass('open');
        });
}

function validate_form(form) {
    var hasError = false;
    for (var i = 0, len = form.elements.length; i < len; i++) {
        var element = form.elements[i],
            $element = $(element),
            p = $element.parent('.form-group');
        if (p) {
            p.find('.validation-message').remove();
            p.removeClass('valid').removeClass('invalid');
            if ($element.is(':required') && $element.val().trim() === '') {
                p.addClass('invalid');
                hasError = true;
            } else {
                p.addClass('valid');
            }
        }
    }
    return hasError;
}

function photo_change1() {
    $('#mainimg').attr('src', '/assets/img/image_ch1.jpg');
}

function photo_change2() {
    $('#mainimg').attr('src', '/assets/img/image_ch2.jpg');
}

function photo_return() {
    $('#mainimg').attr('src', '/assets/img/image.jpg');
}

function initHover() {
    var list = $('#menu').find('li');
    list.filter(':even').on('mouseenter', photo_change1);
    list.filter(':odd').on('mouseenter', photo_change2);
    list.on('mouseleave', photo_return);
}