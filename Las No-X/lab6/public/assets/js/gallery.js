var gallery_el = [];
for (var i = 1; i <= 15; i++) {
    gallery_el.push({
        id: i,
        caption: "Фото " + i,
        alt: "Фото " + i,
        title: "Фото " + i,
        src: 'img/' + i + '.jpg',
        thumb: 'img/' + i + '_thumb.jpg'
    });
}

function load_gallery() {
    var cont = $('#gallery-cont');
    // cont.html('');
    // for (var i = 0; i < gallery_el.length; i++) {
    //     var el = gallery_el[i];
    //     cont.append('<div class="gallery-item"><img src="' + el.thumb + '" data-full="' + el.src + '" alt="' + el.alt + '" title="' + el.title + '" data-index="'+i+'"><span>' + el.caption + '</span></div>');
    // }
    initLightbox(cont);
}

function initLightbox(cont) {
    cont.find('img')
        .on('click', function () {
            lightbox_open(cont, $(this).data('index'));
        });
}

function lightbox_open(images, index) {
    var cont = $(document.body),
        lightbox = $('<div></div>'),
        container = $('<div></div>'),
        items = $('<div></div>');

    cont.append(
        lightbox.attr('id', 'lightbox')
            .append(
                $('<div></div>')
                    .addClass('prev')
                    .text('← Назад')
                    .on('click', lightbox_prev),
                container
                    .addClass('lightbox-items'),
                $('<div></div>')
                    .addClass('next')
                    .text('Вперёд →')
                    .on('click', lightbox_next)
            )
    ).addClass('lightbox');

    $(document)
        .bind('keydown', 'left', lightbox_prev)
        .bind('keydown', 'right', lightbox_next);

    images.find('img').each(function (i) {
        var $this = $(this);
        container.append(
            $('<div></div>')
                .addClass('lightbox-item')
                .addClass(i === index ? 'current' : '')
                .append(
                    $('<img/>')
                        .attr('src', $this.data('full') ? $this.data('full') : $this.attr('src'))
                        .attr('alt', $this.attr('alt'))
                        .attr('title', $this.attr('title')),
                    $('<span></span>')
                        .addClass('legend')
                        .text($this.siblings('span').text())
                )
        );
    });

    setTimeout(function () {
        lightbox.addClass('show');
    }, 100);
    lightbox.find('.lightbox-item').on('click', function () {
        lightbox.removeClass('show')
            .parent().removeClass('lightbox');
        setTimeout(function () {
            lightbox.remove();
        }, 350);
    });
}

function lightbox_prev() {
    var lightbox = $('#lightbox'),
        items = lightbox.find('.lightbox-item'),
        current = items.filter('.current'),
        prev = current.prev();

    if (prev.length === 0) {
        prev = items.last();
    }

    prev.css({
        left: '-100vw',
        opacity: 1
    });
    current.animate({
        left: '150vw'
    }, 300, function () {
    });
    prev.animate({
        left: '50%'
    }, 300, function () {
        items
            .removeClass('current')
            .css({
                opacity: '',
                left: ''
            });
        $(this).addClass('current');
    });
}

function lightbox_next() {
    var lightbox = $('#lightbox'),
        items = lightbox.find('.lightbox-item'),
        current = items.filter('.current'),
        next = current.next();

    if (next.length === 0) {
        next = items.first();
    }

    next.css({
        left: '150vw',
        opacity: 1
    });
    current.animate({
        left: '-100vw'
    }, 300, function () {
        $(this).removeClass('current');
    });
    next.animate({
        left: '50%'
    }, 300, function () {
        items
            .removeClass('current')
            .css({
                opacity: '',
                left: ''
            });
        $(this).addClass('current');
    });
}

$(document).ready(function () {
    load_gallery();
});