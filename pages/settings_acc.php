<script>
window.onload = function(){	
	function fillCrrInfo(){
		Send("./php/AccSettings.php?action=info","POST",function(data){

			$('#IName').text(data.FName+' '+data.LName);
			$('#IMobile').text(data.Phone);
			$('#IAddress').text(data.Address);
			$('#IImg').attr("src",data.Image);
			new Date().getTime();//cachebreaker 
		},"");
	}
	
	function fillUpdateInfo(){
		Send("./php/AccSettings.php?action=info","POST",function(data){
			$('#FName').val(data.FName);
			$('#LName').val(data.LName);
			$('#Address').val(data.Address);
			$('#Phone').val(data.Phone);
			$('#UserName').val(data.User_Name);
			$('#CrrPass').val();
			$('#ConfPass').val();
			$('#NewPass').val();
		},"");
	}
	
	$( "#UpdateInfo" ).on( "submit", function( event ) {
		event.preventDefault();	
		    var formData = new FormData(this);
	
		SendFile("./php/AccSettings.php?action=update","POST",function(data){
			if(data.type=='Success'){
				$('#IImg').attr('src', $('#IImg')
				.attr('src') + '?' + Math.random() );
				$('#Ppf').attr('src', $('#Ppf')
				.attr('src') + '?' + Math.random() );
				popUp(1,data.msg);
				fillUpdateInfo();
			}else
				popUp(0,data.msg);
		},formData);


	});


	$( "#UpdateInfo" ).on( "reset", function( event ) {
		event.preventDefault();	
		fillUpdateInfo();
	});


	
	
	fillCrrInfo();
	fillUpdateInfo();
	
	var password = document.getElementById("NewPass")
	  , confirm_password = document.getElementById("ConfPass");

	function validatePassword(){

	  if(password.value != confirm_password.value) {

		confirm_password.setCustomValidity("Passwords don't match!");
	  } else {
		confirm_password.setCustomValidity('');
	  }
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
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
									<form id="UpdateInfo" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label>First Name</label>
											<input type="text" id="FName" name="FName" class="form-control" placeholder="Leave empty to not update" pattern="^[a-zA-Z]{1,25}">
										</div>
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" id="LName" name="LName" class="form-control" placeholder="Leave empty to not update" pattern="^[a-zA-Z]{1,25}">
										</div>
										<div class="form-group">
											<label>Address</label>
											<input type="text" id="Address" name="Address" class="form-control" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Phone</label>
											<input type="text" id="Phone" name="Phone" class="form-control" minLength=7 maxLength=15 pattern="[0-9]+" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Current Password</label>
											<input type="password" id="CrrPass" name="CrrPass" class="form-control" minlength="5" placeholder="Must enter to update" required>
										</div>
										<div class="form-group">
											<label>New Password</label>
											<input type="password" id="NewPass" name="NewPass" class="form-control" minlength="5" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" id="ConfPass" name="ConfPass" class="form-control" minlength="5" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Upload Image</label>
											<input class="form-control" type="file" id="Pic" name="Pic" accept="image/*">
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
