
<?php $this->load->view('adminpanel/template/head'); ?>
<body class="signin" ng-controller="LoginController">
<?php $this->load->view('adminpanel/template/preloader'); ?>

<section>
    <div class="signinpanel cs_df">
        <div class="row">
            <div class="col-md-12"></div>
            <div class="col-md-7">
                <div class="signin-info">
                    <div class="logopanel">
                        <!-- <h1><img src="images/logo.png" class="img-responsive" /></h1> -->
                        <h1><img src="<?=base_url('assets/images/logo/5c98e37a12ec7.png')?>" class="img-responsive"> </h1>
                    </div><!-- logopanel -->
                    <div class="mb20"></div>
                    <ul></ul>
                </div><!-- signin0-info -->
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                <form ng-submit="SubmitLogin($event)" id="FormLogin" method="post" action="<?=base_url('adminpanel/login/checkLogin')?>">
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                    
                    
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input ng-model="Username" type="text" name="username" class="form-control uname" placeholder="Username" required="required" />
                    <input ng-model="Password" type="password" name="password" class="form-control pword" placeholder="Password" required="required"/>

                    <div class="mt_5"><a href="javascript:;" data-toggle="modal" data-target="#myModal"><small>Term & Condition</small></a></div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Term & Condition</h4>
                          </div>
                          <div class="modal-body aj">
                            <h5>PERUBAHAN TERMS & CONDITIONS</h5>
                              <p>Pengelola dapat setiap saat mengganti, menambah, mengurangi Terms & Conditions ini tanpa harus melakukan pemberitahuan sebelumnya kepada pengguna. Anda terikat dengan setiap perubahan tersebut. Oleh karenanya secara berkala, Anda diimbau untuk  melihat halaman ini.</p>
                              <br/>
                              <h5>HAK CIPTA</h5>
                              <p>Anda tidak diperkenankan menyadur, mengutip atau menyalin seluruh konten pada situs ini, seperti teks, grafis, logo, ikon, gambar maupun program tanpa persetujuan dari pengelola.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div><!-- modal-content -->
                      </div><!-- modal-dialog -->
                    </div><!-- modal -->
                    <button class="btn btn-success btn-block">Sign In</button>
                    <!-- <input type="submit" class="hidden" id="FormLoginSubmit"> -->
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
      
        <div class="signup-footer">
            <div class="pull-left">
                Copyright &copy; 2018 Opsigo. All Rights Reserved.
            </div>
            <!-- <div class="pull-right">
          </div> -->
        </div>
        
    </div><!-- signin -->
  
</section>
 
<?php $this->load->view('adminpanel/template/footer'); ?>


<script type="text/javascript">
  app.controller('LoginController', function ($scope, $filter, $window, $http, $timeout) {

    $scope.init = function() {
        $scope.Username   = '';
        $scope.Password   = '';
    };

    (function () {
        $scope.init();
        <?php if ($this->session->flashdata('AdmPanelLoginError')): ?>
            setTimeout(function(){
              swal({
                  title: "Error",
                  text: "<?=$this->session->flashdata('AdmPanelLoginError')?>",
                  type:"error"
                });
            },500);
        <?php endif;?>
    })();

    $scope.SubmitLogin = function(e)
    {
      if ($scope.Username == '' || $scope.Password == '') {
        e.preventDefault();        
      }
    };

  }); // --- end angular controller --- //

</script>

</body>
</html>