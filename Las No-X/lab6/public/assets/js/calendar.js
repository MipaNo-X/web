function calendar_parse(value, not_now) {
    if (value) {
        value = value.split('.');
        return new Date(value[2], value[0] - 1, value[1]);
    }
    return not_now ? undefined : new Date();
}

function calendar_month_length(date) {
    var tmp = new Date(date.getFullYear(), date.getMonth() + 1, -1);
    return tmp.getDate() + 1;
}

function calendar_week_offset(date) {
    var tmp = new Date(date.getFullYear(), date.getMonth(), 1);
    return tmp.getDay() === 0 ? 7 : tmp.getDay() - 1;
}

function calendar_day_click() {
    var $this = $(this),
        cal = $('#calendar'),
        field = cal.siblings('input'),
        tds = cal.find('td');

    tds.removeClass('selected');

    $this.addClass('selected');
    field.val(leftPad($('#calendar-month').val(), 2, '0') + '.' + leftPad($this.text(), 2, '0') + '.' + $('#calendar-year').val());
    field.trigger('change');
    cal.remove();
}

function calendar_select_change() {
    var cal = $('#calendar'),
        field = cal.siblings('input'),
        tbody = $('#calendar-body'),
        month = $('#calendar-month'),
        year = $('#calendar-year');
    tbody.html('');
    calendar_generate_body(tbody, new Date(year.val(), month.val() - 1, 1), calendar_parse(field.val()));
}

function calendar_generate_months(date) {
    var month = $('<select></select>'),
        months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    for (var i = 0; i < months.length; i++) {
        var option = $('<option></option>');
        option.val(i + 1);
        option.text(months[i]);
        if (i === date.getMonth()) {
            option.prop('selected', true);
        }
        month.append(option);
    }
    return month
        .attr('id', 'calendar-month')
        .on('change', calendar_select_change);
}

function calendar_generate_years(date) {
    var year = $('<select></select>'),
        now = new Date();
    for (var i = now.getFullYear() - 100; i <= now.getFullYear(); i++) {
        var option = $('<option></option>');
        option.text(i);
        if (i === date.getFullYear()) {
            option.prop('selected', true);
        }
        year.append(option);
    }
    return year
        .attr('id', 'calendar-year')
        .on('change', calendar_select_change);
}

function calendar_generate_week() {
    var tr = $('<tr></tr>');
    var week_days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
    for (var i = 0; i < week_days.length; i++) {
        var th = $('<th></th>');
        th.text(week_days[i]);
        tr.append(th);
    }
    return tr;
}

function calendar_generate_body(tbody, date, selected) {
    var month_length = calendar_month_length(date),
        week_offset = calendar_week_offset(date),
        tr = $('<tr></tr>');
    for (var day = 1, pos = 1; day <= month_length || pos % 7 !== 1; pos++) {
        var td = $('<td></td>');
        td.attr('class', 'disabled');
        if (week_offset > 0) {
            week_offset--;
        } else if (day <= month_length) {
            td.text(day);
            td.attr('class',
                selected &&
                selected.getFullYear() === date.getFullYear() &&
                selected.getMonth() === date.getMonth() &&
                selected.getDate() === day
                    ? 'selected'
                    : ''
            );
            td.on('click', calendar_day_click);
            day++;
        }
        tr.append(td);
        if (pos % 7 === 0) {
            tbody.append(tr);
            tr = $('<tr></tr>');
        }
    }
}

function create_calendar(value) {
    var el = $('<div></div>'),
        header = $('<div></div>'),
        body = $('<div></div>'),
        table = $('<table></table>'),
        thead = $('<thead></thead>'),
        tbody = $('<tbody></tbody>'),
        date = calendar_parse(value);

    header.append(calendar_generate_months(date))
        .append(calendar_generate_years(date))
        .addClass('calendar-header');

    thead.append(calendar_generate_week());

    calendar_generate_body(tbody, date, calendar_parse(value, true));
    tbody.attr('id', 'calendar-body');

    table.append(thead)
        .append(tbody);

    body.append(table)
        .addClass('calendar-body');

    return el.append(header)
        .append(body)
        .attr('id', 'calendar');
}

function open_calendar() {
    var $this = $(this),
        calendar = $('#calendar');
    if (calendar) {
        calendar.remove();
    }
    $this.trigger('change')
        .parent()
        .append(create_calendar($this.val()));
}

$(document).ready(function() {
    $('.js-calendar').on('click', open_calendar);
});