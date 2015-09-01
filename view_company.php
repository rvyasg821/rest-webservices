<?php

require_once('header.php');

$ComapnyID = $_GET['id'];
$rest_url = SERVER_URL_PATH.'api/getCompany';	
$post_data = array("CompanyID" => $ComapnyID);
$curl = curl_init($rest_url);   
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);	
$curl_response = curl_exec($curl);
curl_close($curl);	
$data = json_decode($curl_response,1);
//echo "<pre>"; print_r($data['data']['Directors']); exit;

?>

	<h1>View Company</h1>				
	<br/>								
	<form id="editcompany" role="form" action="" method="post">
	<div class="col-md-6">
	<div class="alert alert-success" style="display: none;"></div>
	<input type="hidden" id="ComapnyID" name="ComapnyID" value="<?php echo $ComapnyID; ?>" class="form-control">	
	  <div class="box-body">
		<div class="form-group">
		  <label for="Name">Name</label>
		  <input type="text" id="Name" name="Name" value="<?php echo $data["data"]["Name"]; ?>" readonly="readonly" class="form-control">
		</div>
		<div class="form-group">
		  <label for="Address">Address</label>
		  <input type="text"  id="Address" name="Address" value="<?php echo $data["data"]["Address"]; ?>" readonly="readonly" class="form-control">
		</div>                   
		<div class="form-group">
		  <label for="City">City</label>
		  <input type="text" id="City" name="City" value="<?php echo $data["data"]["City"]; ?>" readonly="readonly" class="form-control">
		</div>
		<div class="form-group">
		  <label for="County">Country</label>
		  <input type="text" id="County" name="County" value="<?php echo $data["data"]["County"]; ?>" readonly="readonly" class="form-control">
		</div>
		<div class="form-group">
		  <label for="Email">Email</label>
		  <input type="text" id="Email" name="Email" value="<?php echo $data["data"]["Email"]; ?>" readonly="readonly" class="form-control">
		</div>
		<div class="form-group">
		  <label for="Phone">Phone</label>
		  <input type="text" id="Phone" name="Phone" value="<?php echo $data["data"]["Phone"]; ?>" readonly="readonly" class="form-control">
		</div>
	  </div><!-- /.box-body -->

		<div class="box-footer">			
			<a class="btn btn-primary" href="<?php echo SERVER_URL_PATH; ?>">Cancel</a>                 
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-12">
			<h3>Directors and Beneficial owners </h3>
			<ol id="listDir" style="padding:20px;">
				<?php foreach($data['data']['Directors'] as $Director) { ?>
				<li>
					<?php echo $Director['Name']; ?><input type="hidden" name="Directors[]" value="<?php echo $Director['Name']; ?>" >
				</li>
				<?php } ?>
			</ol>
		</div>							
	</div>
</form>
<?php require_once('footer.php'); ?>