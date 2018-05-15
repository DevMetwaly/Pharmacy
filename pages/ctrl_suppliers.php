<script>
window.onload=function(){

	$( "#AddSupForm" ).on( "submit", function( event ) {
		//prevent default event of submit button
		event.preventDefault();	
		
		//get all fields values
		var Name		= $('#Name').val();
		var Phone		= $('#Phone').val();
		var Location	= $('#Location').val();
		var Email		= $('#Email').val();
		
		//call php file to store data in DB with action=add
		Send("./php/Suppliers_ctrl.php?action=add","POST",function(data){
			if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
			
			$("#resAddSup").click();
			$("#resModiSup").click();
			$("#selSupp").append("<option value="+data.ID+">"+data.ID+' '+Name+"</option>");
			
		},"Name="+Name+"&Phone="+Phone+"&Loc="+Location+"&Email="+Email);	
	});
	
	
	
	$( "#EditSupForm" ).on( "submit", function( event ) {
		//prevent default event of submit button
		event.preventDefault();	
		
		//get all fields values
		var Name		= $('#SName').val();
		var Phone		= $('#SPhone').val();
		var Location	= $('#SLocation').val();
		var Email		= $('#SEmail').val();
		var selSupp		= $('#selSupp').val();
		
		//call php file to store data in DB with action=add
		Send("./php/Suppliers_ctrl.php?action=edit","POST",function(data){
			if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
		},"Name="+Name+"&Phone="+Phone+"&Loc="+Location+"&Email="+Email+"&Supplier_ID="+selSupp);	
	
	});
	
	
	$( "#DelSupp" ).on( "click", function( event ) {
		var Supplier_ID = $('#selSupp').val();
		Send("./php/Suppliers_ctrl.php?action=delete","POST",function(data){
		    if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
		   $("#resModiSup").click();
		   $('#field').prop('disabled', true);
		   $('#selSupp option[value='+Supplier_ID+']').remove();
		},"Supplier_ID="+Supplier_ID);
	});
	
	
	
	$('#selSupp').on('change', function() {
		var Supplier_ID= this.value;
		
		Send("./php/Suppliers_ctrl.php?action=comp","POST",function(data){
			
			if(data !="null"){
				$("#SLocation").val(data.Location);
				$("#SName").val(data.Name);
				$("#SEmail").val(data.Email);
				$("#SPhone").val(data.Phone);
				$('#field').prop('disabled', false);
			}
		},"Supplier_ID="+Supplier_ID);
	
	})
	
	
	
	

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
								<form id="AddSupForm">
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
										
									</div>
									<button type="submit" class="btn btn-default btn-success" onClick="AddSuplier()">Submit Button</button>
									<button id="resAddSup" type="reset" class="btn btn-default">Reset Button</button>
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
						Modify an existing supplier
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								<form id="EditSupForm" role="form">
									<label>Supplier</label>
									<div class="form-group">
										<select id="selSupp" class="form-control">
											<option>Select supplier..</option>
											<?
												include_once("php/MySQLi.php");
												$res=$db->fetch("SELECT Supplier_ID, Name FROM suppliers",true);
												for($i=0;$i<count($res);$i++)
												ECHO "<option value=".$res[$i]['Supplier_ID'].">".$res[$i]['Supplier_ID'].' '.$res[$i]['Name']."</option>";
											?>
										</select>
									</div>
									<fieldset id="field" disabled>
										<div class="form-group">
											<label>Name</label>
											<input id="SName" class="form-control" placeholder="Enter text">
										</div>
										<div class="form-group">
											<label>Address</label>
											<input id="SLocation" class="form-control" placeholder="Enter text">
										</div>
										<div class="form-group">
											<label>Email Address</label>
											<input id="SEmail" class="form-control" placeholder="Enter text">
										</div>
										<div class="form-group">
											<label>Phone Numbers</label>
											<input id="SPhone" class="form-control" placeholder="Ex: 1003004000, 555-111-999">
										</div>
										<button type="submit" class="btn btn-primary">Apply Changes</button>
										<button id="DelSupp" type="button" class="btn btn-danger" >Remove Supplier</button>
										<button id="resModiSup" type="reset"  class="btn btn-default">Reset Button</button>
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
