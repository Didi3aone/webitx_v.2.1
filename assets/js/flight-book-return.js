$('#time_filter_template').hide();

$(document).ready(function() {
   var returnDateText = $('#col-return .currentDay').text().split(",");
   var returnDate = returnDateText[1];
   var returnDayText = returnDate.split(" ");
   var returnDay = returnDayText[1];
   
   var departureDateText = $('#col-depart .currentDay').text().split(",");
   var departureDate = departureDateText[1];
   var departureDayText = departureDate.split(" ");
   var departureDay = departureDayText[1];
   
   $('#col-depart').find('.per_date_holder input.date').each(function() {
      if($(this).val() > returnDay) {
          $(this).parent().css('cursor', 'not-allowed');
          $(this).parent().unbind("click");
          $(this).parent().click(function() {
             swal(
              'Error!',
              'You choose a higher departure date than the return date, please choose another date!',
              'error'
            );
          });
      }
   });
   
   $('#col-return').find('.per_date_holder input.date').each(function() {
      if($(this).val() < departureDay)  {
          $(this).parent().css('cursor', 'not-allowed');
          $(this).parent().unbind("click");
          $(this).parent().click(function() {
            swal(
                'Error!',
                'You choose a lower return date than the departure date, please choose another date!',
                'error'
            ) 
          });
      }
   });
   
   function filterDateReturn() {
    if(departureDay == returnDay) {
       let departureHour, departureMinute, returnHour, returnMinute, returnTime, returnTimeText;
       
      $(document).on("click", "#col-depart .btn_select", function() {
        departureTime = $(this).parent().parent().parent().parent().parent().find('.arrived_time').text();
        departureTimeText = departureTime.split(":");
        departureHour = parseInt(departureTimeText[0]) * 60 + 60;
        departureMinute = parseInt(departureTimeText[1]);
        departureSecond = departureHour + departureMinute;
        
        $('#col-return .per_flight_inner_holder').each(function() {
           returnTime = $(this).find('.depart_time').text();
           returnTimeText = returnTime.split(":");
           returnHour = parseInt(returnTimeText[0]) * 60;
           returnMinute = parseInt(returnTimeText[1]);
           returnSecond = returnHour + returnMinute;
           
           console.log(departureSecond, returnSecond);
           
           if(returnSecond < departureSecond) {
               $(this).addClass("hidden");
           }
        });
      });
    }   
   }
   
   filterDateReturn();
   
   $('#btn_change_flight_holder .btn_change_flight_holder button').click(function() {
       $('#col-return .per_flight_inner_holder').removeClass('hidden');
   });
});