<?php 
	$id 			= (isset($dokumen['id'])) ? $dokumen['id'] : "";
	$scan_ktp 		= (isset($dokumen['scan_ktp'])) ? $dokumen['scan_ktp'] : "";
	$scan_selfie 	= (isset($dokumen['scan_selfie'])) ? $dokumen['scan_selfie'] : "";
	$scan_npwp 		= (isset($dokumen['scan_npwp'])) ? $dokumen['scan_npwp'] : "";
	$scan_siup 		= (isset($dokumen['scan_siup'])) ? $dokumen['scan_siup'] : "";
	$scan_akta 		= (isset($dokumen['scan_akta'])) ? $dokumen['scan_akta'] : "";
	$scan_sk 		= (isset($dokumen['scan_sk'])) ? $dokumen['scan_sk'] : "";
?>
<div id="dokumen" class="tab-pane">
	<?= form_open_multipart('member/submit_dokumen',array('class' => 'form-horizontal','id' => 'forms_dokumen')) ?>
	   	<p>
	   		<input type="hidden" name="id" value="<?= $id; ?>">
	   		<div class="container py-2">
				<div class="row">
					<div class="col">
						<div class="row">
							<div class="col pb-3">
								<h4>Dokumen</h4>
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>File</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Scan KTP</td>
											<td style="text-align: center;">
												<label id="ktpid"><?= ($dokumen['scan_ktp']) ? $dokumen['scan_ktp']  : 'No File'; ?></label>
											</td>
											<td></td>
											<td>
												<?php if($dokumen['scan_ktp'] != '') : ?>
													<button id="ktp" class="btn btn-success"><i class="fa fa-upload"></i> 
														Update
													</button>
												<?php else: ?>
													<button id="ktp" class="btn btn-success"><i class="fa fa-upload"></i>
														Upload
													</button>
												<?php endif; ?>
												<input type="file" id="scktp" name="scktp" style="display:none;" >
											</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Scan Selfie KTP</td>
											<td style="text-align: center;">
												<label id="selfieid"><?= ($dokumen['scan_selfie']) ? $dokumen['scan_selfie']  : 'No File'; ?></label>
											</td>
											<td></td>
											<td>
												<?php if($dokumen['scan_selfie'] != '') : ?>
													<button id="selfie" class="btn btn-success"><i class="fa fa-upload"></i> 
														Update
													</button>
												<?php else: ?>
													<button id="selfie" class="btn btn-success"><i class="fa fa-upload"></i>
														Upload
													</button>
												<?php endif; ?>
												<input type="file" id="scselfie" name="scselfie" style="display:none;" >
											</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Scan NPWP</td>
											<td style="text-align: center;">
												<label id="npwpid"><?= ($dokumen['scan_npwp']) ? $dokumen['scan_npwp']  : 'No File'; ?></label>
											</td>
											<td></td>
											<td>
												<?php if($dokumen['scan_npwp'] != '') : ?>
													<button id="npwp" class="btn btn-success"><i class="fa fa-upload"></i> 
														Update
													</button>
												<?php else: ?>
													<button id="npwp" class="btn btn-success"><i class="fa fa-upload"></i>
														Upload
													</button>
												<?php endif; ?>
												<input type="file" id="scnpwp" name="scnpwp" style="display:none;" >
											</td>
										</tr>
										<tr>
											<td>4</td>
											<td>Scan SIUP/TDP</td>
											<td style="text-align: center;">
												<label id="siupid"><?= ($dokumen['scan_siup']) ? $dokumen['scan_siup']  : 'No File'; ?></label>
											</td>
											<td></td>
											<td>
												<?php if($dokumen['scan_siup'] != '') : ?>
													<button id="siup" class="btn btn-success"><i class="fa fa-upload"></i> 
														Update
													</button>
												<?php else: ?>
													<button id="siup" class="btn btn-success"><i class="fa fa-upload"></i>
														Upload
													</button>
												<?php endif; ?>
												<input type="file" id="scsiup" name="scsiup" style="display:none;" >
											</td>
										</tr>
										<tr>
											<td>5</td>
											<td>Scan Akta Perusahaan</td>
											<td style="text-align: center;">
												<label id="aktaid"><?= ($dokumen['scan_akta']) ? $dokumen['scan_akta']  : 'No File'; ?></label>
											</td>
											<td></td>
											<td>
												<?php if($dokumen['scan_akta'] != '') : ?>
													<button id="akta" class="btn btn-success"><i class="fa fa-upload"></i> 
														Update
													</button>
												<?php else: ?>
													<button id="akta" class="btn btn-success"><i class="fa fa-upload"></i>
														Upload
													</button>
												<?php endif; ?>
												<input type="file" id="scakta" name="scakta" style="display:none;" >
											</td>
										</tr>
										<tr>
											<td>6</td>
											<td>Scan Surat Kuasa (bila diwakilkan)</td>
											<td style="text-align: center;">
												<label id="skid"><?= ($dokumen['scan_sk']) ? $dokumen['scan_sk']  : 'No File'; ?></label>
											</td>
											<td></td>
											<td>
												<?php if($dokumen['scan_sk'] != '') : ?>
													<button id="sk" class="btn btn-success"><i class="fa fa-upload"></i> 
														Update
													</button>
												<?php else: ?>
													<button id="sk" class="btn btn-success"><i class="fa fa-upload"></i>
														Upload
													</button>
												<?php endif; ?>
												<input type="file" id="scsk" name="scsk" style="display:none;" >
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
						<button class="btn btn-primary btn-submit-dokumen"><i class="fa fa-save"></i> Submit</button>
					</div>
				</div>
			</div>
	   	</p>
	<?= form_close(); ?>
</div>