<script>
function Reset(){
	$('#Name').val('');
	$('#Phone').val('');
	$('#Location').val('');
	$('#Email').val('');
	
}

function AddSuplier(){
	var Name		= $('#Name').val();
	var Phone		= $('#Phone').val();
	var Location	= $('#Location').val();
	var Email		= $('#Email').val();

	Send("./php/Suppliers_ctrl.php","POST",function(data){

	},"Name="+Name+"&Phone="+Phone+"&Loc="+Location+"&Email="+Email);	
	Reset();
}



</script>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Suppliers Management</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add a new supplier
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								
								<div class="form-group">
									<label>Name</label>
									<input id="Name" class="form-control" placeholder="Enter name..">
								</div>
								<div class="form-group">
									<label>Address</label>
									<input id="Location" class="form-control" placeholder="Enter address..">
								</div>
								<div class="form-group">
									<label>Email Address</label>
									<input id="Email" class="form-control" placeholder="Enter email address..">
								</div>
								<div class="form-group">
									<label>Phone Numbers</label>
									<input id="Phone" class="form-control" placeholder="Ex: 1003004000, 555-111-999">
									<p>Separate multiple phone numbers by comma.</p>
								</div>
								<button type="submit" class="btn btn-default btn-success" onClick="AddSuplier()">Submit Button</button>
								<button type="reset" class="btn btn-default" onClick="Reset()">Reset Button</button>
							
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
						Modify an existing supplier
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								<form role="form">
									<label>Supplier</label>
									<div class="form-group">
										<select class="form-control">
											<option>Select supplier..</option>
											<option>GSK</option>
										</select>
									</div>
									<fieldset disabled>
										<div class="form-group">
											<label>Name</label>
											<input class="form-control" placeholder="Enter text">
										</div>
										<div class="form-group">
											<label>Address</label>
											<input class="form-control" placeholder="Enter text">
										</div>
										<div class="form-group">
											<label>Email Address</label>
											<input class="form-control" placeholder="Enter text">
										</div>
										<div class="form-group">
											<label>Phone Numbers</label>
											<input class="form-control" placeholder="Ex: 1003004000, 555-111-999">
											<p>Separate multiple phone numbers by comma.</p>
										</div>
										<button type="submit" class="btn btn-primary">Apply Changes</button>
										<button type="submit" class="btn btn-danger">Remove Supplier</button>
									</fieldset>
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
