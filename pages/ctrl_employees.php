<script>
function reset1(){
	$('input[name=optionsACC]:checked').val();
	$('input[name=optionsShift]:checked').val();
	$('#optionsPH').val('');
	$('#Username').val('');
	$('#Password').val('');
	$('#FName').val('');
	$('#LName').val('');
	$('#Address').val('');
	$('#Salary').val('');
	$('#Phone').val('');
	
	
}
function AddEmployee(){
	var opACC 	= $('input[name=optionsACC]:checked').val();
	var opSH 	= $('input[name=optionsShift]:checked').val();
	var opPH	= $('#optionsPH').val();
	var Username= $('#Username').val();
	var Password= $('#Password').val();
	var FName 	= $('#FName').val();
	var LName 	= $('#LName').val();
	var Address = $('#Address').val();
	var Salary 	= $('#Salary').val();
	var Phone 	= $('#Phone').val();
	
	
	Send("./php/Employees_ctrl.php","POST",function(data){

	},"Pharmacy_ID="+opPH+"&FName="+FName+"&LName="+LName+"&Phone="+Phone+"&Address="+Address+"&Username="+Username+"&Password="+Password+"&Salary="+Salary+"&Type="+opACC+"&Shift="+opSH);
}

</script>

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
								
									<label>Username</label>
									<div class="form-group input-group">
										<span class="input-group-addon">@</span>
										<input id="Username" type="text" class="form-control" placeholder="Username">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input id="Password" class="form-control" type="password">
										<p class="help-block">This will be modified by the employee later.</p>
									</div>
									<div class="form-group">
										<label>First Name</label>
										<input id="FName" class="form-control" placeholder="Enter text">
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input id="LName" class="form-control" placeholder="Enter text">
									</div>
									<div class="form-group">
										<label>Address</label>
										<input id="Address" class="form-control" placeholder="Enter text">
									</div>
									<div class="form-group">
										<label>Salary</label>
										<input id="Salary" class="form-control" placeholder="Enter text">
									</div>
									<div class="form-group">
										<label>Phone</label>
										<input id="Phone" class="form-control" placeholder="Enter text">
									</div>
									<div class="form-group">
										<label>Account Type</label>
										<div class="radio">
											<label>
												<input type="radio" name="optionsACC" value="Admin" checked>Admin
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="optionsACC" value="Sales">Sales
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="optionsACC" value="Pharmacist">Pharmacist
											</label>
										</div>
									</div>
								
									
									<div class="form-group">
										<label>Pharmacy</label>
										<select id="optionsPH" class="form-control">
											<option></option>
										<?
											
											include_once("php/MySQLi.php");
											$res=$db->fetch("SELECT Pharmacy_ID FROM pharmacies",true);
											for($i=0;$i<count($res);$i++)
												ECHO "<option value=".$res[$i]['Pharmacy_ID'].">".$res[$i]['Pharmacy_ID']."</option>";

										?>
										</select>
									</div>
									<div class="form-group">
										<label>Shift</label>
										<div class="radio">
											<label>
												<input type="radio" name="optionsShift" value="A" checked>A
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="optionsShift" value="B">B
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" name="optionsShift" value="C">C
											</label>
										</div>
									</div>
									<button type="submit" class="btn btn-default btn-success" onClick="AddEmployee()">Submit Button</button>
									<button type="reset" class="btn btn-default" onClick="reset1()">Reset Button</button>
								
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
											<input class="form-control" class="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Last Name</label>
											<input class="form-control" class="disabledInput" type="text" placeholder="Disabled input" disabled>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Salary</label>
											<input class="form-control" class="disabledInput" type="text" placeholder="Disabled input" disabled>
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
													<input type="radio" name="optionsRadios2" value="option1" checked>Admin
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios2" value="option2">Sales
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios2" value="option3">Pharmacist
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
