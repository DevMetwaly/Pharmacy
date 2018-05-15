<script>
window.onload=function(){
	$( "#AddMedForm" ).on( "submit", function( event ) {
		//prevent default event of submit button
		event.preventDefault();	
		var Name		= $('#Name').val();
		var Description	= $('#Description').val();
		var Supplier	= $('#Supplier').val();	
		
		Send("./php/Medicines_ctrl.php?action=add","POST",function(data){
			if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
			$("#resAddMed").click();
			$("#resModiMed").click();
		},"Name="+Name+"&Description="+Description+"&Supplier_IDs="+Supplier);	
	
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
									
								<form id="AddMedForm" role="form">
									<div class="form-group">
										<label>Medicine name</label>
										<input id="Name" class="form-control" placeholder="Enter medicine name" pattern="^[a-zA-Z][a-zA-Z ]+" required>
									</div>
									<div class="form-group">
										<label>Description</label>
										<input id="Description" class="form-control" placeholder="Enter desciption" required>
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
									<button type="submit" class="btn btn-default btn-success">Submit Button</button>
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
						Modify current medicine
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
											<input id="MName" class="form-control" id="disabledInput" type="text" placeholder="Update name..">
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
											<input id="MDescription" class="form-control" id="disabledInput" type="text" placeholder="Update description">
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
