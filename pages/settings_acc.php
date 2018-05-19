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
										<h4>Ahmed Bally</h4>
										
									<h5><b>Phone</b></h5> 
										<h4>01147364369</h4>
										
									<h5><b>Address</b></h5> 
										<h4>Mahala</h4>
										
									<h5><b>Image</b></h5>
									<img id='settings-image-preview' src='image\bally.png' width="256px">
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
											<input id="Name" class="form-control" placeholder="Leave empty to not update" pattern="^[a-zA-Z]{1,25}">
										</div>
										<div class="form-group">
											<label>Last Name</label>
											<input class="form-control" placeholder="Leave empty to not update" pattern="^[a-zA-Z]{1,25}">
										</div>
										<div class="form-group">
											<label>Address</label>
											<input class="form-control" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Phone</label>
											<input class="form-control" minLength=7 maxLength=15 pattern="[0-9]+" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Current Password</label>
											<input class="form-control" minlength="5" placeholder="Must enter to update" required>
										</div>
										<div class="form-group">
											<label>New Password</label>
											<input class="form-control" minlength="5" placeholder="Leave empty to not update">
										</div>
										<div class="form-group">
											<label>Upload Image</label>
											<input class="form-control" type="file" name="pic" accept="image/*">
										</div>
										<button type="submit" class="btn btn-default btn-success" onfocus="this.blur()">Save</button>
										<button type="submit" class="btn btn-default btn-warning">Reset</button>
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
