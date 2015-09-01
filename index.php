<?php		

require_once('header.php');

// API call to fetch company list
$rest_url = SERVER_URL_PATH.'api/getCompanies';	
$curl = curl_init($rest_url);   
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);		
$curl_response = curl_exec($curl);
curl_close($curl);	
$data = json_decode($curl_response,1);	
	
?>
<style>
	#example_length{    margin-left: 10px;}
</style>
<h1>Company Management</h1>
<br/>	
<form id="companyList" role="form" action="" method="post">	
<div class="alert alert-success" style="display: none;"></div>
<div style="float:right; padding-bottom:10px"> <a class="btn btn-primary btn-xs" href="<?php echo SERVER_URL_PATH."add_company.php"; ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add Company</a></div>
	
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th>City</th>
			<th>Country</th>							
			<th align="center" style="text-align:center;" >Action</th>
		</tr>
	</thead>
	
	<?php if($data['success'] == 1){ ?>
		<tbody>	
		<?php 
			if(count($data['data']) > 0){ 
			foreach($data['data'] as $row){
		?>
			<tr>
				<td><?php echo $row['Name'] ?></td>								
				<td><?php echo $row['Address'] ?></td>								
				<td><?php echo $row['City'] ?></td>								
				<td><?php echo $row['County'] ?></td>																		
				<td align="center">
					<a title="View Company" class="btn btn-primary btn-xs" href="<?php echo SERVER_URL_PATH."view_company.php?id=".$row["CompanyID"]; ?>"><i class="glyphicon glyphicon-eye-open"></i></a>
					<a title="Edit Company" class="btn btn-primary btn-xs" href="<?php echo SERVER_URL_PATH."edit_company.php?id=".$row["CompanyID"]; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
					<a title="Delete Company" class="btn btn-primary btn-xs" href="javascript:void(0)" onclick="deleteRow('<?php echo $row["CompanyID"]; ?>')"><i class="glyphicon glyphicon-remove"></i></a>					
				</td>
			</tr>					
		<?php } } ?>
		</tbody>
		<script type="text/javascript" language="javascript" class="init">
			function deleteRow(id){
				if(confirm("Are you sure want to delete this row?")){
					$.ajax({
							type: "POST",
							url: "<?php echo SERVER_URL_PATH; ?>api/deleteCompany",
							data: {CompanyID : id},
							success: function(response){
									
									var json = JSON.stringify(response);
									var res = JSON.parse(json);
									//alert(res.success); return false;
									 if(res.success == "1"){									
										location.reload();
									 }else{
										$('#companyList').find('.alert').addClass("alert-danger"); 
										$('#companyList').find('.alert').html('There is some issue, please try again').show(); 
									 }
								 },
							error: function(){
								alert("failure");
							}
					});
				}
				return false;
			}
			$(document).ready(function() {
				 $('#example').DataTable( {
					"order": [[ 0, "asc" ]],
					"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4 ] } ],
					"dom": '<"pull-left"f><"pull-left"l>tip'
				} );
			} );
		</script>
	<?php } ?>
</table>
</form>
<?php require_once("footer.php"); ?>				