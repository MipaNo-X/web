var weekday=new Array(7);
weekday[0]='Воскресенье';
weekday[1]='Понедельник';
weekday[2]='Вторник';
weekday[3]='Среда';
weekday[4]='Четверг';
weekday[5]='Пятница';
weekday[6]='Суббота';

function clock() {
    var d=new Date();
    $('#clock-cont').html(weekday[d.getDay()] + ' ' + d.toLocaleString());
    setTimeout(clock,100);
}

$(document).ready(function() {
    clock();
});