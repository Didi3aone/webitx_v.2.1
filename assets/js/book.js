$(document).ready(function() {

  /*scrolling the method step, 
  choose which method that has class active then scroll it to center*/
  var active_on_page = parseInt($('.per_step_holder.active.on_page').offset().left);
  var to_scroll = active_on_page - ((116/425) * 100);
  $('.step_holder').scrollLeft(to_scroll);
  
  $('input[type="number"]').on('keydown', function(e) {
     if (e.which === 38 || e.which === 40) {
        e.preventDefault();
       } 
  });
  
  var date = new Date();
  var tanggal = date.getDate();
  var bulan = date.getMonth() + 1;
  var tahun = date.getFullYear();
  
  $('#order_day').val(tanggal);
  $('#order_month').val(bulan);
  $('#order_year').val(tahun);
  
  //$('input[type="number"]').on("change", function() {
      //var num = parseInt(this.value, 10),
            //min = $(this).attr("min"),
            //max = $(this).attr("max");
    
        //if (isNaN(num)) {
            //this.value = "";
            //return;
        //}
    
        //this.value = Math.max(num, min);
        //this.value = Math.min(num, max); 
  //});

});
