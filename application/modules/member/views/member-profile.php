<div class="container py-2" style="box-shadow:0px 20px 20px -5px #9c9c9c; margin-top: 30px">
	<div class="row">
		<div class="col">
			<h4>Account Role</h4>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="tabs" id="account_tabs">
				<ul class="nav nav-tabs">
					<li class="nav-item active">
						<a class="nav-link" href="#account_role" data-toggle="tab">Account Role</a>
					</li>&nbsp;
					<li class="nav-item">
						<a class="nav-link" href="#personal_data" data-toggle="tab">Personal Data</a>
					</li>&nbsp;
					<li class="nav-item">
						<a class="nav-link" href="#dokumen" data-toggle="tab">Dokumen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
					</li>&nbsp;
					<li class="nav-item">
						<a class="nav-link" href="#info_mitra" data-toggle="tab">Info Mitra&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
					</li>&nbsp;
					<li class="nav-item">
						<a class="nav-link" href="#kontak_perwakilan" data-toggle="tab">Kontak Perwakilan</a>
					</li>&nbsp;
					<li class="nav-item">
						<a class="nav-link" href="#rekening_bank" data-toggle="tab">Rekening Bank</a>
					</li>
				</ul>
				<div class="tab-content">
					<?php $this->load->view('member/member-account-role'); ?>
					<?php $this->load->view('member/member-personal-data'); ?>
					<?php $this->load->view('member/member-dokumen'); ?>
					<?php $this->load->view('member/member-info-mitra'); ?>
					<?php $this->load->view('member/member-kontak'); ?>
					<?php $this->load->view('member/member-rekening'); ?>
				</div>
			</div>
		</div>
	</div>
</div>