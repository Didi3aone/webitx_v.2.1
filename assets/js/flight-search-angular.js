var app = angular.module('App', ['ngCookies', 'ngRoute']);

app.run(function run( $http, $cookies ){
  $http.defaults.headers.common["X-CSRF-TOKEN"] = $cookies.get('5f05193eee9e900380c12e6040e7dee9');
});

app.service('FlightSearch', function() {
  this.SuccessResponse = function()
    {
        swal({
            title: "Succes",
            text: "",
            type:"success",
            allowOutsideClick: false,
            confirmButtonText: "OK"
        }).then(function() {
            window.location.reload();
        }, function(dismiss) {
            window.location.reload();
        });
    },

  this.ErrorResponse = function(message)
  {
      swal({
          title: "Failed",
          text: message,
          type:"error",
          allowOutsideClick: false,
          confirmButtonText: "OK"
      });
  },
  
  // start loading page
  this.startLoadingPage = function (text) {
    $('.page_preloader').find('p').text(text);
    $('.page_preloader').show();
    $('body, html').css({
        'overflow' : 'hidden',
        'max-width' : '100%',
        'max-height' : '100%'
    });
  },

  // stop loading page
  this.stopLoadingPage = function()
  {
    $('.page_preloader').fadeOut(800);
    $('body, html').css({
        'overflow' : 'auto',
        'max-width' : 'none',
        'max-height' : 'none'
    });
    return false;
  },

	// calculate different times in minutes
	this.diff_minutes = function (dt2, dt1) 
  {
      var diff =(dt2.getTime() - dt1.getTime()) / 1000;
      diff /= 60;
      return Math.abs(Math.round(diff));
  },

	// show total price on slider
	this.showDetailPrice = function(){
      $('.detail-total-price').show();
      $('html, body').animate({
        scrollTop: $(document).height()
      }, 1500);
      return false;
  },

	// get length of days in month
	this.daysInMonth = function (month,year) {
    return new Date(year, month, 0).getDate();
  },

    // convert int month to string
	this.convertMonthToString = function(number){
      switch(number){
        case 1:
          return 'January'
          break;
        case 2:
          return 'February'
          break;
        case 3:
          return 'March'
          break;
        case 4:
          return 'April'
          break;
        case 5:
          return 'May'
          break;
        case 6:
          return 'June'
          break;
        case 7:
          return 'July'
          break;
        case 8:
          return 'August'
          break;
        case 9:
          return 'September'
          break;
        case 10:
          return 'October'
          break;
        case 11:
          return 'November'
          break;
        case 12:
          return 'December'
          break;
      }      
    },

    this.convertMonthToString2 = function(number){
      switch(number){
        case 'January':
          return '01'
          break;
        case 'February':
          return '02'
          break;
        case 'March':
          return '03'
          break;
        case 'April':
          return '04'
          break;
        case 'May':
          return '05'
          break;
        case 'June':
          return '06'
          break;
        case 'July':
          return '07'
          break;
        case 'August':
          return '08'
          break;
        case 'September':
          return '09'
          break;
        case 'October':
          return '10'
          break;
        case 'November':
          return '11'
          break;
        case 'December':
          return '12'
          break;
      }      
    },

    // convert int day to string
	this.convertDayToString = function(number){
      switch(number){
        case 0 :
        return 'Sun';
        break;
      case 1 :
        return 'Mon';
        break;
      case 2 :
        return 'Tue';
        break;
      case 3 :
        return 'Wed';
        break;
      case 4 :
        return 'Thu';
        break;
      case 5 :
        return 'Fri';
        break;
      case 6 :
        return 'Sat';
        break;
      }
    },

	this.numberFormat = function (nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    },

    this.numberFormatClean = function (nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1;
    },

	// reset search
    this.resetSearch = function () {
        // alert('berhasil')
    },

    // calculate total money (fare) on slider
    this.maskMoney = function () {
    	$('.money').each(function() {
          var newVal = $(this).html().toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
          $(this).html(newVal);
        });
    },

    this.toTitleCase = function(str) {
        return str.replace(
            /\w\S*/g,
            function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
    },

    // insert flight transit 
    this.insertTransit = function (template,flights){
        var transitHtml = $('#ticket-transit-template');
        var airline2 = flights.AirlineName + ' ' + flights.Number;
        //var logoAirline2 = flights.AirlineName.toLowerCase();
        var logoAirline2 = flights.AirlineImageUrl;
        var departTime2 = flights.DepartTime;
        var departDate2 = flights.DepartDateView;
        // var departCity2 = flights.OriginCity + ' ('+flights.Origin+')';
        var departCity2 = flights.AirportDepart.CityName + ' ('+flights.Origin+')';
        // var departAirport2 = flights.OriginAirport;
        var departAirport2 = flights.AirportDepart.AirportName;

        var arrivedTime2 = flights.ArriveTime;
        var arrivedDate2  = flights.ArriveDateView;
        // var arrivedCity2 = flights.DestinationCity + ' ('+flights.Destination+')';
        var arrivedCity2 = flights.AirportReturn.CityName + ' ('+flights.Destination+')';
        // var arrivedAirport2 = flights.DestinationAirport;
        var arrivedAirport2 = flights.AirportReturn.AirportName;

        var transitLong = flights.TransitDuration;
        var transitAirport = flights.AirportDepart.AirportName;

        var baggage2 = '20kgs';
        var meal2 = 1; // 0 = No Meal, 1 = Meal

        transitHtml.find('.transit_time').show();
        transitHtml.find('.transit_long').html(transitLong);
        transitHtml.find('.transit_airport').html(transitAirport);

        transitHtml.find('.airline2').html(airline2);
        transitHtml.find('.logo-airline2').attr('src',logoAirline2);
        transitHtml.find('.logo-airline2').css('max-width','72px');
        transitHtml.find('.depart_time2').html(departTime2);
        transitHtml.find('.depart_date2').html(departDate2);
        transitHtml.find('.depart_city2').html(departCity2);
        transitHtml.find('.depart_airport2').html(departAirport2);

        transitHtml.find('.arrived_time2').html(arrivedTime2);
        transitHtml.find('.arrived_date2').html(arrivedDate2);
        transitHtml.find('.arrived_city2').html(arrivedCity2);
        transitHtml.find('.arrived_airport2').html(arrivedAirport2);

        transitHtml.find('.baggage2').html(baggage2);

        if(meal2 == 1){ 
            transitHtml.find('.meal2').show();
        }else{ // if no meal
            transitHtml.find('.meal2').hide();
        }
        template.find('.itinerary-body').append(transitHtml.html());
    },

    //To Reset ticket
    this.resetTicket = function (col){
      col.find('.detail_day').html('');
    }

    // Search Duration Flight
    this.FlightDuration = function(DepartDate, DepartTime, ArriveTime)
    {
      var dateDepartureSplit = DepartDate.split("-");
      var dayDeparture = dateDepartureSplit[2];
      var monthDeparture = dateDepartureSplit[1];
      var yearDeparture = dateDepartureSplit[0];

      var dt1 = new Date(monthDeparture+" "+dayDeparture+", "+yearDeparture+" "+DepartTime);
      var dt2 = new Date(monthDeparture+" "+dayDeparture+", "+yearDeparture+" "+ArriveTime);
      var diff =(dt2.getTime() - dt1.getTime()) / 1000;
      var diff_minute = Math.abs(Math.round(diff/60));

      var hour = parseInt(diff_minute / 60);
      var minute = diff_minute % 60;
      return hour+"h, "+minute+"m";
    }

});




// function resetSearch() {
//       var priceToSearchDepart = 0;
//       transferTotalToSearch = [];
//       transferCityToSearch = [];
//       airlineToSearch = [];
//       var timeToSearchDepart = [];
//       var priceToSearchReturn = 0;
//       transferTotalToSearch2 = [];
//       transferCityToSearch2 = [];
//       airlineToSearch2 = [];
//       var timeToSearchReturn = [];
//     }