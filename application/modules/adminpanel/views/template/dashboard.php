<?=$ViewHead?>
<body ng-controller="DashboardController">
<?=$ViewPreLoader?>

<section>
  <?=$ViewLeftPanel?>
  <div class="mainpanel">
  <?=$ViewHeaderBar?>

    <div class="contentpanel cs_df">
      <?=$ViewCopyRight?>
    </div>

  </div><!-- mainpanel -->
  <div class="rightpanel cs_df scrollbar">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users mr_5"></i> Support Center</a></li>
        <!-- <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
        <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
        <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li> -->
    </ul>
        
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="rp-alluser">
        </div>
    </div><!-- tab-content -->
  </div><!-- rightpanel -->  
</section>

<?=$ViewFooter?>

<script type="text/javascript">
  app.controller('DashboardController', function (AngularService, $scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
      $scope.AngularService = AngularService;
    };

    (function () {
        // FlightSearch.startLoadingPage("Your transaction is being processed. Please be patient");
        $scope.init();
        $('#ParentDashboard').addClass('active');
    })();

  }); // --- end angular controller --- //
</script>

</body>
</html>
