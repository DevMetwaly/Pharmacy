<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Employees Management</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add a new employee
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								<form role="form">
								<label>Username</label>
								<div class="form-group input-group">
									<span class="input-group-addon">@</span>
									<input type="text" class="form-control" placeholder="Username">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password">
									<p class="help-block">This will be modified by the employee later.</p>
								</div>
								<div class="form-group">
									<label>First Name</label>
									<input class="form-control" placeholder="Enter text">
								</div>
								<div class="form-group">
									<label>Last Name</label>
									<input class="form-control" placeholder="Enter text">
								</div>
								<div class="form-group">
									<label>Salary</label>
									<input class="form-control" placeholder="Enter text">
								</div>
								<div class="form-group">
									<label>Account Type</label>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Admin
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Sales
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Pharmacist
										</label>
									</div>
								</div>
								<div class="form-group">
									<label>Pharmacy</label>
									<select class="form-control">
										<option></option>
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
						Modify current employee
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								<form role="form">
									<label>Employee ID</label>
									<div class="form-group input-group">
										<span class="input-group-addon">#</span>
										<input type="text" class="form-control" placeholder="Search..">
									</div>
									<fieldset disabled>
										<div class="form-group">
											<label for="disabledSelect">First Name</label>
											<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Last Name</label>
											<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Salary</label>
											<input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Pharmacy</label>
											<select id="disabledSelect" class="form-control">
												<option>Disabled select</option>
											</select>
										</div>
										<div class="form-group">
											<label>Account Type</label>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Admin
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Sales
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Pharmacist
												</label>
											</div>
										</div>
										<button type="submit" class="btn btn-primary">Apply Changes</button>
										<button type="submit" class="btn btn-danger">Remove Employee</button>
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
