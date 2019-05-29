<!DOCTYPE html>
<html>
<head>
	<title>IP WHITELIST</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container" style="margin-top: 50px;">
		<div class="panel-heading">
            <div class="panel-title">
	            <center>IP Registration Form</center>
	        </div>
        </div>
        <?php 
        	// print_r($ip_whitelist['ip_dev_1']);die;
        	// data
        	$ip_address_1 	=  (!empty($ip_whitelist['ip_dev_1'])) ? $ip_whitelist['ip_dev_1'] : ""; 
        	$ip_address_2 	=  (!empty($ip_whitelist['ip_dev_2'])) ? $ip_whitelist['ip_dev_2'] : ""; 
        	$ip_production 	=  (!empty($ip_whitelist['ip_production'])) ? $ip_whitelist['ip_production'] : ""; 
        	$protocols      =  (!empty($ip_whitelist['protocols'])) ? $ip_whitelist['protocols'] : ""; 
        	$ports      	=  (!empty($ip_whitelist['ports'])) ? $ip_whitelist['ports'] : ""; 
        	$remark 		=  (!empty($ip_whitelist['remark'])) ? $ip_whitelist['remark'] : "";
        	$change_request =  (!empty($ip_whitelist['change_request'])) ? $ip_whitelist['change_request'] : "";
        	$mitra_name  	=  (!empty($ip_whitelist['mitra_name'])) ? $ip_whitelist['mitra_name'] : "";
        	$temp_start_date =  (!empty($ip_whitelist['temp_start_date'])) ? $ip_whitelist['temp_start_date'] : "";
        	$temp_end_date   =  (!empty($ip_whitelist['temp_end_date'])) ? $ip_whitelist['temp_end_date'] : "";
        ?>
	  	<table class="table table-bordered">
	  		<tr>
	  			<th style="width: 40px;">Development IP Address (1)</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $ip_address_1; ?>">
	  			</th>
	  		</tr>
	  		<?php if(!empty($ip_address_2)) : ?>
	  		<tr>
	  			<th style="width: 40px;">Development IP Address (2)</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $ip_address_2; ?>">
	  			</th>
	  		</tr>
		  	<?php endif; ?>
	  		<tr>
	  			<th style="width: 40px;">Production IP Address</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $ip_production; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 40px;">Protocols</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $protocols; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 40px;">Ports</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $ports; ?> ">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 40px;">Any others related information </th>
	  			<th>
	  				<input name="" class="form-control" value="<?= $remark; ?>">
	  			</th>
	  		</tr>
	  		<?php 
	  			$is_permanent = ($change_request == 1) ? 'Permanent' : 'Temporary';
	  		?>
	  		<tr>
	  			<th style="width: 40px;">Permanent/Temporary </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $is_permanent; ?>">
	  			</th>
	  		</tr>
	  		<?php if($ip_whitelist['change_request'] == 2) : ?>
	  		<tr>
	  			<th style="width: 40px;">Start Date </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $temp_start_date; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 40px;">End Date </th>
	  			<th><input type="text" class="form-control" name="" value="<?= $temp_end_date; ?>"></th>
	  		</tr>
		  	<?php endif; ?>
	  	</table>
	  	<table class="table">
	  		<tr>
	  			<th style="width: 50%"><center>ITX</center></th>
	  			<th style="width: 50%"><center><?php echo $mitra_name; ?></center></th>
	  		</tr>
	  	</table>
	  	<table class="table" style="margin-top: 90px;">
	  		<tr>
	  			<th style="width: 50%"><p style="margin-left: 100px;">Jeami Gumilarsjah</p></th>
	  			<th style="width: 50%"><center><?= $ip_whitelist['first_name']." ".$ip_whitelist['last_name'] ?></center></th>
	  		</tr>
	  		<tr>
	  			<th><center>Director</center></th>
	  			<th><center>Director</center></th>
	  		</tr>
	  	</table>
	</div>
</body>
</html>