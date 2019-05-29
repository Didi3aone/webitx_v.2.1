<div id="personal_data" class="tab-pane">
    <div class="container">
	    <div class="row">
	        <div class="col">
	            <section class="card card-admin">
	                <header class="card-header">
	                    <div class="card-actions">
	                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
	                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
	                    </div>
	                    <h2 class="card-title">Personal Data</h2>
	                </header>
	                <div class="card-body">
	            		<form class="form-horizontal" id="forms_profile" method="POST" action="<?php echo site_url('member/submit_profile') ?>" enctype="multipart/form-data">
	            			<input type="hidden" name="id" value="<?= $profile['id']; ?>">
		                	<div class="row">
		                		<?php if($profile['img_thum']): ?>
								<div class="col-lg-3 mt-4 mt-lg-0">
									<div class="d-flex justify-content-center mb-4">
										<div class="profile-image-outer-container">
											<div class="profile-image-inner-container bg-color-primary">
												<img id="preview" src="<?= base_url('assets/images/profile/'.$profile['img_thum']); ?>">
												<span class="profile-image-button bg-color-dark">
													<i class="fas fa-camera text-light"></i>
												</span>
											</div>
											<input type="file" id="imgInp" name="img_thum" class="profile-image-input">
										</div>
									</div>
									<!-- <p>klik image for change image profile</p> -->
								</div>
								<?php else: ?>
								<div class="col-lg-3 mt-4 mt-lg-0">
									<div class="d-flex justify-content-center mb-4">
										<div class="profile-image-outer-container">
											<div class="profile-image-inner-container bg-color-primary">
												<img id="preview" src="../assets/frontend/img/avatars/avatar.jpg">
												<span class="profile-image-button bg-color-dark">
													<i class="fas fa-camera text-light"></i>
												</span>
											</div>
											<input type="file" id="imgInp" name="img_thum" class="profile-image-input">
										</div>
									</div>
								</div>
								<?php endif; ?>
								<div class="col-lg-9">
			                    	<div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Username </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" name="username" id="username" type="text" placeholder="Username" value="<?php echo $profile['username']; ?>" readonly>
			                            </div>
			                        </div>  
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">First name </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" name="first_name" id="first_name" type="text" placeholder="First name" value="<?php echo $profile['first_name']; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Last name </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" name="last_name" id="last_name"type="text" placeholder="Last name" value="<?php echo $profile['last_name']; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Gender </label>
			                            <div class="col-lg-9">
			                                <select name="gender" id="gender" class="form-control">
			                                	<?php $selected = $profile['gender']; ?>
			                                    <option value="Male" <?= ($selected == 'Male') ? 'selected' : '' ?>>
			                                    	Male
			                                    </option>
			                                    <option value="Female" <?= ($selected == 'Female') ? 'selected' : '' ?>>
			                                    	Female
			                                    </option>
			                                </select>
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Birth Date </label>
			                            <div class="col-lg-9">
			                                <input class="form-control datepicker" id="birth_date" name="birth_date" type="text" placeholder="Birth Date" value="<?php echo $profile['birth_date']; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Email </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" id="email" name="email" type="email" placeholder="email@gmail.com" value="<?php echo $profile['email']; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Phone </label>
			                            <div class="col-lg-9">
			                                <input class="form-control" id="phone" name="phone" type="text" placeholder="Phone" value="<?php echo $profile['phone']; ?>">
			                            </div>
			                        </div>
			                        <div class="form-group row">
			                            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">NIK </label>
			                            <div class="col-lg-9">
			                                <input class="form-control"  name="nik" id="nik" type="text" placeholder="NIK" value="<?php echo $profile['nik']; ?>">
			                            </div>
			                        </div>
			                        <div class="form-row">
                                        <button type="submit" class="btn btn-primary btn-submit btn-modern pull-right" data-loading-text="Loading..."> Update Data </button>&nbsp;&nbsp;&nbsp;
			                            <button type="button" class="btn btn-modern btn-success" data-toggle="modal" data-target="#formModal">
											Change Password
										</button>
                                    </div>
								</div>
							</div>
						</form>
	                </div>
	            </section>
	        </div>
	    </div>
	</div>
</div>

<div class="col-sm-9">
	<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="formModalLabel">Form Change Password</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form id="change_pass_form" class="form-horizontal" action="<?= site_url('member/change_password'); ?>" enctype="multipart/form-data" method="POST">
					<div class="modal-body">
						<div class="form-group row align-items-center">
							<label class="col-sm-3 text-left text-sm-right mb-0">Old Password</label>
							<div class="col-sm-9">
								<input type="password" name="oldpass" class="form-control" id="oldpass" placeholder="Old Password" required/>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-sm-3 text-left text-sm-right mb-0">New Password</label>
							<div class="col-sm-9">
								<input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password" required/>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-sm-3 text-left text-sm-right mb-0">Confirm New Password</label>
							<div class="col-sm-9">
								<input type="password" name="newconfirm" id="newconfirm" class="form-control" placeholder="Confirm New Password" />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-submits btn-primary">Save Changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>