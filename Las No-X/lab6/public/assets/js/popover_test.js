$(document).ready(function () {
    var timer;
    $('[data-popover]')
        .on('mouseenter', function () {
            var $this = $(this);
            clearTimeout(timer);
            $('#id_popover').remove();
            var pop = $('<div></div>').attr('id', 'id_popover').text($this.data('popover'));
            $this.after(pop);
            pop.fadeIn(400);
        })
         .on('mouseleave', function () {
             var $this = $('#id_popover');
             timer = setTimeout(function () {
                 $this.fadeOut(400, function () {
                     $this.remove();
                 });

             }, 2000);
         });
});