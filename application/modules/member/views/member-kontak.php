<?php 
	$contact_id = (isset($contact['contact_id'])) ? $contact['contact_id'] : "";
	$name 		= (isset($contact['name'])) ? $contact['name'] : "";
	$email 		= (isset($contact['email'])) ? $contact['email'] : "";
	$phone 		= (isset($contact['phone'])) ? $contact['phone'] : "";
	$mobile 	= (isset($contact['mobile'])) ? $contact['mobile'] : "";
	$name_ops 	= (isset($contact['name_ops'])) ? $contact['name_ops'] : "";
	$email_ops 	= (isset($contact['email_ops'])) ? $contact['email_ops'] : "";
	$phone_ops 	= (isset($contact['phone_ops'])) ? $contact['phone_ops'] : "";
	$mobile_ops = (isset($contact['mobile_ops'])) ? $contact['mobile_ops'] : "";
?>
<div id="kontak_perwakilan" class="tab-pane">
	<?= form_open_multipart('member/submit_kontak',array('class' => 'form-horizontal','id' => 'forms_kontak')) ?>
	   	<p>
	   		<input type="hidden" name="id" value="<?= $contact_id; ?>">
	   		<div class="container py-2">
				<div class="row">
					<div class="col">
						<div class="row">
							<div class="col pb-3">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Kontak Umum</th>
											<th>Kontak Operasional</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Nama<span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="name" id="name" type="text" placeholder="Nama" value="<?= $name; ?>">
						                            </div>
						                        </div> 
											</td>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Nama <span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="name_ops" id="name_ops" type="text" placeholder="Nama" value="<?= $name_ops; ?>">
						                            </div>
						                        </div> 
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Email <span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="email" id="email" type="text" placeholder="Email" value="<?= $email; ?>">
						                            </div>
						                        </div> 
											</td>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Email <span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="email_ops" id="email_ops" type="text" placeholder="Email" value="<?= $email_ops; ?>">
						                            </div>
						                        </div> 
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">No. Tlp <span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="phone" id="phone" type="text" placeholder="No. Tlp" value="<?= $phone; ?>">
						                            </div>
						                        </div> 
											</td>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">No. Tlp <span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="phone_ops" id="phone_ops" type="text" placeholder="No. Tlp" value="<?= $phone_ops; ?>">
						                            </div>
						                        </div> 
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">No. HP <span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="mobile" id="mobile" type="text" placeholder="No. HP" value="<?= $mobile; ?>">
						                            </div>
						                        </div> 
											</td>
											<td>
												<div class="form-group row">
						                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">No. HP <span class="wajib">*</span></label>
						                            <div class="col-lg-9">
						                                <input class="form-control" name="mobile_ops" id="mobile_ops" type="text" placeholder="No. HP" value="<?= $mobile_ops; ?>">
						                            </div>
						                        </div> 
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-row">
						<button class="btn btn-primary btn-submit-kontak"><i class="fa fa-save"></i> Submit</button>
					</div>
				</div>
			</div>
	   	</p>
	<?= form_close(); ?>
</div>