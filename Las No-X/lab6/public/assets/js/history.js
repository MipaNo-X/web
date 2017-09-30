function fillHistory(cont, history) {
    for(var page in history) {
        cont.append('<tr><td><a href="'+page+'">'+decodeURI(page)+'</a></td><td>'+history[page]+'</td></tr>');
    }
}

$(document).ready(function() {
    var localCont = $('#history-local'),
        cookieCont = $('#history-cookies');
    fillHistory(localCont, localGet('visits', {}));
    fillHistory(cookieCont, getCookie('visits'));
});