function getTicketsDepart(col){
    
    var slider = col.find('.calendar_slider');
    searchDepart(col,dateDepart,monthDepart,yearDepart);
    
    var is_international = $('#is_international').val();
    
    var params = { "todo": "fa", "data":
        {
          "Routes": [
              {
                  "Origin": $('#inp_to').val(),
                  "Destination": $('#inp_dest').val(),
                  "DepartDate": $('#inp_depart').val()
              }
          ],
          "Adult": parseInt($('#inp_adult').val()),
          "Child": parseInt($('#inp_child').val()),
          "Infant": parseInt($('#inp_infant').val()),
          "FareType": "LowestFare",
          "PreferredAirlines": [2]
        }
    };
    
    var params2 = { "todo": "fa", "data":
        {
          "Routes": [
              {
                  "Origin": $('#inp_to').val(),
                  "Destination": $('#inp_dest').val(),
                  "DepartDate": $('#inp_depart').val()
              }
          ],
          "Adult": parseInt($('#inp_adult').val()),
          "Child": parseInt($('#inp_child').val()),
          "Infant": parseInt($('#inp_infant').val()),
          "FareType": "LowestFare",
          "PreferredAirlines": [2]
        }
    };
    //console.log(JSON.stringify(params));
    
    if (is_international == '1') {
      var percent_complete = 95;
      var searchflight = [
        {"fid":2,"status":false},
        {"fid":3,"status":false},
        {"fid":4,"status":false},{"fid":5,"status":false},
        {"fid":6,"status":false},{"fid":7,"status":false},
        {"fid":8,"status":false},{"fid":11,"status":false}
      ];
    }
    else {
      var percent_complete = 83;
      var searchflight = [
        {"fid":2,"status":false},
        {"fid":3,"status":false},
        {"fid":4,"status":false},{"fid":5,"status":false},
        {"fid":7,"status":false},
        {"fid":8,"status":false},{"fid":11,"status":false}
      ];
    }
    
    var percent = 2;
    col.find('.loading_ticket .percent').html(percent + '%');
    
    var now = new Date();
    var ddnow = now.getDate();
    var mmnow = now.getMonth() + 1;
      
    var dayDate = parseInt(dateDepart);
    var datesToShowed = getDatesShowed(dateDepart,monthDepart,yearDepart);//List of dates that showed on slider
    
    var validDateToShow = [];
    for (var n=0;n<datesToShowed.length;n++) {
      if (mmnow == monthDepart) {
        if (datesToShowed[n] >= ddnow) {
          validDateToShow.push(datesToShowed[n]);
        }
      }
      else {
        validDateToShow.push(datesToShowed[n]);
      }
    }
    alldaycount += validDateToShow.length ;
    

    // main search
    for (var i=0;i<searchflight.length;i++) {
      params.data.PreferredAirlines = [searchflight[i].fid] ;
      $.ajax({
        type: "POST",
        url: 'fa.php',
        data: params,
        success: function(resp){
          //console.log(resp);
          if (resp.status === true) {
            if (_.isArray(resp.data) && resp.data[0]) {
              if (resp.data[0].Flights.length > 0) {
                flights = flights.concat(resp.data[0].Flights);
                flights = _.sortBy(flights, ['Fare']);
                insertPrice(dayDate,flights[0].Fare);
                updateGraphic(slider);
                col.find('.detail_day').empty();
                //console.log(resp.data[0].Flights[0]);
                for (var i=0;i<flights.length;i++) {
                  insertTicket(col,flights[i]);
                }
              }
            }
          }
          percent += 12 ;
          col.find('.loading_ticket .percent').html(percent + '%');
        },
        error: function(errResp) {
          percent += 12 ;
          col.find('.loading_ticket .percent').html(percent + '%');
          //console.log('error progress ' + percent);
        },
        dataType: 'json'
      });
    }
      
    for (var n=0;n<validDateToShow.length;n++) {
      if (validDateToShow[n] == dayDate) {
        //console.log('SKIPP ' +validDateToShow[n]);
        continue;
      }
      var searchdate = yearDepart+'-'+monthDepart+'-'+validDateToShow[n];
      flights_tmp.push({daterequest: searchdate, data: []});
      params2.data.Routes[0].DepartDate = searchdate ;
      for (var i=0;i<searchflight.length;i++) {
        params2.data.PreferredAirlines = [searchflight[i].fid] ;
        $.ajax({
          type: "POST",
          url: 'fa.php',
          data: params2,
          success: function(resp){
            //console.log(resp);
            if (resp.status === true) {
              if (_.isArray(resp.data) && resp.data[0]) {
                if (resp.data[0].Flights.length > 0) {
                  var idxtmp = _.findIndex(flights_tmp, {daterequest: resp.data[0].DateRequest})
                  if (idxtmp !== -1) {
                    var dateParts = resp.data[0].DateRequest.split('-');
                    var dayResponse = dateParts[2];
                    
                    flights_tmp[idxtmp].data = flights_tmp[idxtmp].data.concat(resp.data[0].Flights);
                    flights_tmp[idxtmp].data = _.sortBy(flights_tmp[idxtmp].data, ['Fare']);
                    insertPrice(dayResponse,flights_tmp[idxtmp].data[0].Fare);
                    updateGraphic(slider); 
                  }
                }
              }
            }
          },
          error: function(errResp) {
            // error
          },
          dataType: 'json'
        });
      }
    }
  
     var checkProgress = setInterval(function() {
        if(isDepartSubmit == true){
          col.find('.loading_ticket').hide();
        }else{
          col.find('.loading_ticket').show();
        }
        if (percent >= percent_complete) {
          col.find('.loading_ticket').hide();
          col.find('.filter_holder').show();
           //To Show Depart Graph
          if(flights.length>0) {
            maxPDefault = parseInt(flights[(flights.length)-1].Fare);
            filterPriceDepart(flights[0].Fare,flights[(flights.length)-1].Fare);
          }
          var transitCity = [];
          var listTransit = [];
          //console.log(JSON.stringify(flights));
          if (flights.length>0) {
            insertFilterTransferDepart('Direct',0,0);
          }
          //console.log(JSON.stringify(flights));
          for (var i=0;i<flights.length;i++) {
            var jmltransit = parseInt(flights[i].TotalTransit);
            if (jmltransit>0) {
              var idxT = listTransit.indexOf(jmltransit);
              if (idxT === -1) {
                listTransit.push(jmltransit);
              }
            }
            if (_.isArray(flights[i].TransitCity) && flights[i].TransitCity.length>0) {
              for (var j=0;j<flights[i].TransitCity.length;j++) {
                var idxT = transitCity.indexOf(flights[i].TransitCity[j]);
                if (idxT === -1) {
                  transitCity.push(flights[i].TransitCity[j]);
                }
              }
            }
            
            var idxT = _.findIndex(flightsToShow, {air_name: flights[i].AirlineName});
            if (idxT === -1) {
              flightsToShow.push({air_name: flights[i].AirlineName, air_logo: flights[i].AirlineImageUrl});
            }
            //insertTicket(col,flights[i]);  // sudah ada di atas, tp nek error di re add ulang
          }
          if (listTransit.length>0) {
            listTransit.sort();
            for (var i=0;i<listTransit.length;i++) {
              insertFilterTransferDepart(listTransit[i]+' Transit',0,listTransit[i]);
            }
            //insertFilterTransferDepart('Transfer without overnight',0,999);
            
          }
          if (transitCity.length>0) {
            transitCity.sort();
            for (var i=0;i<transitCity.length;i++) {
              insertFilterTransferDepart(transitCity[i],1,transitCity[i]);
            }
          }
          if (flightsToShow.length>0) {
            for (var i=0;i<flightsToShow.length;i++) {
              insertFilterAirlines(flightsToShow[i].air_name,flightsToShow[i].air_logo);
            }
          }
          //console.log(listTransit);
          //console.log(transitCity);
          //console.log(flightsToShow);
          
          currentLowestPrice = flights[0].Fare;
          var heightx = currentLowestPrice / maxPriceSlider * 100;
          //col.find('.arrow_price_slider_holder').css('display','block');
          col.find('.arrow_price_slider_holder').find('span.money').html(currentLowestPrice);
          col.find('.arrow_price_slider_holder').css('margin-top', -196 + 100 - heightx);

          clearInterval(checkProgress);
        }
      }, 1000);
  }


