<?php 

require_once('header.php'); 
?>

<h1>Add Company</h1>				
<br/>				
<form id="addcompany" role="form" action="" method="post">
	<div class="col-md-6" style="border-right:1px solid #e5e5e5;">				
		<div class="alert alert-success" style="display: none;"></div>
		<div class="box-body">
			<div class="form-group">
			  <label for="Name">Name</label>
			  <input type="Name" id="Name" name="Name" class="form-control">
			</div>
			<div class="form-group">
			  <label for="Address">Address</label>
			  <input type="text"  id="Address" name="Address" class="form-control">
			</div>                   
			<div class="form-group">
			  <label for="City">City</label>
			  <input type="text" id="City" name="City" class="form-control">
			</div>
			<div class="form-group">
			  <label for="County">Country</label>
			  <input type="text" id="County" name="County" class="form-control">
			</div>
			<div class="form-group">
			  <label for="Email">Email</label>
			  <input type="text" id="Email" name="Email" class="form-control">
			</div>
			<div class="form-group">
			  <label for="Phone">Phone</label>
			  <input type="text" id="Phone" name="Phone" class="form-control">
			</div>
		</div><!-- /.box-body -->

		<div class="box-footer">
			<button class="btn btn-primary" type="submit" id="validateBtn" >Add</button>
			<a class="btn btn-primary" href="<?php echo SERVER_URL_PATH; ?>">Cancel</a>	
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-12">
			<h3>Directors and Beneficial owners </h3>
			<ol id="listDir" style="padding:20px;">						
			</ol>
		</div>					
		<div class="col-md-6">						
			<div class="form-group">							
				<input type="text" placeholder="Enter Name" id="txtDirector" name="txtDirector" class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<button style="float:left;" class="btn btn-primary" type="button" id="addDirector" ><i class="glyphicon glyphicon-plus"></i></button>
		</div>
	</div>
</form>
<script>
	$(document).ready(function() { 
		$('#listDir').on('click', '.deleteLI', function(){
			$(this).parent().remove();
		});
		
		$('#addDirector').click(function() {
			var txtDir = $('#txtDirector').val();
			if(txtDir != ''){
				//alert(txtDir);
				$("#listDir").append('<li>'+txtDir+'<input type="hidden" name="Directors[]" value="'+txtDir+'" >&nbsp;&nbsp;<a class="deleteLI" style="color:red;" href="javascript:void(0)" ><i class="glyphicon glyphicon-remove"></i></a></li>');
				$('#txtDirector').val('');
			}
		});
		$('#addcompany').bootstrapValidator({
			live: 'disabled',
			submitHandler: function(validator, form, submitButton) {								
				// validator is the BootstrapValidator instance
				$.ajax({
						type: "POST",
						url: "<?php echo SERVER_URL_PATH; ?>api/createCompany",
						data: $('#addcompany').serialize(),
						success: function(response){
								
								var json = JSON.stringify(response);
								var res = JSON.parse(json);
								//alert(res.success); return false;
								 if(res.success == "1"){
									form.find('.alert').html('Company Add Successfully!').show(); 
									$('#addcompany').data('bootstrapValidator').resetForm(true);
									$('#listDir').empty();
									//$('#myModal').modal('hide');
									//location.reload();
								 }else{
									form.find('.alert').addClass("alert-danger"); 
									form.find('.alert').html('There is some issue, please fill required fields').show(); 
								 }
							 },
						error: function(){
							alert("failure");
						}
				});
			},
			fields: {
				Name: {
					validators: {
						notEmpty: {
							message: 'Company name cannot be empty'
						}
					}
				},
				
				Address: {
					validators: {
						notEmpty: {
							message: 'Company address cannot be empty'
						}
					}
				},
				City: {
					validators: {
						notEmpty: {
							message: 'City name cannot be empty'
						}
					}
				},
				Email: {
					validators: {
						emailAddress: {
							message: 'Enter valid email address'
						}
					}
				}
			}
		});
	});
</script>
<?php include_once('footer.php'); ?>		