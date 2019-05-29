var app = angular.module('App', ['ngCookies', 'ngRoute']);

app.run(function run( $http, $cookies ){
  $http.defaults.headers.common["X-CSRF-TOKEN"] = $cookies.get('5f05193eee9e900380c12e6040e7dee9');
});

app.service('AngularService', function() {

  this.GoToDashboard = function() {
    window.location.href= adminUrl+'/dashboard';
  };

  // start loading page
  this.startLoadingPage = function () {
    $('#preloader').find('#status').show();
    $('#preloader').show();
  },
  // jQuery('#status').fadeOut();
  //  jQuery('#preloader').delay(350).fadeOut(function(){
  //     jQuery('body').delay(350).css({'overflow':'visible'});
  //  });

  // stop loading page
  this.stopLoadingPage = function()
  {
    $('#preloader').fadeOut();
    $('#preloader').find('#status').delay(350).fadeOut(function(){
      $('body').delay(350).css({'overflow':'visible'});
   });
    return false;
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
    }

  this.numberFormatClean = function (nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1;
    },

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
  }

});