function insertTicket(col,flights,transit){
  //col : return atau depart
  //json Object : json yg isinya data ticket
  //transit : 1 = 1 x penermbangan sekali jalan, no tranist
  //transit : 2 = 2 x penerbangan, 1 x transit
  //transit : 3 = 3 x penerbangan, 2 x transit
  //transit : 4 = 4 x penerbangan, 4 x transit

  var ticketId = flights.FlightId;
  var ticketHtml = $('#ticketTemplate');
  
  //console.log('tiket-id ' + ticketId);
  //HEADER TICKET
  var airline = flights.AirlineName; // set with lowercase, also used for image find location
  //var logoAirline = flights.AirlineName.toLowerCase();
  var logoAirline = flights.AirlineImageUrl;
  
  var price = flights.Fare;
  var departTime = flights.DepartTime;
  var departCity = flights.OriginCity + ' ('+flights.Origin+')';
  var arrivedTime = flights.ArriveTime;
  var arrivedCity = flights.DestinationCity + ' ('+flights.Destination+')';
  var bookCode = flights.Duration;
  var person = parseInt(flights.TotalTransit);

  //ITINERARY DETAIL
  if (flights.ConnectingFlights.length > 0) {
    var flights1 = flights.ConnectingFlights[0] ;
    var airline1 = flights1.AirlineName + ' ' + flights1.Number;
    //var logoAirline1 = flights1.AirlineName.toLowerCase();
    var logoAirline1 = flights1.AirlineImageUrl;
    
    var departTime1 = flights1.DepartTime;
    var departDate1 = flights1.DepartDateView;
    var departCity1 = flights1.OriginCity + ' ('+flights1.Origin+')';
    var departAirport1 = flights1.OriginAirport;

    var arrivedTime1 = flights1.ArriveTime;
    var arrivedDate1  = flights1.ArriveDateView;
    var arrivedCity1 = flights1.DestinationCity + ' ('+flights1.Destination+')';
    var arrivedAirport1 = flights1.DestinationAirport;
  }
  else {
    var airline1 = flights.AirlineName + ' ' + flights.Number;
    //var logoAirline1 = flights.AirlineName.toLowerCase();
    var logoAirline1 = flights.AirlineImageUrl;
    var departTime1 = flights.DepartTime;
    var departDate1 = flights.DepartDateView;
    var departCity1 = flights.OriginCity + ' ('+flights.Origin+')';
    var departAirport1 = flights.OriginAirport;

    var arrivedTime1 = flights.ArriveTime;
    var arrivedDate1  = flights.ArriveDateView;
    var arrivedCity1 = flights.DestinationCity + ' ('+flights.Destination+')';
    var arrivedAirport1 = flights.DestinationAirport;
  }
  

  var baggage1 = '20kg';
  var meal1 = 1; // 0 = No Meal, 1 = Meal

  //HTML REPLACE
  ticketHtml.find('.ticketIdHidden').attr('value', ticketId);
  
  ticketHtml.find('.maskapai').html(airline);
  ticketHtml.find('.money').html(numberFormat(price));
  ticketHtml.find('.depart_time').html(departTime);
  ticketHtml.find('.depart_city').html(departCity);
  ticketHtml.find('.arrived_time').html(arrivedTime);
  ticketHtml.find('.arrived_city').html(arrivedCity);
  ticketHtml.find('.book_code').html((person ? person + ' TRANSIT' : 'DIRECT' ));
  ticketHtml.find('.person').html('('+bookCode+')');
  ticketHtml.find('.logo-maskapai').attr('src',logoAirline)
  ticketHtml.find('.logo-maskapai').css('max-width','72px');

  //ITINERARY DETAIL
  ticketHtml.find('.airline1').html(airline1);
  ticketHtml.find('.logo-airline1').attr('src',logoAirline1)
  ticketHtml.find('.logo-airline1').css('max-width','72px');
  ticketHtml.find('.depart_time1').html(departTime1);
  ticketHtml.find('.depart_date1').html(departDate1);
  ticketHtml.find('.depart_city1').html(departCity1);
  ticketHtml.find('.depart_airport1').html(departAirport1);

  ticketHtml.find('.arrived_time1').html(arrivedTime1);
  ticketHtml.find('.arrived_date1').html(arrivedDate1);
  ticketHtml.find('.arrived_city1').html(arrivedCity1);
  ticketHtml.find('.arrived_airport1').html(arrivedAirport1);

  ticketHtml.find('.baggage1').html(baggage1);
  if(meal1 == 1){ 
    ticketHtml.find('.meal1').show();
  }else{ // if no meal
    ticketHtml.find('.meal1').hide();
  }
  
  
  if (flights.ConnectingFlights.length > 1) {
    for (var i=1;i<flights.ConnectingFlights.length;i++) {
      insertTransit(ticketHtml, flights.ConnectingFlights[i]);
    }
  }

  if(col.attr('id') == "col-depart"){
    if(isDepartSubmit == true){
      ticketHtml.find('.ticket-packet').css("display","none");
    }
  }

  
  col.find('.detail_day').append(ticketHtml.html());
  ticketHtml.find('.transit-holder').remove();
}

function insertTransit(template,flights){

  var transitHtml = $('#ticket-transit-template');
  
  var airline2 = flights.AirlineName + ' ' + flights.Number;
  //var logoAirline2 = flights.AirlineName.toLowerCase();
  var logoAirline2 = flights.AirlineImageUrl;
  var departTime2 = flights.DepartTime;
  var departDate2 = flights.DepartDateView;
  var departCity2 = flights.OriginCity + ' ('+flights.Origin+')';
  var departAirport2 = flights.OriginAirport;

  var arrivedTime2 = flights.ArriveTime;
  var arrivedDate2  = flights.ArriveDateView;
  var arrivedCity2 = flights.DestinationCity + ' ('+flights.Destination+')';
  var arrivedAirport2 = flights.DestinationAirport;
    
  var transitLong = flights.DurationTransit;
  var transitAirport = flights.OriginAirport;

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

}