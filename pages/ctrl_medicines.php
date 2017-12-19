<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Medicines Management</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add a new medicine
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								<form role="form">
								<div class="form-group">
									<label>Medicine name</label>
									<input class="form-control" placeholder="Enter medicine name..">
								</div>
								<div class="form-group">
									<label>Supplier</label>
									<select class="form-control">
										<option>Select a supplier..</option>
										<option></option>
										<option></option>
									</select>
								</div>
								<div class="form-group">
									<label>Code</label>
									<input class="form-control" placeholder="Enter product code..">
								</div>
								<div class="form-group">
									<label>Expire Date</label>
									<input class="form-control" placeholder="Enter expiration date..">
								</div>
								<div class="form-group">
									<label>Price</label>
									<input class="form-control" placeholder="Enter price in L.E.">
								</div>
								<div class="form-group">
									<label>Pharmacy</label>
									<select class="form-control">
										<option>Select a pharmacy..</option>
										<option>A</option>
										<option>B</option>
										<option>C</option>
									</select>
								</div>
								<button type="submit" class="btn btn-default btn-success">Submit Button</button>
								<button type="reset" class="btn btn-default">Reset Button</button>
							</form>
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
						Modify current medicine
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								<form role="form">
									<label>Medicine ID</label>
									<div class="form-group input-group">
										<span class="input-group-addon">#</span>
										<input type="text" class="form-control" placeholder="Search..">
									</div>
									<fieldset disabled>
										<div class="form-group">
											<label for="disabledSelect">Name</label>
											<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Supplier</label>
											<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Price</label>
											<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Pharmacy</label>
											<select id="disabledSelect" class="form-control">
												<option>Disabled select</option>
											</select>
										</div>
										<button type="submit" class="btn btn-primary">Apply Changes</button>
										<button type="submit" class="btn btn-danger">Remove Medicine</button>
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
