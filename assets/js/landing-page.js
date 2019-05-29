(function () {
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

  $('#header_close_icon').click(function(){
     $('.header-search input').val('');
  });

  // $('#flight-one').click(function() {
  //   $(this).css({
  //     'position' : 'relative'
  //   });

  //   $('#date-return').parent().parent().css({
  //     'opacity' : 0,
  //     'pointer-events' : 'none'
  //   });

  //   $('#date-departure').parent().parent().css({
  //     'top': 50,
  //     'position' : 'relative'
  //   });
  // });

  $('#flight-two').click(function() {
    $('#date-return').parent().parent().css({
      'opacity' : 1,
      'pointer-events' : 'inherit'
    });

    $('#date-departure').parent().parent().css({
      'top': 0,
      'position' : 'inherit'
    });
  });

  $('.select2').select2({
    selectOnClose: true
  });


  function switchMonthToString(monthDeparture) {
    switch(monthDeparture){
      case "01":
        monthDeparture = "January";
        break;
      case "02":
        monthDeparture = "February";
        break;
      case "03":
        monthDeparture = "March";
        break;
      case "04":
        monthDeparture = "April";
        break;
      case "05":
        monthDeparture = "May";
        break;
      case "06":
        monthDeparture = "June";
        break;
      case "07":
        monthDeparture = "July";
        break;
      case "08":
        monthDeparture = "August";
        break;
      case "09":
        monthDeparture = "September";
        break;
      case "10":
        monthDeparture = "October";
        break;
      case "11":
        monthDeparture = "November";
        break;
      case "12":
        monthDeparture = "December";
        break;
    }
    return monthDeparture;
  }

})();