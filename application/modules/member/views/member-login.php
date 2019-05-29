<div class="container">
    <div class="row" >
        <div class="col">
            <div class="featured-boxes" style="margin-left: 25%">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="featured-box featured-box-primary text-left mt-5" style="box-shadow:0px 20px 20px -5px #9c9c9c">
                            <div class="box-content">
                                <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">
                                    <?= $form_title; ?>
                                </h4>
                                <form class="form-horizontal" id="form-login" method="POST" action="<?php echo site_url('member/submit_login') ?>" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-lg-4 font-weight-bold text-dark col-form-label form-control-label text-2">Username Or Email <span class="wajib">*</span></label>
                                        <div class="col-lg-8">
                                            <input class="form-control" name="param_mail_name" type="text" placeholder="Username or Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 font-weight-bold text-dark col-form-label form-control-label text-2">Password <span class="wajib">*</span></label>
                                        <div class="col-lg-8">
                                            <input class="form-control" name="password" id="password"type="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember_me" class="custom-control-input" id="rememberme">
                                                <label class="custom-control-label text-2" for="rememberme">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <button type="submit" value="Login" class="btn btn-primary btn-modern float-right btn-submit " data-loading-text="Loading...">Login</button>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>