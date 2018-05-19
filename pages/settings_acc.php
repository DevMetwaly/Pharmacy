<script>
window.onload = function(){	
	function fillCrrInfo(){
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
		var FName 	= $('#FName').val();
		var LName	= $('#LName').val();
		var Address	= $('#Address').val();
		var Phone 	= $('#Phone').val();
		var UserName= $('#UserName').val();
		var CrrPass = $('#CrrPass').val();
		var ConfPass= $('#ConfPass').val();
		var NewPass = $('#NewPass').val();
		Send("./php/AccSettings.php?action=check","POST",function(data){
			if(data.type=='Fail'){
				popUp(0,data.msg);
				
			}
			else{
				if(ConfPass==NewPass){
					Send("./php/AccSettings.php?action=update","POST",function(data){
						
						if(data.type=='Fail'){
							popUp(0,data.msg);
						}
						else{
							popUp(1,data.msg);
						}
					},"Fname="+Fname+"&LName="+LName+"&Address="+Address+"&Phone="+Phone+"&UserName="+UserName+"&NewPass="+NewPass);

				}
				else{
					popUp(0,"Confirmed password doesn't match New password");
				}


			}



		},"CrrPass="+CrrPass);


	});


	$( "#UpdateInfo" ).on( "reset", function( event ) {
		event.preventDefault();	
		fillUpdateInfo();
	});



	fillCrrInfo();
	fillUpdateInfo();
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
									<form id="UpdateInfo">
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
											<input id="NewPass" class="form-control" minlength="5" placeholder="Leave empty to not update" required>
										</div>
										<div class="form-group">
											<label>Confirm Password</label>
											<input id="ConfPass" class="form-control" minlength="5" placeholder="Leave empty to not update" required>
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
