$('#dtp_input2').attr("value", $('#dtp_input1').attr("value"));
var dateDeparture = $('#date-departure').val();
$('#date-return').parent().datetimepicker({
  startDate: "'" + dateDeparture + "'",
  weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        numberOfMonths: 2,
        startView: 2,
        minView: 2
});

$('.select2').select2({
  selectOnClose: true
});

//fungsi untuk switch destinasi di kolom pertama paling kiri
$('#switch-destination').click(function(){
   var fromCity= $('#from').val();
   var toCity= $('#to').val();
   $('#to').val(fromCity).trigger('change');
   $('#from').val(toCity).trigger('change');
});

//fungsi untuk mengganti radio button one way or two way
$('.img-flight').click(function(){
  $('.img-flight').attr('src','assets/images/checkbox-off.png');
  if($(this).attr('id') == 'flight-one'){
    $('#date-return').prop( "disabled", true );
    $('#flight-type').val('1');
    $("#frmSearchFlight").attr('action', 'flight-book.php');
  }else{
    $('#date-return').prop( "disabled", false );
    $('#flight-type').val('2');
    $("#frmSearchFlight").attr('action', 'flight-book-two.php');
  }
  $(this).attr('src','assets/images/checkbox-on.png');

});


//Bootstrap datetime picker
 //Bootstrap datetime picker
    //deklarasi pertama untuk menggunakan jquery datetimepicker
    $('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        numberOfMonths: 2,
        startView: 2,
        minView: 2,
        forceParse: 0,
        startDate: new Date()
    });

    //membuat tanggal pemberangkatan tidak lebih dari tanggal pemulangan
    //mengatur tanggal pemberangkatan
    $('#date-departure').on("change", function() {
      //mengambil value saat user memilih tanggal
      dateDeparture = $(this).val();
      //memecah value menjadi per hari, bulan, dan tahun
      dateDepartureSplit = dateDeparture.split(" ");
      dayDeparture = dateDepartureSplit[0];
      monthDeparture = dateDepartureSplit[1];
      yearDeparture = dateDepartureSplit[2];
      
      //mengganti bulan dari nama bulan ke nomor bulan
      switch(monthDeparture){
        case "January":
          monthDeparture = "01";
          break;
        case "February":
          monthDeparture = "02";
          break;
        case "March":
          monthDeparture = "03";
          break;
        case "April":
          monthDeparture = "04";
          break;
        case "May":
          monthDeparture = "05";
          break;
        case "June":
          monthDeparture = "06";
          break;
        case "July":
          monthDeparture = "07";
          break;
        case "August":
          monthDeparture = "08";
          break;
        case "September":
          monthDeparture = "09";
          break;
        case "October":
          monthDeparture = "10";
          break;
        case "November":
          monthDeparture = "11";
          break;
        case "December":
          monthDeparture = "12";
          break;
      }

      //cek apakah tanggal kembali dalam keadaan aktif atau tidak
      if($('#date-return').is(":disabled")) {

      //jika aktif, maka menjalankan fungsi untuk membandingkan tanggal pemberangkatan dan kembali
      } else {
        var departureDateCompare = parseInt(dayDeparture * 24) + parseInt(monthDeparture * 360) + parseInt(yearDeparture * 8640);
        var returnDateCompare = parseInt(dayReturn * 24) + parseInt(monthReturn * 360) + parseInt(yearReturn * 8640);
        
        //jika tanggal pemberangkatan lebih besar dari tanggal kembali,
        //maka value dari tanggal kembali akan di set sama dengan tanggal pemberangkatan
        if(departureDateCompare > returnDateCompare) {
          $('#date-return').val(dateDeparture);
          $('#dtp_input2').attr("value", $('#dtp_input1').attr("value"));
        }
      }

      //lalu setelah itu menggabungkan kembali tanggal yang telah dipecah menjadi satu
      dateDeparture = dayDeparture + "-" + monthDeparture + "-" + yearDeparture;

      //men-set pop-up kalender agar tanggal yang lebih kecil dari tanggal pemberangkatan menjadi disable
      $('#date-return').parent().datetimepicker('setStartDate', "'" + dateDeparture + "'");
    });

    var dateReturn = "";
    var dayReturn = "";    
    var monthReturn = "";
    var yearReturn = "";    
    $('#date-return').on("change", function(){
      var dateReturn = $(this).val();
      dateReturnSplit = dateReturn.split(" ");
      dayReturn = dateReturnSplit[0];
      monthReturn = dateReturnSplit[1];
      yearReturn = dateReturnSplit[2];
      
      switch(monthReturn){
        case "January":
          monthReturn = "01";
          break;
        case "February":
          monthReturn = "02";
          break;
        case "March":
          monthReturn = "03";
          break;
        case "April":
          monthReturn = "04";
          break;
        case "May":
          monthReturn = "05";
          break;
        case "June":
          monthReturn = "06";
          break;
        case "July":
          monthReturn = "07";
          break;
        case "August":
          monthReturn = "08";
          break;
        case "September":
          monthReturn = "09";
          break;
        case "October":
          monthReturn = "10";
          break;
        case "November":
          monthReturn = "11";
          break;
        case "December":
          monthReturn = "12";
          break;
      }

      dateReturn = dayReturn + "-" + monthReturn + "-" + yearReturn;
    });


    $('.form_date input').on("change", function() {
      

    });

    $('.form_date input').click(function(){
        return false;
        $(this).parent().find('.glyphicon-calendar').trigger('click');
    });

if($(window).width() <= 350) {
  $('.btn-switch').text("Switch");
}
