<script>
window.onload = function(){	
	function fillData(){
		Send("./php/AccSettings.php?action=info","POST",function(data){

			$('#IName').text(data.FName+' '+data.LName);
			$('#IMobile').text(data.Phone);
			$('#IAddress').text(data.Address);
			$('#IImg').attr("src",data.Image);

			$('#FName').val(data.FName);
			$('#LName').val(data.LName);
			$('#Address').val(data.Address);
			$('#Phone').val(data.Phone);
			$('#UserName').val(data.User_Name);
		},"");
	}

	$( "#AddEmpForm" ).on( "submit", function( event ) {
		event.preventDefault();	


	});


	fillData();
}
</script>




<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Account Settings</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		
		<div class="row">
		
			<div class="col-lg-6">
				<div class="panel panel-default">
				
						<div class="panel-heading">
							Current Info
						</div>

						<div class="panel-body">

							<div class="row">
								<div class="col-lg-12">
									
									<h5><b>Name</b></h5> 
										<h4 id="IName"></h4>
										
									<h5><b>Phone</b></h5> 
										<h4 id="IMobile"></h4>
										
									<h5><b>Address</b></h5> 
										<h4 id="IAddress"></h4>
										
									<h5><b>Image</b></h5>
									<img id='IImg' src='' width="256px">
								</div>
							</div>

						</div>
						<!-- /.panel-body -->				
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-6 -->
			
			<div class="col-lg-6">
				<div class="panel panel-default">
				
						<div class="panel-heading">
							Update Info
						</div>

						<div class="panel-body">

							<div class="row">
								<div class="col-lg-12">
									<form>
										<div class="form-group">
											<label>First Name</label>
											<input id="FName" class="form-control" placeholder="Leave empty to not update" pattern="^[a-zA-Z]{1,25}">
										</div>
										<div class="form-group">
											<label>Last Name</label>
											<input id="LName" class="form-control" placeholder="Leave empty to not update" pattern="^[a-zA-Z]{1,25}">
										</div>
										<div class="form-group">
											<label>Address</label>
											<input id="Address" class="form-control" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Phone</label>
											<input id="Phone" class="form-control" minLength=7 maxLength=15 pattern="[0-9]+" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>User Name</label>
											<input id="UserName" class="form-control" placeholder="Leave empty to not update" pattern="^[a-zA-Z]{1,25}">
										</div>
										<div class="form-group">
											<label>Current Password</label>
											<input id="CrrPass" class="form-control" minlength="5" placeholder="Must enter to update" required>
										</div>
										<div class="form-group">
											<label>New Password</label>
											<input id="NewPass" class="form-control" minlength="5" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Upload Image</label>
											<input class="form-control" type="file" name="pic" accept="image/*">
										</div>
										<button type="submit" class="btn btn-default btn-success" onfocus="this.blur()">Save</button>
										<button type="reset" class="btn btn-default btn-warning">Reset</button>
									</form>
								</div>
							</div>

						</div>
						<!-- /.panel-body -->				
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-6 -->
			
			
		</div>
		<!-- /.row -->
		
		
	</div>
	<!-- /.container-fluid -->
</div>
