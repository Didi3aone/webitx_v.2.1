$(document).ready(function () {
    $('#loading').hide();
    $("input").prop('', true);
});
$('.popup #popup-1 .popup-btn-close').click(function () {
    $('.popup #popup-1').fadeOut('slow', function () {
        $('.popup .popup-bg').hide('fast');
    });
});
