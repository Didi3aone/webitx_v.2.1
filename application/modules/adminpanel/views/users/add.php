<?=$ViewHead?>
<body ng-controller="DiscountController">
<?=$ViewPreLoader?>

<section>
	<?=$ViewLeftPanel?>
	<div class="mainpanel">
	<?=$ViewHeaderBar?>

    <div class="contentpanel cs_df">  
        <form id='FormAdd' class="form-horizontal" ng-submit="UserId ? EditUser() : AddUser()">
            <div class="panel panel-default">
                <!-- Header Form -->
                <div class="panel-heading">
                    <div class="panel-btns">
                        <a href="#" class="minimize">&minus;</a>
                        <a class="pointer" ng-click="GoBack()"><i class="fa fa-arrow-left" style="margin-right: 10px;"></i>| </a>
                    </div>
                    <h4 class="panel-title">Form Input</h4>
                </div>
                <!-- End Header Form -->

                <!-- Body Form -->
                <div class="panel-body">
                    <!-- Type -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Type <span class="asterisk">*</span></label>
                        <div class="col-sm-5">
                          <select ng-readonly="UserId" ng-model="MemberData.Group" class="form-control" required>
                              <option ng-value="1">Admin</option>
                              <option ng-value="2">Member</option>
                          </select>
                        </div>
                    </div>

                    <!-- UserName -->
                    <div ng-if="MemberData.Group == 1" class="form-group">
                        <label class="col-sm-3 control-label">Username <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                          <input required ng-model="MemberData.UserName" type="text" class="form-control" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                          <input ng-readonly="UserId && MemberData.Group == 2" required ng-model="MemberData.Email" type="email" class="form-control" />
                        </div>
                    </div>

                    <!-- FirstName -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">First Name <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                          <input required ng-model="MemberData.FirstName" type="text" class="form-control" />
                        </div>
                    </div>

                    <!-- LastName -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Last Name <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                          <input required ng-model="MemberData.LastName" type="text" class="form-control" />
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Phone <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                          <input required ng-model="MemberData.Phone" type="number" class="form-control" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password <span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                          <input ng-required="MemberData.UserId" ng-model="MemberData.Password1" type="password" class="form-control" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Password Confirmation<span class="asterisk">*</span></label>
                        <div class="col-sm-9">
                          <input ng-required="MemberData.UserId" ng-model="MemberData.Password2" type="password" class="form-control" />
                        </div>
                    </div>

                    <!-- Is Publish -->
                    <!-- <div class="form-group">
                        <label class="col-sm-3 control-label">Publish</label>
                        <div class="col-sm-9">
                          <div class="ckbox ckbox-primary mt_5">
                            <input ng-model='MemberData.IsPublish' type="checkbox"  id="publish" ng-checked="MemberData.IsPublish" />
                            <label for="publish"></label>
                          </div>
                        </div>
                    </div> -->

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

<script type="text/javascript">
  app.controller('DiscountController', function (AngularService, $scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
    	$scope.AngularService       = AngularService;
        $scope.UserId               = <?=$UserId?>;
        if ($scope.UserId) {
            $scope.MemberData       = <?=json_encode($MemberData)?>;
            $scope.MemberData.Phone = parseInt($scope.MemberData.Phone);
            $scope.MemberData.Group = parseInt($scope.MemberData.Group);
        }
        else {
            $scope.MemberData = {};
            $scope.MemberData.Group = 1;
        }
    };

    (function () {
        $scope.init();
        $('#ParentUsers').addClass('active nav-active').find('ul').css('display','block');
        $('#ChildrenAddUser').addClass('active');
    })();

    $scope.AddUser = function() {
        console.log($scope.MemberData);
        AngularService.startLoadingPage();
        $http.post(
            adminUrl+'crud_user/addUser',
            {'data': $scope.MemberData}
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

    $scope.EditUser = function() {
        console.log($scope.MemberData);
        AngularService.startLoadingPage();
        $http.post(
            adminUrl+'crud_user/editUser',
            {'data': $scope.MemberData}
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

    $scope.GoBack = function() {
        window.history.back();
    };


  }); // --- end angular controller --- //
</script>

</body>
</html>