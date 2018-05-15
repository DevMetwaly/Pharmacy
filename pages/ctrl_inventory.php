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

	var PID=0;

	$( "#P_Mid" ).autocomplete({
			minLength:1,
			
			source: function( request, response ) {
				Send("./php/Product_ctrl.php?action=auto","POST", function (data) {
					response($.map(data, function (value, key) {
						return {
							label: value.Name,
							value: value.Product_ID
						};
					}),);
				},"q=" + request.term);
			},
			
			select: function( event, ui ){
				Send("./php/Product_ctrl.php?action=number","POST",function (data){
					if(data !="null"){
						$('#P_Mid').val(data.Name);
						$('#P_optionsPH option[value='+data.Pharmacy_ID+']').attr("selected",true);
						$('#P_Price').val(data.Price);
						$('#P_ExpireDate').val(data.Expire_Date);
						$('#P_Quantity').val(data.Quantity);
						$('#P_Barcode').val(data.Barcode);
						$("#field").removeAttr('disabled');
						PID=ui.item.value;
					}
				},"q="+ui.item.value);
				return false;
			}
	});
	
	
	$( "#DelMed" ).on( "click", function( event ) {
		Send("./php/Product_ctrl.php?action=delete","POST",function(data){
		  if(data.type=='success')
				popUp(1,data.msg);
				$("#resModiMed").click();
		   		$('#field').prop('disabled', true);
			else
				popUp(0,data.msg);
		   
		},"Product_ID="+PID);
	});

	
	$( "#EditMedForm" ).on( "submit", function( event ) {
		//prevent default event of submit button
		event.preventDefault();	
		//get all fields values
		var Pharmacy 	= $('#P_optionsPH').val();
		var Price 		= $('#P_Price').val();
		var Quantity	= $('#P_Quantity').val();
		var ExpireDate  = $('#P_ExpireDate').val();
		var Barcode		= $('#P_Barcode').val();
		//call php file to store data in DB with action=add
		Send("./php/Product_ctrl.php?action=edit","POST",function(data){
			if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
		},"Product_ID="+PID+"&Pharmacy="+Pharmacy+"&Price="+Price+"&Quantity="+Quantity+"&ExpireDate="+ExpireDate+"&Barcode="+Barcode);	
	
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
									
									<!-- hidden -->
									<div class="form-group" style="display: none;" disabled>
										<label>Product ID</label>
										<input id="P_id" class="form-control" placeholder="Enter medicine name.." disabled>
									</div>
									


									<label>Product Name</label>
									<div class="form-group input-group">
										<span class="input-group-addon">#</span>
										<input id="P_Mid" type="text" class="form-control" placeholder="Search..">
									</div>
									<fieldset id="field" disabled>
										
										<div class="form-group">
											<label>Pharmacy</label>
											<select id="P_optionsPH" class="form-control" required>
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
											<input id="P_Price" class="form-control" placeholder="Medicine Price" pattern="[0-9]+" required>
										</div>
										<div class="form-group">
											<label>Quantity</label>
											<input id="P_Quantity" class="form-control" placeholder="Medicine Quantity" pattern="[0-9]+" required>
										</div>
										<div class="form-group">
											<label>Expire Date</label>
											<input type="date" id="P_ExpireDate" class="form-control" placeholder="20xx-xx-xx"  required>
										</div>

										<div class="form-group">
											<label>Barcode</label>
											<input id="P_Barcode" class="form-control" placeholder="Scan Barcode" required>
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
