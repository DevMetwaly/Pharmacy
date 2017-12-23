<script>
function Reset(){
	$('#Name').val('');
	$('#Desciption').val('');
	$('#Supplier').val('');
	
}

function AddMed(){
	var Name		= $('#Name').val();
	var Desciption	= $('#Desciption').val();
	var Supplier	= $('#Supplier').val();

	Send("./php/Medicines_ctrl.php","POST",function(data){

	},"Name="+Name+"&Description="+Desciption+"&Supplier_IDs="+Supplier);	
	Reset();
}



</script>
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
								
								<div class="form-group">
									<label>Medicine name</label>
									<input id="Name" class="form-control" placeholder="Enter medicine name..">
								</div>
								<div class="form-group">
									<label>Desciption</label>
									<input id="Desciption" class="form-control" placeholder="Enter Desciption">
								</div>
								<div class="form-group">
									<label>Supplier</label>
									<select id="Supplier" class="form-control">
										<option>Select a supplier..</option>
										<?
											include_once("php/MySQLi.php");
											$res=$db->fetch("SELECT Supplier_ID, Name FROM suppliers",true);
											for($i=0;$i<count($res);$i++)
											ECHO "<option value=".$res[$i]['Supplier_ID'].">".$res[$i]['Supplier_ID'].' '.$res[$i]['Name']."</option>";
										?>
									</select>
								</div>
								<button type="submit" class="btn btn-default btn-success" onClick="AddMed()">Submit Button</button>
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
