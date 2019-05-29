<?=$ViewHead?>

<script type='text/javascript' src="<?=base_url('assets/lib/plugins/jscolor/jscolor.js')?>"></script>

<body ng-controller="GeneralController">
<?=$ViewPreLoader?>

<section>
	<?=$ViewLeftPanel?>
	<div class="mainpanel">
	<?=$ViewHeaderBar?>

    <div class="contentpanel cs_df">  
        <!-- <form id='FormAdd' class="form-horizontal" name="GeneralInfo"> -->
        	<form id="FormAdd" class="form-horizontal" method="post" enctype="multipart/form-data" name="GeneralInfo">
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

					<!-- TitleSite -->
					<div class="form-group">
                        <label class="col-sm-3 control-label">Title Site</label>
                        <div class="col-sm-9">
                          <input ng-model="GeneralData.Title" type="text" class="form-control"/>
                        </div>
                    </div>
	                <!-- End TitleSite -->

                    <!-- Tagline -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tagline</label>
                        <div class="col-sm-9">
                          <textarea id="Tagline" rows="5" class="form-control ckeditorr">{{GeneralData.Tagline}}</textarea>
                        </div>
                    </div>

	                <!-- Logo -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Logo</label>
                        <div class="col-sm-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                  <div class="uneditable-input">
                                    <i class="glyphicon glyphicon-file fileupload-exists"></i>
                                    <span class="fileupload-preview"></span>
                                  </div>
                                  <span class="btn btn-default btn-file">
                                    <span class="fileupload-new">Select file</span>
                                    <span class="fileupload-exists">Change</span>
                                    <input id="logo" name="logo" type="file" />
                                  </span>
                                  <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                                <span class="help-block">Optimal Dimensions : 200 x 250px</span>
                            </div>
                            
                            <div ng-if="GeneralData.Logo" class="mt10">
                                <a ng-href="{{BaseUrl}}assets/images/logo/{{GeneralData.Logo}}" title="logo" data-fancybox data-caption="Logo">
                                    Logo
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Favicon</label>
                        <div class="col-sm-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                  <div class="uneditable-input">
                                    <i class="glyphicon glyphicon-file fileupload-exists"></i>
                                    <span class="fileupload-preview"></span>
                                  </div>
                                  <span class="btn btn-default btn-file">
                                    <span class="fileupload-new">Select file</span>
                                    <span class="fileupload-exists">Change</span>
                                    <input id="Favicon" name="favicon" type="file"/>
                                  </span>
                                  <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                                <span class="help-block">Optimal Dimensions : 32 x 32 px</span>
                            </div>

                            <div ng-if="GeneralData.Favicon" class="mt10">
                                <a ng-href="{{BaseUrl}}assets/images/favicon/{{GeneralData.Favicon}}" title="logo" data-fancybox data-caption="Logo">
                                    Favicon
                                </a>
                            </div>
                        </div>
                    </div>

                     <!-- Background Image -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Background Image</label>
                        <div class="col-sm-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                  <div class="uneditable-input">
                                    <i class="glyphicon glyphicon-file fileupload-exists"></i>
                                    <span class="fileupload-preview"></span>
                                  </div>
                                  <span class="btn btn-default btn-file">
                                    <span class="fileupload-new">Select file</span>
                                    <span class="fileupload-exists">Change</span>
                                    <input id="BackgroundImage" name="backgroundImage" type="file"/>
                                  </span>
                                  <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                                <span class="help-block">Optimal Dimensions : 1920 x 471 px</span>
                            </div>

                            <div ng-if="GeneralData.BackgroundImage" class="mt10">
                                <a ng-href="{{BaseUrl}}assets/images/background/{{GeneralData.BackgroundImage}}" title="logo" data-fancybox data-caption="Logo">
                                    Background Image
                                </a>
                            </div>
                        </div>
                    </div>

					<!-- MetaKeyword -->
					<div class="form-group">
                        <label class="col-sm-3 control-label">Meta Keyword</label>
                        <div class="col-sm-9">
                          <input ng-model="GeneralData.MetaKeyword" type="text" class="form-control"/>
                        </div>
                    </div>
	                <!-- End MetaKeyword -->

	                <!-- MetaDescription -->
					<div class="form-group">
                        <label class="col-sm-3 control-label">Meta Description</label>
                        <div class="col-sm-9">
                          <input ng-model="GeneralData.MetaDescription" type="text" class="form-control"/>
                        </div>
                    </div>
	                <!-- End MetaDescription -->

                    <!-- Color -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">General Color</label>
                        <div class="col-sm-9">
                          <input class="jscolor" ng-model="GeneralData.Color" type="text" class="form-control"/>
                        </div>
                    </div>
                    <!-- End Color -->

                    <!-- Use Header Old Website -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Header Old Website</label>
                        <div class="col-sm-2">
                          <select ng-model="GeneralData.UseOldWebsite" class="form-control">
                              <option ng-value="1">TRUE</option>
                              <option ng-value="0">FALSE</option>
                          </select>
                        </div>
                    </div>

                    <!-- End Use Header Old Website -->

                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </div>

                    <!-- Checkbox Image -->
                    <!-- <div class="form-group">
                        <label class="col-sm-3 control-label">Formula</label>
                        <div class="col-sm-9">
                          <div ng-repeat="(key, data) in GeneralData.ChoosenCheckbox" class="ckbox ckbox-primary mt_5">
                            <input ng-model="GeneralData.ChoosenCheckbox[key]" id="{{ key }}" type="checkbox" /> 
                            <label for="{{ key }}">
                                <a ng-change="selectCheckbox" ng-href="{{BaseUrl}}assets/images/{{GeneralData.ListCheckbox[$index]}}" title="logo" data-fancybox data-caption="Logo">
                                    {{ key }} 
                                </a>
                            </label>
                          </div>
                        </div>
                    </div> -->

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

