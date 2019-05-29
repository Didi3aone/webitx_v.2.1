$(document).ready(function () {
    $('#loading').hide();
    $('#BtnSave').show();
    $('#BtnLoadingSave').hide();
    $("input").prop('', true);
});
$('.popup #popup-1 .popup-btn-close').click(function () {
    $('.popup #popup-1').fadeOut('slow', function () {
        $('.popup .popup-bg').hide('fast');
    });
});
$('.date-picker').daterangepicker({
    singleDatePicker: true,
    minDate: 'today',
    locale: {
        format: 'DD-MM-YYYY'
    }
}).val("");

$('.date-picker2').daterangepicker({
    singleDatePicker: true,
    locale: {
        format: 'DD-MM-YYYY'
    }
}).val("");

$('.time-picker').clockpicker({
    placement: 'left',
    align: 'left',
    autoclose: true,
    'default': 'now'
});
