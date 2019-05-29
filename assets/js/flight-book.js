//View Detail Itenary on Cick
$(document).on("click", ".btn_view_details", function () {
    $(this).parents('.col-root').find('.detail_itenary').hide();
    $(this).parents('.col-root').find('.detail_price').hide();
    $(this).parents('.col-root').find('.btn_view_details').show();
    $(this).hide();
    $(this).parents('.ticket-packet').find('.detail_itenary').slideDown(300);
    $(this).parents('.ticket-packet').find('.detail_price').slideDown(300);
    // $('.ticket-packet').css('border','none');
    // $(this).parents('.ticket-packet').css('border','2px solid #c61f37');
});

$(document).on("click", ".btn_close_details", function () {
    $(this).parents('.ticket-packet').find('.detail_itenary').slideUp(300);
    $(this).parents('.ticket-packet').find('.detail_price').slideUp(300);
    $('.btn_view_details').show();
    // $('.ticket-packet').css('border','none');
});
//End of View Detail Itenary on Click

// --- Expand Detail Itinerary --- //
$(document).on("click", ".expand-itinerary", function () {
    var col = $(this).parents('.ticket-packet');
    if(col.find('.itinerary-body').css('display') == 'block'){
        col.find('.itinerary-body').slideUp(300);
        col.find(this).find('img').attr('src',baseUrl+'assets/images/icon/expand-plus.png');
    }else{
        col.find('.itinerary-body').slideDown(300);
        $(this).find('img').attr('src',baseUrl+'assets/images/icon/expand-min.png')
    }
});
// --- End Expand Detail Itinerary --- //

$('#date-return').parent().parent().css({
    WebkitTransition : 'all .4s ease',
    MozTransition : 'all .4s ease',
    MsTransition : 'all .4s ease',
    OTransition : 'all .4s ease',
    Transition : 'all .4s ease'
});

$('#date-departure').parent().parent().css({
    WebkitTransition : 'all .3s ease',
    MozTransition : 'all .3s ease',
    MsTransition : 'all .3s ease',
    OTransition : 'all .3s ease',
    Transition : 'all .3s ease'
});

$('.arrow_price_slider_holder').css({
    WebkitTransition : 'all .3s ease',
    MozTransition : 'all .3s ease',
    MsTransition : 'all .3s ease',
    OTransition : 'all .3s ease',
    Transition : 'all .3s ease'
});


// $('#flight-one').click(function() {
//     $(this).css({
//         'position' : 'relative'
//     });

//     $('#date-return').parent().parent().css({
//         'opacity' : 0,
//         'pointer-events' : 'none'
//     });

//     $('#date-departure').parent().parent().css({
//         'top': 50,
//         'position' : 'relative'
//     });
// });
  
// $('#flight-two').click(function() {
//     $('#flight-one').css({
//         'position': 'relative'
//     });
//     $('#date-return').parent().parent().css({
//         'opacity' : 1,
//         'pointer-events' : 'inherit'
//     });
//     $('#date-departure').parent().parent().css({
//         'top': 0,
//         'position' : 'inherit'
//     });
// });

//FILTER 
$('.filter_holder .filter_btn').click(function(){
    var target = $(this).attr('data-target');
    var col = $(this).parents('.col-root');
    if(col.find(target).css('display') == 'none'){
        col.find('.filter_section').hide();
        col.find(target).fadeIn(300);
    }else{
        col.find('.filter_section').slideUp(300);
    }
});

$('.detail-total-price').hide();
$('#form-return').css('opacity','0.4');
$('#form-return').css('pointer-events','none');
$('.form-preview').hide();

var validTime = 620;
$('.timer').attr('data-seconds-left', validTime);
$('.timer').startTimer({
    onComplete: function() {
        swal({
            title: "Your Search was expired!",
            text: "Please make new search or refresh the page",
            type: "error",
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonText: "Refresh",
            cancelButtonText: "Change Search"
        }).then(function() {
            location.reload();
        }, function(dismiss) {
            if(dismiss === 'cancel') {
                $('#modal_change_flight').modal('show');
            } else {
                location.reload();
            }
        });
    }
});
    
$('#modal_change_flight').on("shown.bs.modal", function() {
    $('.group-checkbox').eq(0).width($('.group-checkbox').eq(1).width());
    $('.img-flight').css({
      "margin" : "0 auto"
    });
});