app.controller('GeneralController', function (AngularService, $scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
        $scope.BaseUrl              = "<?=base_url()?>";
    	$scope.AngularService       = AngularService;
    	$scope.GeneralData	 = <?=json_encode($GeneralData)?>;
        $scope.GeneralData.UseOldWebsite = parseInt($scope.GeneralData.UseOldWebsite);        
    };

    (function () {
        $scope.init();

        $('#ParentSettings').addClass('active nav-active').find('ul').css('display','block');
        $('#ChildrenGeneral').addClass('active');

        $('.datepicker').datepicker();
        $('.timepicker').timepicker({showMeridian: false});

    })();

    $(function() {
        $('.ckeditorr').ckeditor({
            toolbar: 'Full',
            enterMode : CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_P
        });
    });

	var form = document.forms.namedItem("GeneralInfo");
    form.addEventListener('submit', function(ev) {
        var oOutput = document.querySelector("div"),oData = new FormData(form);
        var oReq = new XMLHttpRequest();
        oReq.open("POST", adminUrl+'ajax/uploadImageSettingGeneral', true);
        oReq.onload = function(oEvent) {
            if (oReq.status) {
                $scope.EditGeneral();
            }
        };
        oReq.send(oData);
        ev.preventDefault();
    }, false);

    $scope.EditGeneral = function() {
        $scope.GeneralData.Tagline = CKEDITOR.instances['Tagline'].getData();
        $scope.GeneralData.Color = $scope.GeneralData.Color;
        AngularService.startLoadingPage();
        $http.post(
            adminUrl+'crud_setting/editGeneral',
            {'data'	: $scope.GeneralData}
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

    // Color Picker
    if(jQuery('#colorpicker').length > 0) {
     jQuery('#colorSelector').ColorPicker({
        onShow: function (colpkr) {
          jQuery(colpkr).fadeIn(500);
          return false;
        },
        onHide: function (colpkr) {
          jQuery(colpkr).fadeOut(500);
          return false;
        },
        onChange: function (hsb, hex, rgb) {
          jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
          jQuery('#colorpicker').val('#'+hex);
        }
     });
    }
    
    // Color Picker Flat Mode
    jQuery('#colorpickerholder').ColorPicker({
      flat: true,
      onChange: function (hsb, hex, rgb) {
        jQuery('#colorpicker3').val('#'+hex);
      }
    });


  }); // --- end angular controller --- //
</script>

</body>
</html>