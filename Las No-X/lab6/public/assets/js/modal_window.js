$('document').ready(function () {
    function close_modal() {
        $('#modal_win')
            .animate({opacity: 0, top: '0'}, 200, function () {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    }

    $('body').append(
        $('<div></div>').attr('id', 'overlay'),
        $('<div></div>').attr('id', 'modal_win').append(
            $('<div></div>').addClass('modal_text').text('Вы действительно хотите очистить все?'),
            $('<button></button>')
                .addClass('form-control btn btn-block btn-default btn-my')
                .text('Да')
                .on('click', function () {
                    $('form').trigger('reset')
                        .find('input:not(#bres):not([type="submit"]), select').val('').prop('checked', false)
                        .end()
                        .find('option').prop('selected', false)
                        .filter(':disabled').prop('selected', true)
                        .end()
                        .end()
                        .find('textarea').html('')
                        .end()
                        .find('.validation-message').remove()
                        .end()
                        .find('.form-group').removeClass('has-error').removeClass('has-success');
                    $('.form-result').remove();
                    close_modal();
                }),
            $('<button></button>').addClass('form-control btn btn-block btn-default').attr('id', 'win_close').text('Нет')
        )
    );
    $('#win_close, #overlay').on('click', close_modal);

    $('#bres').on('click', function (event) {
        event.preventDefault();
        $('#overlay').fadeIn(400, function () {
            $('#modal_win')
                .css('display', 'block')
                .animate({opacity: 1, top: '50%'}, 200);
        });
    })
});