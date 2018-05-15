<script>
		var medicineID=0;

window.onload=function(){
	$( "#AddMedForm" ).on( "submit", function( event ) {
		event.preventDefault();	
		var Pharmacy 	= $('#optionsPH').val();
		var Price 		= $('#Price').val();
		var Quantity	= $('#Quantity').val();
		var ExpireDate  = $('#ExpireDate').val();
		var Barcode		= $('#Barcode').val();
		
		Send("./php/Product_ctrl.php?action=add","POST",function(data){
			if(data.type=='success')
			{	
				$("#resAddMed").click();
				popUp(1,data.msg);
			}
			else
				popUp(0,data.msg);

		},"Pharmacy="+Pharmacy+"&Price="+Price+"&Quantity="+Quantity+"&ExpireDate="+ExpireDate+"&Barcode="+Barcode+"&Medicin_ID="+medicineID);	
	
	});
	$( "#SMID" ).autocomplete({
			minLength:1,
			
			source: function( request, response ) {
				Send("./php/Medicines_ctrl.php?action=auto","POST", function (data) {
					response($.map(data, function (value, key) {
						return {
							label: value.Name,
							value: value.Medicin_ID
						};
					}),);
				},"q=" + request.term);
			},
			
			select: function( event, ui ){
				medicineID = ui.item.value;
				Send("./php/Medicines_ctrl.php?action=number","POST",function (data){
					if(data !="null"){
						$('#SMID').val(data.Name);
					}
				},"q="+ui.item.value);
				return false;
			}
	});



	$( "#Mid" ).autocomplete({
			minLength:1,
			
			source: function( request, response ) {
				Send("./php/Medicines_ctrl.php?action=auto","POST", function (data) {
					response($.map(data, function (value, key) {
						return {
							label: value.Name,
							value: value.Medicin_ID
						};
					}),);
				},"q=" + request.term);
			},
			
			select: function( event, ui ){
				Send("./php/Medicines_ctrl.php?action=number","POST",function (data){
					if(data !="null"){
						$('#MName').val(data.Name);
						$('#Mid').val(data.Name);
						$('#MDescription').val(data.Description);
						$("#field").removeAttr('disabled');
						$('#Medicin_ID').val(data.Medicin_ID);
					
					}
				},"q="+ui.item.value);
				return false;
			}
	});
	
	
	$( "#DelMed" ).on( "click", function( event ) {
		var Medicin_ID = $('#Medicin_ID').val();
		Send("./php/Medicines_ctrl.php?action=delete","POST",function(data){
		   alert(data.msg);
		   $("#resModiMed").click();
		   $('#field').prop('disabled', true);
		},"Medicin_ID="+Medicin_ID);
	});

	
	$( "#EditMedForm" ).on( "submit", function( event ) {
		//prevent default event of submit button
		event.preventDefault();	
		//get all fields values
		var Name		= $('#MName').val();
		var Description	= $('#MDescription').val();
		var Supplier	= $('#MSupplier').val();	
		var Medicin_ID = $('#Medicin_ID').val();
		
		//call php file to store data in DB with action=add
		Send("./php/Medicines_ctrl.php?action=edit","POST",function(data){
			alert(data.msg);
		},"Name="+Name+"&Description="+Description+"&Supplier_ID="+Supplier+"&Medicin_ID="+Medicin_ID);	
	
	});
	



}
</script>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Product Management</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add a new Product
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
									
								<form id="AddMedForm" role="form">
									<div class="form-group">
										<label>Product Name</label>
										<input id="SMID" type="text" class="form-control" placeholder="Search..">
									</div>
									<div class="form-group">
										<label>Pharmacy</label>
										<select id="optionsPH" class="form-control" required>
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
										<label>Price</label>
										<input id="Price" class="form-control" placeholder="Medicine Price" pattern="[0-9]+" required>
									</div>
									<div class="form-group">
										<label>Quantity</label>
										<input id="Quantity" class="form-control" placeholder="Medicine Quantity" pattern="[0-9]+" required>
									</div>
									<div class="form-group">
										<label>Expire Date</label>
										<input type="date" id="ExpireDate" class="form-control" placeholder="20xx-xx-xx"  required>
									</div>

									<div class="form-group">
										<label>Barcode</label>
										<input id="Barcode" class="form-control" placeholder="Scan Barcode" required>
									</div>
									
									
									
									<button type="submit" class="btn btn-default btn-success"  onfocus="this.blur()">Submit Button</button>
									<button id="resAddMed" type="reset" class="btn btn-default">Reset Button</button>
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
						Modify current Product
					</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form id="EditMedForm" role="form">
									<div class="form-group" style="display: none;" disabled>
										<label>Medicine ID</label>
										<input id="Medicin_ID" class="form-control" placeholder="Enter medicine name.." disabled>
									</div>
									<label>Medicine Name</label>
									<div class="form-group input-group">
										<span class="input-group-addon">#</span>
										<input id="Mid" type="text" class="form-control" placeholder="Search..">
									</div>
									
									<fieldset id="field" disabled>
										<div class="form-group">
											<label for="disabledSelect">Name</label>
											<input id="MName" class="form-control" id="disabledInput" type="text" placeholder="Disabled input">
										</div>
										<div class="form-group">
											<label for="disabledSelect">Supplier</label>
											<select id="MSupplier" class="form-control">
												<option>Select a supplier..</option>
												<?
													include_once("php/MySQLi.php");
													$res=$db->fetch("SELECT Supplier_ID, Name FROM suppliers",true);
													for($i=0;$i<count($res);$i++)
													ECHO "<option value=".$res[$i]['Supplier_ID'].">".$res[$i]['Supplier_ID'].' '.$res[$i]['Name']."</option>";
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="disabledSelect">Desciption</label>
											<input id="MDescription" class="form-control" id="disabledInput" type="text" placeholder="Disabled input">
										</div>
										
										<button type="submit" class="btn btn-primary">Apply Changes</button>
										<button id="DelMed" type="button" class="btn btn-danger">Remove Medicine</button>
										<button id="resModiMed" type="reset"  class="btn btn-default">Reset Button</button>
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
