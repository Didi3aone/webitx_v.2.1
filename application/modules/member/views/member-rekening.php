<?php 
	$bank_id 		= (isset($bank['bank_id'])) ? $bank['bank_id'] : "";
	$bank_name 		= (isset($bank['bank_name'])) ? $bank['bank_name'] : "";
	$bank_account 	= (isset($bank['bank_account'])) ? $bank['bank_account'] : "";
	$bank_user 		= (isset($bank['bank_user'])) ? $bank['bank_user'] : "";
?>
<div id="rekening_bank" class="tab-pane">
    <div class="container">
	    <div class="row">
	        <div class="col">
	            <section class="card card-admin" style="">
	                <header class="card-header">
	                    <div class="card-actions">
	                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
	                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
	                    </div>
	                </header>
	                <div class="card-body">
	                    <form class="form-horizontal" id="forms_rekening" method="POST" action="<?php echo site_url('member/submit_rekening') ?>" enctype="multipart/form-data">
	                    	<input type="hidden" name="id" value="<?= $bank_id; ?>">
	                        <div class="form-group row">
	                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Nama Bank <span class="wajib">*</span></label>
	                            <div class="col-lg-9">
	                                <input class="form-control" name="bank_name" id="bank_name" type="text" placeholder="Nama Bank" value="<?= $bank_name; ?>">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">No. Rekening  <span class="wajib">*</span></label>
	                            <div class="col-lg-9">
	                                <input class="form-control" name="bank_account" id="bank_account"type="text" placeholder="No. Rekening" value="<?= $bank_account; ?>">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Atas Nama <span class="wajib">*</span></label>
	                            <div class="col-lg-9">
	                                <input class="form-control" name="bank_user" id="bank_user" type="text" placeholder="Atas Nama" value="<?= $bank_user; ?>">
	                            </div>
	                        </div>  
	                        <div class="form-group row col-lg-3">
	                            <button type="submit" class="btn btn-primary btn-submit-rekening btn-modern pull-left" data-loading-text="Loading..."> Submit </button>
	                        </div>
	                    </form>
	                </div>
	            </section>
	        </div>
	    </div>
	</div>
</div>