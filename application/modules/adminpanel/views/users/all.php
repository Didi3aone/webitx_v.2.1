<?=$ViewHead?>
<body ng-controller="TransactionController">
<?=$ViewPreLoader?>

<section>
	<?=$ViewLeftPanel?>
	<div class="mainpanel">
	<?=$ViewHeaderBar?>

    <div class="contentpanel cs_df">   
		<div class="panel panel-default">
        <div class="panel-body">
			<div class="mb10">
                <a class="pointer" ng-click="GoToAddNewUser()">
                    <span class="fa fa-plus"></span>&nbsp;&nbsp;Add New
                </a>
            </div>
			<div class="table-responsive">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Username</th>
							<th>Email</th>
							<th>First Name</th>
							<th>Last Name</th>
                            <th>Type</th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="data in List">
                            <td> {{ $index+1 }} </td>
                            <td> {{ data.UserName }} </td>
                            <td> {{ data.Email }} </td>
                            <td> {{ data.FirstName }} </td>
                            <td> {{ data.LastName }} </td>
                            <td> {{ data.Group.name }} </td>
							<td class="table-action">
			                    <a ng-click="GoToDetailUser(data.UserId)" class="tooltipx pointer">
                                    <i class="fa fa-pencil"></i><span>Edit User</span>
			                    </a>
                                <a ng-if="Member.id != data.UserId" ng-click="DeleteUser(data.UserId)" class="tooltipx pointer">
                                    <i class="fa fa-trash-o"></i><span>Delete User</span>
                                </a>
			                </td>
						</tr>
					</tbody>
				</table> 
			</div>
		</div>
		</div>

      <?=$ViewCopyRight?>
    </div>

  </div><!-- mainpanel -->

</section>

<?=$ViewFooter?>

<script type="text/javascript">
  app.controller('TransactionController', function (AngularService, $scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
    	$scope.AngularService   = AngularService;
    	$scope.List             = <?=json_encode($List)?>;
        $scope.Member           = <?=json_encode($Member)?>;
    };

    (function () {
        // FlightSearch.startLoadingPage("Your transaction is being processed. Please be patient");
        $scope.init();
        $('#ParentUsers').addClass('active nav-active').find('ul').css('display','block');
        $('#ChildrenAllUser').addClass('active');

        getDatatablesContent();

    })();

    function getDatatablesContent(){
        $scope.columnDefs = [];

        $scope.columnDefs.push(
            {className: "text-left",orderable: true,targets: [0], visible: true}, // No
            {className: "text-left",orderable: true,targets: [1], visible: true}, //  Discount
            {className: "text-left",orderable: true,targets: [2], visible: true}, // QTY
            {className: "text-left",orderable: true,targets: [3], visible: true},   //  Start date
            {className: "text-left",orderable: true,targets: [4], visible: true},   // End date
            {className: "text-left",orderable: true,targets: [5], visible: true}, // Action
        );

        setTimeout(function() {
            var table = $('#datatable').DataTable({
                "sPaginationType": "full_numbers",
                destroy: true,
                "lengthChange": false,
                "aaSorting": [],
                buttons: {
                    buttons: []
                },
                columnDefs: $scope.columnDefs
            });
        }, 300);
    };
    
    $scope.GoToAddNewUser = function() {
        window.location.href = adminUrl+'users/add';
    };

    $scope.GoToDetailUser = function(UserId) {
        window.location.href = adminUrl+'users/add/'+UserId;
    };

    $scope.DeleteUser = function(UserId) {
        var c = confirm("Are you sure you want to delete this data?");
          if(c) {
            AngularService.startLoadingPage();
            $http.post(
                adminUrl+'crud_user/deleteUser',
                {'UserId': UserId}
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
    };
    

  }); // --- end angular controller --- //
</script>

</body>
</html>