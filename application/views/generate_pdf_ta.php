<!DOCTYPE html>
<html>
<head>
	<title>WHITE LABEL</title>
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
	            <center>Personal Informasi</center>
	        </div>
        </div>
        <?php //print_r($ip_whitelist);die(); ?>
	  	<table class="table table-bordered">
	  		<tr>
	  			<th style="width: 200px;">First Name</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= $travel_agent['first_name']; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Last Name</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['last_name']) ? $travel_agent['last_name'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Gender</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['gender']) ? $travel_agent['gender'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Birth Date</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['birth_date']) ? $travel_agent['birth_date'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Email </th>
	  			<th>
	  				<input name="" class="form-control" value="<?= ($travel_agent['email']) ?  $travel_agent['email'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Phone </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['phone']) ? $travel_agent['phone'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">NIK </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['nik']) ? $travel_agent['nik'] : ""; ?>">
	  			</th>
	  		</tr>
	  	</table>

	  	<div class="panel-heading">
            <div class="panel-title">
	            <center>Mitra Information</center>
	        </div>
        </div>
        <?php //print_r($ip_whitelist);die(); ?>
	  	<table class="table table-bordered">
	  		<tr>
	  			<th style="width: 200px;">Mitra Name</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['mitra_name']) ? $travel_agent['mitra_name'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Owner</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['owner']) ? $travel_agent['owner'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">No. Telp</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['phone_no']) ? $travel_agent['phone_no'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">No. Hp</th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['mobile_no']) ? $travel_agent['mobile_no'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Email </th>
	  			<th>
	  				<input name="" class="form-control" value="<?= ($travel_agent['email_mitra']) ? $travel_agent['email_mitra'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Website </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['website']) ? $travel_agent['website'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Provinsi </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['province']) ? $travel_agent['province'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Kota </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['city']) ? $travel_agent['city'] : ""; ?>">
	  			</th>
	  		</tr>
	  		<tr>
	  			<th style="width: 200px;">Address </th>
	  			<th>
	  				<input type="text" class="form-control" name="" value="<?= ($travel_agent['address']) ? $travel_agent['address'] : ""; ?>">
	  			</th>
	  		</tr>
	  	</table>
	  	
	  	<table class="table">
	  		<tr>
	  			<th style="width: 50%"><center>ITX</center></th>
	  			<th style="width: 50%"><center><?= ($travel_agent['mitra_name']) ? $travel_agent['mitra_name'] : ""; ?></center></th>
	  		</tr>
	  	</table>
	  	<table class="table" style="margin-top: 70px;">
	  		<tr>
	  			<th style="width: 50%"><p style="margin-left: 100px;">Jeami Gumilarsjah</p></th>
	  			<th style="width: 50%"><center><?= ($travel_agent['owner']) ? $travel_agent['owner'] : ""; ?></center></th>
	  		</tr>
	  		<tr>
	  			<th><center>Director</center></th>
	  			<th><center>Director</center></th>
	  		</tr>
	  	</table>
	</div>

</body>
</html>