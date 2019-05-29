<?=$ViewHead?>
<body ng-controller="ContactUsController">
<?=$ViewPreLoader?>

<section>
	<?=$ViewLeftPanel?>
	<div class="mainpanel">
	<?=$ViewHeaderBar?>

    <div class="contentpanel cs_df">  
        <form id="FormAdd" class="form-horizontal" method="post" enctype="multipart/form-data" name="PageInfo">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
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

					<!-- Nav Name -->
					<div class="form-group">
                        <label class="col-sm-3 control-label">Nav Name</label>
                        <div class="col-sm-9">
                          <input ng-model="PageData.NavName" type="text" class="form-control"/>
                        </div>
	                </div>
	                <!-- End Nav Name -->

	                <!-- Title  -->
					<div class="form-group">
                        <label class="col-sm-3 control-label">Title Name</label>
                        <div class="col-sm-9">
                          <input ng-model="PageData.TitleName" type="text" class="form-control"/>
                        </div>
	                </div>
	                <!-- End Title -->

	                <!-- SubTitle -->
					<div class="form-group">
                        <label class="col-sm-3 control-label">Sub Title</label>
                        <div class="col-sm-9">
                          <input ng-model="PageData.SubTitle" type="text" class="form-control"/>
                        </div>
                    </div>
	                <!-- End SubTitle -->

                	<!-- Description -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                          <textarea id="Description" rows="5" class="form-control ckeditorr">{{PageData.Description}}</textarea>
                        </div>
                    </div>
					<!-- End Address -->

					<!-- Sub Content -->
                    <!-- <div class="form-group">
                        <label class="col-sm-3 control-label">SubContent</label>
                        <div class="col-sm-9">
                          <textarea id="SubContent" rows="5" class="form-control ckeditorr">{{PageData.SubContent}}</textarea>
                        </div>
                    </div> -->
					<!-- End Sub Content -->

					<!-- Image Cover -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Image Cover</label>
                        <div class="col-sm-9">
                          <input id="ImageCover" multiple name="file" type="file" class="form-control"/>
                          <span class="help-block">Optimal Dimensions :1920 x 500 px</span>
                        </div>
                    </div>

					<!-- URL -->
						<div class="form-group">
	                        <label class="col-sm-3 control-label">Seo Url</label>
	                        <div class="col-sm-9">
	                          <input ng-model="PageData.SeoUrl" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                <!-- End URL -->

	                <!-- URL -->
					<div class="form-group">
                        <label class="col-sm-3 control-label">Redirect URL</label>
                        <div class="col-sm-9">
                          <input ng-model="PageData.RedirectUrl" type="text" class="form-control"/>
                        </div>
                    </div>
	                <!-- End URL -->

	                <!-- Parent Name -->
						<div class="form-group">
	                        <label class="col-sm-3 control-label">Parent Name</label>
	                        <div class="col-sm-9">
	                          <input readonly ng-model="PageData.ParentName" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                <!-- End Parent Name -->

	                <!-- Show On -->
						<div class="form-group">
	                        <label class="col-sm-3 control-label">Show On</label>
	                        <div class="col-sm-9">
	                          <input readonly ng-model="PageData.PageLocation" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                <!-- End Show On -->

	                <!-- Meta Keyword -->
						<div class="form-group">
	                        <label class="col-sm-3 control-label">Meta Keyword</label>
	                        <div class="col-sm-9">
	                          <input ng-model="PageData.MetaKeyword" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                <!-- End Meta Keyword -->

	                <!-- Meta Description -->
						<div class="form-group">
	                        <label class="col-sm-3 control-label">Meta Description</label>
	                        <div class="col-sm-9">
	                          <input ng-model="PageData.MetaDescription" type="text" class="form-control"/>
	                        </div>
	                    </div>
	                <!-- End Meta Description -->

	                <!-- Publish -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Publish</label>
                        <div class="col-sm-9">
                          <div class="ckbox ckbox-primary mt_5">
                            <input ng-model='PageData.IsPublish' type="checkbox"  id="publish" />
                            <label for="publish"></label>
                          </div>
                        </div>
                    </div>
                    <!-- End Publish -->

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
    	$scope.PageData = <?=json_encode($PageData)?>;
    };

    (function () {
        $scope.init();

        $('#ParentPages').addClass('active nav-active').find('ul').css('display','block');
        $('#ChildrenPages').addClass('active');
        
    })();


    $(function() {
	    $('.ckeditorr').ckeditor({
	        toolbar: 'Full',
	        enterMode : CKEDITOR.ENTER_BR,
	        shiftEnterMode: CKEDITOR.ENTER_P
	    });
	});

	var form = document.forms.namedItem("PageInfo");
    form.addEventListener('submit', function(ev) {
        var BankImage = document.getElementById("ImageCover");
        var oOutput = document.querySelector("div"),oData = new FormData(form);
        var oReq = new XMLHttpRequest();
        oReq.open("POST", adminUrl+'ajax/uploadImageCoverPage', true);
        oReq.onload = function(oEvent) {
            if (oReq.status) {
                $scope.editPage();
            }
        };
        oReq.send(oData);
        ev.preventDefault();
    }, false);

    $scope.editPage = function() {
        $scope.PageData.Description = CKEDITOR.instances['Description'].getData();
        console.log($scope.PageData);
        AngularService.startLoadingPage();
        $http.post(
            adminUrl+'crud_page/editPage',
            {'data'	: $scope.PageData}
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