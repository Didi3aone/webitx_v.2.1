var getUrl99 = window.location;
var baseUrl99 = getUrl99.protocol + "//" + getUrl99.host + "/" + getUrl99.pathname.split('/')[1];

$(function() {
  function badgenotif(){
    $.ajax({
      type: "POST",
      url: baseUrl99+"/_notif.php",
      dataType:'json',
      success: function(response){
       //console.log('totalNotif',response);
       if (typeof response.flight != 'undefined') {
         if (parseInt(response.flight) >0) {
          $("#jumlah").html(response.flight);
        }
        else {
          $("#jumlah").empty();
        }
         $("#jumlahtxt").html('You Have '+response.flight+' New Notifications');
        
        if (parseInt(response.career) >0) {
          $("#jumlah-career").html(response.career);
        }
        else {
          $("#jumlah-career").empty();
        }
         $("#jumlahtxt-career").html('You Have '+response.career+' New Career Apply');
         
         if (parseInt(response.other) >0) {
          $("#jumlah-inquiry").html(response.other);
        }
        else {
          $("#jumlah-inquiry").empty();
        }
         $("#jumlahtxt-inquiry").html('You Have '+response.other+' New Inquiry');
        }
       
       timer = setTimeout(badgenotif,5000);
      }
    });  
  }
      var limit=3;
      badgenotif();
        $('#getComment').click(function() {
          $("#notifi").empty();
          $.ajax({
              type:"POST",
              url:baseUrl99+"/_getnotif.php",
              dataType:'json',
              success: function(response){
                for(var i=0; i<response.length; i++){
                  if (i>limit) {
                    break;
                  }
                  if(response[i].type==1){
                    var notifikasi = 'Flight Reservation';
                    var imgnotif = 'bookreservation.png';
                  }
                  else if(response[i].type == 2){
                    var notifikasi = 'Payment Confirmation';
                    var imgnotif = 'paymentconfirm.png';
                  }
                  var href = baseUrl99+'/plugins/transaction/detail_transaction.php?id='+response[i].id;
                  
                  var html = '<li class="new">'+
                                '<a href="'+href+'">'+
                                '<span class="desc ml_0">'+
                                  '<span class="name">'+response[i].firstname+' '+response[i].lastname+'<span class="badge badge-success">new</span></span>'+
                                  '<span class="msg">'+notifikasi+'</span>'+
                                '</span>'+
                                '</a>'+
                              '</li>';
                  $("#notifi").append(html);
                  // $("#notifi").trigger("change");
                }
                
               $("#notifi").append('<li class="new"><a href="'+baseUrl99+'/plugins/transaction/main_transaction.php">See All Transactions</a></li>');
              },
              error: function(errResp) {
                console.log('error load transaction');
              }
            });
        });
        
        $('#getInquiry').click(function() {
          $("#notifi-inquiry").empty();
          $.ajax({
              type:"POST",
              url:baseUrl99+"/_getnotif2.php",
              dataType:'json',
              success: function(response){
                for(var i=0; i<response.length; i++){
                  if (i>limit) {
                    break;
                  }
                  
                  var href = baseUrl99+'/edit_message.php?id='+response[i].id;
                  
                  var html = '<li class="new">'+
                                '<a href="'+href+'">'+
                                '<span class="desc ml_0">'+
                                  '<span class="name">'+response[i].firstname+' '+response[i].lastname+'<span class="badge badge-success">new</span></span>'+
                                  '<span class="msg">'+response[i].subject+'</span>'+
                                '</span>'+
                                '</a>'+
                              '</li>';
                  $("#notifi-inquiry").append(html);
                }
                
               $("#notifi-inquiry").append('<li class="new"><a href="'+baseUrl99+'/main_message.php">See All Inquiry (Umroh/Tour)</a></li>');
              },
              error: function(errResp) {
                console.log('error load inquiry');
              }
            });
        });
        
        $('#getCareer').click(function() {
          $("#notifi-career").empty();
          $.ajax({
              type:"POST",
              url:baseUrl99+"/_getnotif3.php",
              dataType:'json',
              success: function(response){
                for(var i=0; i<response.length; i++){
                  if (i>limit) {
                    break;
                  }
                  
                  var href = baseUrl99+'/plugins/career_apply/detail_career.php?id='+response[i].id;
                  
                  var html = '<li class="new">'+
                                '<a href="'+href+'">'+
                                '<span class="desc ml_0">'+
                                  '<span class="name">'+response[i].firstname+' '+response[i].lastname+'<span class="badge badge-success">new</span></span>'+
                                  '<span class="msg">'+response[i].job+'</span>'+
                                '</span>'+
                                '</a>'+
                              '</li>';
                  $("#notifi-career").append(html);
                }
                
               $("#notifi-career").append('<li class="new"><a href="'+baseUrl99+'/main_career_details.php">See All Career Apply</a></li>');
              },
              error: function(errResp) {
                console.log('error load inquiry');
              }
            });
        });
        
        $('#downloadcv').click(function() {
            var cvfile = $('#cvfile').val();
            $.ajax({
               type: "POST",
               url:baseUrl99+"/_downloadcv.php",
               data:{filename:'call_this'},
               success:function() {
                 window.location = baseUrl99+"/_downloadcv.php?filename="+cvfile;
               }
            });
        });
});
