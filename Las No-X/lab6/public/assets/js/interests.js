var list =  {
    type : 'ul',
    list_el : [
        {
            href : '#literature',
            test : 'Происхождение',
            children : {
                type : 'ul',
                list_el : [
                    {
                        href : '#loved_genres',
                        test : 'Биография'
                    },
                    {
                        href : '#loved_authors',
                        test : 'Семья'
                    }
                ]
            }
        },
        {
            href : '#music',
            test : 'Литература',
            children : {
                type : 'ul',
                list_el : [

                ]
            }
        }
    ]
};

function make_list(list) {
    var elements = '';
    for (var i=0; i<list.list_el.length; i++) {
        var el = list.list_el[i];
        elements +='<li><a href="'+el.href+'">'+el.test+'</a>';
        if (el.children) {
            elements+=make_list(el.children);
            elements +='</li>';
        }
        elements +='</li>';
    }
    return '<'+list.type+'>'+elements+'</'+list.type+'>';
}

function load_list() {
    $('#list-cont').html(make_list(list));
}