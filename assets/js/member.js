$(document).ready(function() {

  $('.money').each(function() {
    /*this is the main function on masking money element*/
    var newVal = $(this).html().toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    /**/
    var moneyVal = $(this).html();
    $(this).attr("value", moneyVal);
    $(this).html(newVal);
  });
  
  $('.load_more_dots').hide();

  $('.loading_button_holder').click(function() {
    $('.loading_button_holder').find('img').hide();
    function animate() {
      $('.loading_button_holder').find('img').fadeIn(1200).delay(500).fadeOut(1200);
      $('.load_more_dots').eq(2).fadeIn(400).delay(400).fadeOut(800);
      $('.load_more_dots').eq(1).fadeIn(500).delay(300).fadeOut(800);
      $('.load_more_dots').eq(0).fadeIn(600).delay(200).fadeOut(800);
      animate();
    }
    animate();
  });

  /*$('.per_row_holder.unread').click(function() {
    $(this).removeClass('unread');
  });*/

  //$('.per_row_holder').click(function() {
    //$(this).toggleClass('unread');
  //});

  $('.btn_edit_info').click(function() {
    //choose which form will be show
    $('.form_holder form').hide();
    var form_id = $(this).parent().parent().find('h3').attr("id");
    $('.form_holder #edit_' + form_id).show();

    $('body').css({
      WebkitTransition  : 'all 0.4s ease',
      MozTransition   : 'all 0.4s ease',
      MsTransition    : 'all 0.4s ease',
      OTransition     : 'all 0.4s ease',
      Transition      : 'all 0.4s ease'
    });

    $('.right_menu').css({
      'right': '0',
      'top': '0',
      'position' : 'fixed',
    });
  });

  $('.btn_payment_holder').click(function() {
    var bank = $(this).parent().find('.bank_holder');
    var plus_minus = $(this).find('.plus_minus_holder span');
    if($(bank).is(":visible")) {
      bank.slideUp(500);
      plus_minus.text("+");
    } else {
      bank.slideDown(500);
      plus_minus.text("-");
    }
  });

  $('.btn_eye_holder').click(function() {
    var this_password = $(this).parent().find('input');
    if($(this_password).attr("type") == "password") {
      $(this_password).attr("type", "text");
    } else if($(this_password).attr("type") == "text") {
      $(this_password).attr("type", "password");
    }
  });

  $('.btn_cancel_side').click(function() {
    $('body').css({
      'margin-left' : '0'
    });
    $('.right_menu').css({
      'right': '-100%'
    });
    $(this).css('position', 'absolute')
  });

  if($(window).width() <= 767) {

    $('.btn_edit_info').click(function() {
      
      $('body').css({
        'width'       : '100%',
        'margin-left'   : '-90%'
      });
      $('.btn_cancel_side').css('position', 'fixed');

    });

  } else if($(window).width() >= 768 && $(window).width() <= 991) {

    $('.btn_edit_info').click(function() {
      
      $('body').css({
        'width'       : '100%',
        'margin-left'   : '-50%'
      });
      $('.btn_cancel_side').css('position', 'fixed');

    });

  } else if ($(window).width() >= 992 ) {

    $('.btn_edit_info').click(function() {
      
      $('body').css({
        'width'       : '100%',
        'margin-left'   : '-430px'
      });

      $('.right_menu').css({
        'right': '0',
        'top': '0',
        'position' : 'fixed'
      });
      $('.btn_cancel_side').css('position', 'fixed');

    });
  }


  /*THIS IS WHERE I GET DATA FROM "SIDE FORM", THIS DATA IS FOR UPDATE USER'S OLD DATA*/
  //$('.btn_done').click(function() {
    //var form_id = $(this).parent().parent().parent().attr("id");

    //if(form_id == "edit_method") {
      //var new_method_data = {
        //name : $('#name_form_method').val(),
        //cardNumber : $('#cardNumber_form_method').val(),
        //date_expired : $('#input_date_form_method').val(),
        //month_expired : $('#input_month_form_method').val(),
        //year_expired : $('#input_year_form_method').val(),
        //cvv : $('#cvv_form_method').val(),
        //bank : $("#choose_bank_form_method").val(),
        //duration : $("#choose_duration_form_method").val()
      //};
    //} else if(form_id == "edit_profile") {
      //var new_profile_data = {
        //name : $('#name_form_profile').val(),
        //password : $('#password_form_profile').val(),
        //newPassword : $('#newPassword_form_profile').val(),
        //email : $('#email_form_profile').val(),
        //mobileNumber : $('#mobile_form_profile').val(),
        //street : $('#street_form_profile').val(),
        //province : $('#province_form_profile').val(),
        //city : $('#city_form_profile').val(),
        //postalCode : $('#postalCode_form_profile').val()
      //};
    //}

    //$('body').css({
      //'margin-left' : '0'
    //});
    //$('.right_menu').css({
      //'right': '-100%'
    //});
  //});
});
