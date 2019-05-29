<?php 
	$id 			= (isset($mitra_info->id)) ? $mitra_info->id : "";
	$brand 			= (isset($mitra_info->brand)) ? $mitra_info->brand : ""; 
	$mitra 			= (isset($mitra_info->mitra_name)) ? $mitra_info->mitra_name : ""; 
	$owner 			= (isset($mitra_info->owner)) ? $mitra_info->owner : ""; 
	$phone_no 		= (isset($mitra_info->phone_no)) ? $mitra_info->phone_no : ""; 
	$mobile_no 		= (isset($mitra_info->mobile_no)) ? $mitra_info->mobile_no : ""; 
	$province 		= (isset($mitra_info->province)) ? $mitra_info->province : ""; 
	$city 			= (isset($mitra_info->city)) ? $mitra_info->city : ""; 
	$sub_district 	= (isset($mitra_info->sub_district)) ? $mitra_info->sub_district : ""; 
	$postal_code 	= (isset($mitra_info->postal_code)) ? $mitra_info->postal_code : ""; 
	$website 		= (isset($mitra_info->website)) ? $mitra_info->website : ""; 
	$email 			= (isset($mitra_info->email)) ? $mitra_info->email : ""; 
	$logo 			= (isset($mitra_info->logo)) ? $mitra_info->logo : ""; 
	$address		= (isset($mitra_info->address)) ? $mitra_info->address : "";
	
	$name_text_logo = ($logo) ? "Change" : "Upload";
	$btn_msg		= ($id) ? "Update Data" : "Submit";
?>
<div id="info_mitra" class="tab-pane">
	<div class="container">
	    <div class="row">
	        <div class="col">
	            <section class="card card-admin">
	                <header class="card-header">
	                    <div class="card-actions">
	                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
	                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
	                    </div>
	                    <h2 class="card-title">Informasi Mitra</h2>
	                </header>
	                <div class="card-body">
	            		<form class="form-horizontal" id="forms_mitra" method="POST" action="<?php echo site_url('member/submit_mitra') ?>" enctype="multipart/form-data">
	            			<input type="hidden" name="id" value="<?= $id; ?>">
		                	<div class="row">
								<div class="col-lg-9">
			                    	<div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Nama Brand / Merk </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" name="brand" id="brand" type="text" placeholder="Nama Brand / Merk " value="<?= $brand; ?>">
			                            </div>
			                        </div>  
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Nama Perusahaan </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" name="mitra_name" id="mitra_name" type="text" placeholder="Nama Perusahaan" value="<?= $mitra; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Nama Pemilik Usaha </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" name="owner" id="owner"type="text" placeholder="Nama Pemilik Usaha" value="<?= $owner; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">No. Telepon </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" id="phone_no" name="phone_no" type="text" placeholder="No. Telepon" value="<?= $phone_no; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">No. HP </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" id="mobile_no" name="mobile_no" type="text" placeholder="No. HP" value="<?= $mobile_no; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Provinsi <span class="wajib">*</span></label>
			                            <div class="col-lg-9">
			                                <select style="width: 100%;" name="province" id="province" class="form-control select2" data-placeholder="-- Pilih Provinsi --">
			                                	<option></option>
												<?php echo modules::run('dropdown/provinsi', $mitra_info->province); ?>
			                                </select>
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Kabupaten <span class="wajib">*</span></label>
			                            <div class="col-lg-9">
							                <select class="form-control select2" name="city" id="citys" data-placeholder="-- Pilih Kabupaten --" style="width: 100%;">
												<option></option>
											</select>
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">kecamatan <span class="wajib">*</span></label>
			                            <div class="col-lg-9">
			                            	<select name="sub_district" class="selectKec" style="width:100%">
			                            		<option selected value="<?= $sub_district ?>"><?= $sub_district ?></option>
			                            	</select>
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Kode Pos </label>
			                            <div class="col-lg-9">
			                                <input class="form-control"  name="postal_code" id="postal_code" type="text" placeholder="Kode Pos" value="<?= $postal_code; ?>">
			                            </div>
			                        </div>

			                         <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Alamat Perusahaan </label>
			                            <div class="col-lg-9">
			                                <textarea class="form-control" name="address">
			                                	<?= $address; ?>
			                                </textarea>
			                            </div>
			                        </div>

			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Email </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" id="email" name="email" type="email" placeholder="email@gmail.com" value="<?= $email; ?>">
			                            </div>
			                        </div>

			                         <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Website </label>
			                            <div class="col-lg-9">
			                                <input class="form-control"  name="website" id="website" type="text" placeholder="Website" value="<?= $website; ?>">
			                            </div>
			                        </div>
			                        
			                        <div class="form-row">
                                        <button type="submit" class="btn btn-primary btn-submit-mitra btn-modern pull-right" data-loading-text="Loading..."> <?= $btn_msg; ?> </button>&nbsp;&nbsp;&nbsp;
                                    </div>
								</div>
								<?php if($logo == '' ): ?>
								<div class="col-lg-3 mt-4 mt-lg-0">
									<div class="d-flex justify-content-center mb-4">
										<div class="profile-image-outer-container">
											<div class="col-lg-10">
												<span class="img-thumbnail d-block">
													<img id="preview_mitra" class="img-fluid" src="../assets/frontend/img/blog/square/blog-4.jpg" alt="Project Image">
													<i class="fas fa-camera"></i> <?= $name_text_logo; ?>
												</span>
											</div>
											<input type="file" id="img_mitra" name="logo" class="profile-image-input">
										</div>
									</div>
								</div>
								<?php else: ?>
								<div class="col-lg-3 mt-4 mt-lg-0">
									<div class="d-flex justify-content-center mb-4">
										<div class="profile-image-outer-container">
											<div class="col-lg-10">
												<span class="img-thumbnail d-block">
													<img id="preview_mitra" class="img-fluid" src="<?= base_url('assets/file_upload/logo_mitra/'.$logo); ?>" alt="">
													<i class="fas fa-camera"></i> <?= $name_text_logo; ?>
												</span>
											</div>
											<input type="file" id="img_mitra" name="logo" class="profile-image-input">
										</div>
									</div>
								</div>
								<?php endif; ?>
							</div>
						</form>
	                </div>
	            </section>
	        </div>
	    </div>
	</div>
</div>