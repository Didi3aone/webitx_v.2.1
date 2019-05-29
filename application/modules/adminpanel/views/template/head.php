<!DOCTYPE html>
<html lang="en" ng-app="App">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="shortcut icon" href="" type="image/png"> -->

	<title>Admin Panel</title>

	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/favicon/').$MasterGeneral->favicon?>" />

	<link href="<?=base_url('assets/adminpanel/css/style.default.css')?>" rel="stylesheet" />

	<link href="<?=base_url('assets/adminpanel/css/jquery.datatables.css')?>" rel="stylesheet" />

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" />

	<link href="<?=base_url('assets/adminpanel/css/bootstrap-fileupload.min.css')?>" rel="stylesheet" />
	<link href="<?=base_url('assets/adminpanel/css/bootstrap-timepicker.min.css')?>" rel="stylesheet" />
	<link href="<?=base_url('assets/adminpanel/css/jquery-confirm.min.css')?>" rel="stylesheet" />
	<link href="<?=base_url('assets/adminpanel/css/jquery.tagsinput.css')?>" rel="stylesheet" />
	<link href="<?=base_url('assets/adminpanel/css/colorpicker.css')?>" rel="stylesheet" />
	<link href="<?=base_url('assets/adminpanel/css/dropzone.css')?>" rel="stylesheet" />
	<link href="<?=base_url('assets/adminpanel/css/jquery.mCustomScrollbar.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/sweetalert2.min.css')?>"rel="stylesheet" type="text/css" >

	<script type='text/javascript' src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script type='text/javascript' src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>

	
    <script type='text/javascript' src="<?=base_url('assets/lib/plugins/angular-1.6.9/angular.min.js')?>"></script>
    <script type='text/javascript' src="<?=base_url('assets/lib/plugins/angular-1.6.9/angular-cookies.js')?>"></script>
    <script type='text/javascript' src="<?=base_url('assets/lib/plugins/angular-1.6.9/angular-route.js')?>"></script>
    
	<script type="text/javascript">
	    var adminUrl = "<?=base_url('adminpanel/')?>";
	</script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?=base_url('assets/adminpanel/js/html5shiv.js')?>"></script>
	<script src="<?=base_url('assets/adminpanel/js/respond.min.js')?>"></script>
	<![endif]-->

	<style type="text/css">
	    a.tooltipx {outline:none; }
	    a.tooltipx strong {line-height:30px;}
	    a.tooltipx:hover {text-decoration:none;} 
	    a.tooltipx span {
	        z-index:10;display:none; padding:5px 5px;
	        margin-top:-50px; 
	        margin-left:-50px;
	        /*width:300px; line-height:16px;*/
	    }
	    a.tooltipx:hover span{
	        display:inline; position:absolute; color:#111;
	        border:1px solid #DCA; background:#fffAF0;}
	    /*.calloutx {z-index:20;position:absolute;top:30px;border:0;left:-12px;}*/
	        
	    /*CSS3 extras*/
	    a.tooltipx span
	    {
	        border-radius:4px;
	        box-shadow: 5px 5px 8px #CCC;
	    }

	    .bold {
	    	font-weight:bold;
	    	background-color: #F5F5F5;
	    }

	    .bg-primary {
	    	padding-left: 10px;
	    }
	</style>

</head>
