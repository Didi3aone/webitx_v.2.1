<?php echo $ViewHead?>
<body ng-controller="TransactionController">
<?php echo $ViewPreLoader?>

<section>
	<?php echo $ViewLeftPanel?>
	<div class="mainpanel">
	<?php echo $ViewHeaderBar?>
        <div class="contentpanel cs_df">   
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="mb10">
                        <a class="pointer" ng-click="GoToAddNewArticle()">
                            <span class="fa fa-plus"></span>&nbsp;&nbsp;Add New Article
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Seo Url</th>
                                    <!-- <th>Publish</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in List">
                                    <td> {{ $index+1 }} </td>
                                    <td> {{ data.title }} </td>
                                    <td> {{ data.category }} </td>
                                    <td> {{ data.url }} </td>
                                    <!-- <td> {{ data.publish }} </td> -->
                                    <td class="table-action">
                                        <a ng-click="GoToEditArticle(data.hash_id)" class="tooltipx pointer">
                                            <i class="fa fa-pencil"></i><span>Edit Article</span>
                                        </a>
                                        <a ng-click="Deletearticle(data.id)" class="tooltipx pointer">
                                            <i class="fa fa-trash-o"></i><span>Delete Article</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
            <?php echo $ViewCopyRight?>
        </div>
    </div><!-- mainpanel -->
</section>

<?php echo $ViewFooter?>

<script type="text/javascript">
  app.controller('TransactionController', function (AngularService, $scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
    	$scope.AngularService   = AngularService;
    	$scope.List             = <?php echo json_encode($List)?>;
    };

    (function () {
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
    
    $scope.GoToAddNewArticle = function() {
        window.location.href = adminUrl+'manages/create_article/';
    };

    $scope.GoToEditArticle = function(article_id) {
        window.location.href = adminUrl+'manages/edit_article/'+article_id;
    };

    $scope.Deletearticle = function(article_id) {
        // console.log(article_id);
        var c = confirm("Are you sure you want to delete this data?");
          if(c) {
            AngularService.startLoadingPage();
            $http.post(
                adminUrl+'manages/delete_article',
                {'id': article_id}
            ).then(function successCallback(resp) {
                console.log(resp);
                AngularService.stopLoadingPage();
                if (resp.data['is_error'] == true) {
                    AngularService.ErrorResponse(resp.data['error_msg']);
                }
                else {
                    AngularService.SuccessResponse();
                }
            }, function errorCallback(err) {
                // console.log(err);
                AngularService.ErrorResponse(err);
            });
        }
    };
}); // --- end angular controller --- //
</script>

</body>
</html>