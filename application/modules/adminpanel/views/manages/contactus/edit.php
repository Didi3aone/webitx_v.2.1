<?=$ViewHead?>
<body ng-controller="ContactUsController">
<?=$ViewPreLoader?>

<section>
	<?=$ViewLeftPanel?>
	<div class="mainpanel">
	<?=$ViewHeaderBar?>

    <div class="contentpanel cs_df">  
        <form id='FormAdd' class="form-horizontal" ng-submit="EditContactUs()" name="BankInfo">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <input ng-if="CheckBank == 1" type="hidden" ng-model="BankData.BankId">
            <div class="panel panel-default">
                <!-- Header Form -->
                <div class="panel-heading">
                    <div class="panel-btns">
                        <a href="#" class="minimize">&minus;</a>
                        <a class="pointer" ng-click="GoToList()"><i class="fa fa-arrow-left" style="margin-right: 10px;"></i>| </a>
                    </div>
                    <h4 class="panel-title">Form Input</h4>
                </div>
                <!-- End Header Form -->

                <!-- Body Form -->
                <div class="panel-body">

                	<!-- Contact Center 1 -->
                	<div class="panel-heading mb_10">
						<h1 class="panel-title">Contact Center 1</h1>
					</div>
					<div class="panel-heading">
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Title</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter.title" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Phone</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter.phone" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Email</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter.email" type="text" class="form-control"/>
	                        </div>
	                    </div>
					</div>
					<!-- End Contact Center 1 -->

					<!-- Contact Center 2 -->
                	<div class="panel-heading mb_10">
						<h1 class="panel-title">Contact Center 2</h1>
					</div>
					<div class="panel-heading">
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Title</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter2.title" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Phone</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter2.phone" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Email</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter2.email" type="text" class="form-control"/>
	                        </div>
	                    </div>
					</div>
					<!-- End Contact Center 2 -->

					<!-- Contact Center 3 -->
                	<div class="panel-heading mb_10">
						<h1 class="panel-title">Contact Center 2</h1>
					</div>
					<div class="panel-heading">
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Title</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter3.title" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Phone</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter3.phone" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Email</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.ContactCenter3.email" type="text" class="form-control"/>
	                        </div>
	                    </div>
					</div>
					<!-- End Contact Center 3 -->

					<!-- Address -->
                	<div class="panel-heading mb_10">
						<h1 class="panel-title">Company Detail</h1>
					</div>
					<div class="panel-heading">
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Company Detail</label>
	                        <div class="col-sm-9">
	                          <textarea rows="5" name="Address" id="Address" class="form-control ckeditorr">{{ContactUsData.CompanyAddress}}</textarea>
	                        </div>
	                    </div>
					</div>
					<!-- End Address -->

					<!-- CompanyName -->
					<!-- <div class="panel-heading">
						<div class="form-group">
	                        <label class="col-sm-3 control-label">CompanyName</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.CompanyName" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                </div> -->
	                <!-- End CompanyName -->

					<!-- CopyRight -->
					<!-- <div class="panel-heading">
						<div class="form-group">
	                        <label class="col-sm-3 control-label">CopyRight</label>
	                        <div class="col-sm-9">
	                          <input ng-model="ContactUsData.CopyRight" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                </div> -->
	                <!-- End CopyRight -->

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Body Form -->
            </div>
        </form>
        <?=$ViewCopyRight?>
    </div>

  </div><!-- mainpanel -->

</section>

<?=$ViewFooter?>
<script src="<?=base_url('assets/adminpanel/js/ckeditor/ckeditor.js')?>"></script>
<script src="<?=base_url('assets/adminpanel/js/ckeditor/adapters/jquery.js')?>"></script> 

<script type="text/javascript">

app.controller('ContactUsController', function (AngularService, $scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
    	$scope.AngularService       = AngularService;
    	$scope.ContactUsData = <?=json_encode($ContactUsData)?>;
    };

    (function () {
        $scope.init();

        $('#ParentManages').addClass('active nav-active').find('ul').css('display','block');
        $('#ChildrenContactUs').addClass('active');

        $('.datepicker').datepicker();
        $('.timepicker').timepicker({showMeridian: false});

    })();

    // var form = document.forms.namedItem("BankInfo");
    // form.addEventListener('submit', function(ev) {
    //     var BankImage = document.getElementById("BankImage");
    //     var oOutput = document.querySelector("div"),oData = new FormData(form);
    //     var oReq = new XMLHttpRequest();
    //     oReq.open("POST", adminUrl+'ajax/uploadImageBank', true);
    //     oReq.onload = function(oEvent) {
    //         if (oReq.status) {
    //             if ($scope.CheckBank == 1) {
    //                 $scope.EditBank();
    //             }
    //             else {
    //                 $scope.AddBank();
    //             }
    //         }
    //     };
    //     oReq.send(oData);
    //     ev.preventDefault();
    // }, false);
    

    // $scope.AddBank = function() {
    //     console.log($scope.BankData);
    //     AngularService.startLoadingPage();
    //     $http.post(
    //         adminUrl+'crud/addBank',
    //         {'data': $scope.BankData}
    //     ).then(function successCallback(resp) {
    //         console.log(resp);
    //         AngularService.stopLoadingPage();
    //         if (resp.data['StatusResponse'] == 0) {
    //             AngularService.ErrorResponse(resp.data['Message']);
    //         }
    //         else if (resp.data['StatusResponse'] == 1) {
    //             AngularService.SuccessResponse();
    //         }
    //     }, function errorCallback(err) {
    //         console.log(err);
    //         AngularService.ErrorResponse(err);
    //     });    
    // }

    $(function() {
	    $('.ckeditorr').ckeditor({
	        toolbar: 'Full',
	        enterMode : CKEDITOR.ENTER_BR,
	        shiftEnterMode: CKEDITOR.ENTER_P
	    });
	});

    $scope.EditContactUs = function() {
        $scope.ContactUsData.CompanyAddress = CKEDITOR.instances['Address'].getData();
        console.log($scope.ContactUsData);
        AngularService.startLoadingPage();
        $http.post(
            adminUrl+'crud/editContactUs',
            {'data'	: $scope.ContactUsData}
        ).then(function successCallback(resp) {
            console.log(resp);
            AngularService.stopLoadingPage();
            if (resp.data['StatusResponse'] == 0) {
                AngularService.ErrorResponse(resp.data['Message']);
            }
            else if (resp.data['StatusResponse'] == 1) {
                AngularService.SuccessResponse();
            }
        }, function errorCallback(err) {
            console.log(err);
            AngularService.ErrorResponse(err);
        });    
    }

    $scope.GoToList = function() {
        window.history.back();
    };


  }); // --- end angular controller --- //
</script>

</body>
</html>