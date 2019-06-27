<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Indonesia Tourism eXchange</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="<?= base_url().ASSETS_FRONTEND_IMAGE; ?>favicon-itx.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="<?= base_url().ASSETS_FRONTEND_IMAGE; ?>logo_itx.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>animate/animate.min.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_CSS; ?>theme.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_CSS; ?>theme-elements.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_CSS; ?>theme-blog.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_CSS; ?>theme-shop.css">
		<!-- sweatalet -->
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_CSS; ?>sweetalert2.min.css">
		<!-- cdn select 2 -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>rs-plugin/css/settings.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>rs-plugin/css/layers.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>rs-plugin/css/navigation.css">
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>circle-flip-slideshow/css/component.css">
		
		<!-- Demo CSS -->
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_CSS; ?>skins/default.css"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?= base_url(). ASSETS_FRONTEND_CSS; ?>custom.css">

		<!-- Head Libs -->
		<script src="<?= base_url(). ASSETS_FRONTEND_VENDOR_CSS; ?>/modernizr/modernizr.min.js"></script>

	</head>
	<body>
		<div class="body">
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 45, 'stickySetTop': '-45px', 'stickyChangeLogo': true}">
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="<?= site_url(); ?>">
											<img alt="ITX" width="120" height="92" data-sticky-width="82" data-sticky-height="63" data-sticky-top="37" src="<?= base_url().ASSETS_FRONTEND_IMAGE; ?>itx-logo.png">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row pt-3">
									<div class="header-nav-features">
										<div class="header-nav-feature header-nav-features-cart d-inline-flex ml-2">
										</div>
									</div>
								</div>
								<div class="header-row">
									<div class="header-nav pt-1">
										<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
											<?php if ( !$this->ion_auth->logged_in() || ($this->ion_auth->is_admin()) ) : ?>
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown dropdown-mega">
														<a class="dropdown-item dropdown-toggle" href="#">
															SELLER
														</a>
														<ul class="dropdown-menu">
															<li>
																<div class="dropdown-mega-content">
																	<div class="row">
																		<div class="col-md-4">
	                                                                        <p>Corporate that buys large quantity of goods from various suppliers, and reseller to retailers. Corporate who aggregates one or more suppliers under their corporation.</p>
	                                                                    </div>
																		
	                                                                    <div class="col-md-4">
	                                                                        <strong>Benefits:</strong>
	                                                                        <ul class="list list-icons">
	                                                                            <li><i class="fa fa-check"></i> Many connections to travel agent</li>
	                                                                            <li><i class="fa fa-check"></i>  No subscription or transaction fee, it’s absolutely free</li>
	                                                                            <li><i class="fa fa-check"></i> 24 / 7 online support</li>
	                                                                            <li><i class="fa fa-check"></i> Easy to use</li>
	                                                                        </ul>
	                                                                    </div>
																	</div>
																</div>
															</li>
														</ul>
													</li>
													<li class="dropdown dropdown-mega">
														<a class="dropdown-item dropdown-toggle" href="#">
															BUYER
														</a>
														<ul class="dropdown-menu">
															<li>
																<div class="dropdown-mega-content">
																	<div class="row">
																		<div class="col-md-4">
	                                                                        <p>A person or business who gives out or sells the T&T inventory that sold by the supplier to person or business as traveler. Accommodation, transportation, food and beverages, event and MICE,  Corporate Travel Management</p>
	                                                                    </div>
																		
	                                                                    <div class="col-md-4">
	                                                                        <strong>Benefits:</strong>
	                                                                        <ul class="list list-icons">
	                                                                            <li><i class="fa fa-check"></i> Many connections to seller</li>
	                                                                            <li><i class="fa fa-check"></i>  Choose from one or more seller for any products </li>
	                                                                            <li><i class="fa fa-check"></i> No subscription or transaction fee, it’s absolutely free</li>
	                                                                            <li><i class="fa fa-check"></i> 24 / 7 online support</li>
	                                                                            <li><i class="fa fa-check"></i> Easy to use</li>
	                                                                        </ul>
	                                                                    </div>
	                                                                    <div class="col-md-4">
	                                                                        <strong>Features:</strong>
	                                                                        <ul class="list list-icons">
	                                                                            <li><i class="fa fa-check"></i> Set your preferred seller of any products through our Seller Management capability</li>
	                                                                            <li><i class="fa fa-check"></i>  Monitor all of your transactions in a single dashboard </li>
	                                                                            <li><i class="fa fa-check"></i> API connection capability</li>
	                                                                        </ul>
	                                                                    </div>
	                                                                </div>
																</div>
															</li>
														</ul>
													</li>
													
													<li>
	                                                    <a  style="text-decoration: none;" href="<?= site_url('partner'); ?>">
	                                                        Partner
	                                                    </a>
	                                                </li>
	                                                <li>
	                                                    <a style="text-decoration: none;" href="<?= site_url('event-and-news'); ?>">
	                                                        Blog & News
	                                                    </a>
	                                                </li>
	                                                <li>
	                                                    <a style="text-decoration: none;" href="<?= site_url('about-us'); ?>">
	                                                        About Us
	                                                    </a>
	                                                </li>

	                                                <li>
	                                                    <a style="text-decoration: none;" href="<?= site_url(); ?>contact-us">
	                                                        Contact Us
	                                                    </a>
	                                                </li>
	                                                <li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="#">
															Member
														</a>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="<?= site_url('login'); ?>">Login </a></li>
															<li><a class="dropdown-item" href="<?= site_url('member/register'); ?>">Register</a></li>
														</ul>
													</li>
												</ul>
											</nav>
											<?php else: ?>
												<?php 
													$member = $this->ion_auth->user()->row();
													$username = ($member->username) ? $member->username : "";
												?>
												<nav class="collapse">
													<ul class="nav nav-pills" id="mainNav">
														<li class="dropdown">
															<a class="dropdown-item dropdown-toggle" href="#">
																My Request
															</a>
															<ul class="dropdown-menu">
																<li>
																	<a class="dropdown-item" href="<?= site_url('member/myrequest'); ?>">
																		Seller/Buyer 
																	</a>
																</li>
																<li>
																	<a class="dropdown-item" href="<?= site_url('member'); ?>">
																		Data Analytic
																	</a>
																</li>
																<li>
																	<a class="dropdown-item" href="<?= site_url('member'); ?>">
																		Resource
																	</a>
																</li>
															</ul>
														</li>
													</ul>
												</nav>
											<?php endif; ?>
										</div>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
										<?php if ( !$this->ion_auth->logged_in() || ($this->ion_auth->is_admin()) ) : ?>
										<?php else: ?>
										<?php 
											$member = $this->ion_auth->user()->row();
											$username = ($member->username) ? $member->username : "";
										?>
										<div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
											<div class="header-nav-feature header-nav-features-user header-nav-features-user-logged d-inline-flex mx-2 pr-2" id="headerAccount">
												<a href="#" class="header-nav-features-toggle">
													<i class="far fa-user"></i> <?= $username; ?>
												</a>
												<div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right" id="headerTopUserDropdown">
													<div class="row">
														<div class="col-8">
															<p class="mb-0 pb-0 text-2 line-height-1 pt-1">Hello,</p>
															<p><strong class="text-color-dark text-4"><?= $username; ?></strong></p>
														</div>
														<div class="col-4">
															<?php if($member->img_thum != ''): ?>
															<div class="d-flex justify-content-end">
																<img class="rounded-circle" width="40" height="40" alt="" src="<?= base_url('assets/images/profile/'.$member->img_thum); ?>">
															</div>
															<?php else: ?>
															<div class="d-flex justify-content-end">
																<img class="rounded-circle" width="40" height="40" alt="" src="../assets/frontend/img/avatars/avatar.jpg">
															</div>
															<?php endif; ?>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<ul class="nav nav-list-simple flex-column text-3">
																<li class="nav-item"><a class="nav-link" href="<?= site_url('member/personal-data'); ?>">My Profile</a></li>
																<li class="nav-item"><a class="nav-link border-bottom-0" href="<?= site_url('member/logout'); ?>">Log Out</a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div role="main" class="main">
				<section class="page-header page-header-classic" style="display: <?= (isset($is_breadcrumb)) ? $is_breadcrumb : ""; ?>;">
				    <div class="container">
				        <div class="row">
				            <div class="col">
				                <ul class="breadcrumb">
				                    <li><a href="<?= site_url(); ?>">Home</a></li>
				                    <li class="active"><?= (isset($breadcrumb)) ? $breadcrumb : ""; ?></li>
				                </ul>
				            </div>
				        </div>
				        <div class="row">
				            <div class="col p-static">
				                <h1 data-title-border><?= (isset($breadcrumb_child)) ? $breadcrumb_child : ""; ?></h1>
				            </div>
				        </div>
				    </div>
				</section>
				

				
 
			