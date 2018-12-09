$(document).ready(function() {
    let instructions = $('.list >li');

    instructions.click(function(e) {
        if ($(this).hasClass('text-muted')) {
            $(this).removeClass('text-muted');
        } else {
            $(this).addClass('text-muted');
        }
    });

    $('#nb_person_nbPerson').change(function(e) {
        $('form').submit();
    });

});
