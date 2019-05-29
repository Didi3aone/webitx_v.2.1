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
                <!-- <a class="pointer" ng-click="GoToAddNewPage()">
                    <span class="fa fa-plus"></span>&nbsp;&nbsp;Add New
                </a> -->
            </div>
			<div class="table-responsive">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th>No</th>
                            <th>Parent Name</th>
							<th>Menu / Nav NAme</th>
							<th>Seo Url</th>
                            <th>Redirect Url</th>
                            <th>Show On</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="data in List" ng-class="{'error' : data.PageStatus == 1}">
                            <td>
                                {{ $index+1 }}
                            </td>
                            <td>
                                {{ data.ParentName }}
                            </td>
                            <td>
                                {{ data.NavName }}
                            </td>
                            <td>
                                {{ data.SeoUrl }}
                            </td>
                            <td>
                                {{ data.RedirectUrl }}
                            </td>
                            <td>
                                {{ data.PageLocation }}
                            </td>
							<td class="table-action">
			                    <a ng-click="GoToDetailPage(data.PageId)" class="tooltipx pointer">
                                    <i class="fa fa-pencil"></i><span>Edit Page</span>
			                    </a>
                                <a ng-if="data.PageStatus == 1" ng-click="PublishPage(data.PageId, 0)" class="tooltipx pointer">
                                    <i class="fa fa-plus"></i><span>Publish Page</span>
                                </a>
                                <a ng-if="data.PageStatus == 0" ng-click="PublishPage(data.PageId, 1)" class="tooltipx pointer">
                                    <i class="fa fa-minus"></i><span>Hide Page</span>
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
    	$scope.AngularService = AngularService;
    	$scope.List = <?=json_encode($List)?>;
    };

    (function () {
        // FlightSearch.startLoadingPage("Your transaction is being processed. Please be patient");
        $scope.init();
        $('#ParentPages').addClass('active nav-active').find('ul').css('display','block');
        $('#ChildrenPages').addClass('active');

        getDatatablesContent();

    })();
    // AngularService

    function getDatatablesContent(){
        $scope.columnDefs = [];

        $scope.columnDefs.push(
            {className: "text-left",orderable: true,targets: [0], visible: true}, // Menu / Nav Name
            {className: "text-left",orderable: true,targets: [1], visible: true}, // Seo Url
            {className: "text-left",orderable: true,targets: [2], visible: true}, // Action
        );

        setTimeout(function() {
            var table = $('#datatable').DataTable({
                "sPaginationType": "full_numbers",
                "iDisplayStart": 20,
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

    $scope.GoToDetailPage = function(PageId) {
        window.location.href = adminUrl+'pages/detailPage/'+PageId;
    };

    $scope.PublishPage = function(PageId, status) {
        var c = confirm("Are you sure?");
        if(c) {
            AngularService.startLoadingPage();
            $http.post(
                adminUrl+'crud_page/publishPage',
                {'PageId': PageId, 'Status' : status}
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
                AngularService.ErrorResponse('');
            });
        }
    };
    

  }); // --- end angular controller --- //
</script>

</body>
</html>