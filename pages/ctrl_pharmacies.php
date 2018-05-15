<script>

window.onload = function(){
		$( "#AddPH" ).on( "submit", function( event ) {
		event.preventDefault();
		var Phones = $('input[name^=addPhone]').map(function(idx, elem) {
			return $(elem).val();
		}).get();
		Phones		= 	JSON.stringify(Phones);
		
		var PhNum 	=	$('#PhNum').val();
		var PhAdd 	=	$('#PhAdd').val();
		Send("./php/Pharmacies_ctrl.php?action=add","POST",function(data){
			if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
		},"PhNum="+PhNum+"&PhAdd="+PhAdd+"&Phones="+Phones);
		});
		
		
		$( "#EditPH" ).on( "submit", function( event ) {
		event.preventDefault();
		var Phones = $('input[name^=editPhone]').map(function(idx, elem) {
			return $(elem).val();
		}).get();
		Phones		= 	JSON.stringify(Phones);
		var PhId    =   $('#PHlist').val();
		var PhAdd 	=	$('#Address').val();
		var Admin   =   $('#Admin').val();
		Send("./php/Pharmacies_ctrl.php?action=edit","POST",function(data){
			if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
		},"PhId="+PhId+"&PhAdd="+PhAdd+"&Phones="+Phones+"&Admin="+Admin);
		});
		
		
		$('#PHlist').on('change', function() {
		var Pharmacy_ID= this.value;
		
		Send("./php/Pharmacies_ctrl.php?action=comp","POST",function(data){
			console.log(data);
			if(data !="null"){
				$("#Address").val(data.Location);
				$('#field').prop('disabled', false);
				$("#EphoneBoxList span").not(':first').remove();
				$("#Phone").val(data.phones[0].Phone);
				$('#Admin option[value='+data.Pharmacy_Admin+']').attr("selected",true);
				for(i=1;i<data.phones.length;i++)
				  formAddBox('pharmacy','phone',data.phones[i].Phone,"EphoneBoxList","editPhone");
			}
		},"Pharmacy_ID="+Pharmacy_ID);
	
	});
	$( "#DelPH" ).on( "click", function( event ) {
		var Pharmacy_ID = $('#PHlist').val();
		Send("./php/Pharmacies_ctrl.php?action=delete","POST",function(data){
		   if(data.type=='success')
				popUp(1,data.msg);
			else
				popUp(0,data.msg);
		   $("#EditPH").trigger('reset');
		   $('#field').prop('disabled', true);
		   $('#PHlist option[value='+Pharmacy_ID+']').remove();
		   $("#EphoneBoxList span").not(':first').remove();
		},"Pharmacy_ID="+Pharmacy_ID);
	});
	
}
</script>
<style>
#EphoneBoxList .fa-remove{
  right: 24px;
  margin-top: -25px;
  position: absolute;
  font-size: 18px;
  color: brown;
}
#EphoneBoxList .fa-remove:hover{
  cursor: pointer;
  color: red;
}
</style>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pharmacies Management</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add a new branch
					</div>

					<div class="panel-body">

						<div class="row">

							<div class="col-lg-12">
								<form role="form" id="AddPH">
									<label>Pharmacy Number</label>
									<div class="form-group input-group">
										<span class="input-group-addon">#</span>
										<input id="PhNum" type="text" name="Pharmacy_Number" class="form-control" placeholder="Use a unique single letter, or leave empty for auto generation.">
									</div>
									<div class="form-group">
										<label>Address</label>
										<input id="PhAdd" class="form-control" name="Pharmacy_Address" placeholder="Enter pharmacy address" required>
									</div>
									<div class="form-group">
										<label>Phone Numbers</label>
										
										<div id="phoneBoxList">
											<span>
												<input class="form-control phoneBox" name="addPhone[]" placeholder="Ex: 01003004000" minLength=7 maxLength=15 pattern="[0-9]+" required>
											</span>
										</div>
										
										<div class="formAddButtonDiv">
											<span class="formAddButton btn btn-primary btn-xs" onclick="formAddBox('pharmacy','phone')">
												<i class="fa fa-plus"></i> Add Phone
											</span>
										</div>

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
						Modify an existing branch
					</div>

					<div class="panel-body">

						<div class="row">
							<div class="col-lg-12">
								<form role="form" id ="EditPH">
								<div class="form-group">
									<label>Pharmacy</label>
									<select class="form-control" id="PHlist">
										<option>Select pharmacy..</option>
										<? $phs=$db->fetch("SELECT * FROM pharmacies",true);
										foreach ($phs as $ph)
										echo "<option value=\"".$ph["Pharmacy_ID"]."\">".$ph["Pharmacy_Number"]."</option>";	
										?>
									</select>
								</div>
									<fieldset id="field" disabled>
										<div class="form-group">
											<label>Address</label>
											<input id="Address" class="form-control" placeholder="Update pharmacy address">
										</div>
										<div class="form-group">
											<label>Phone Numbers</label>
											<div id="EphoneBoxList">
											<span>
												<input id="Phone" class="form-control phoneBox" name="editPhone[]" placeholder="Update phone list">
											</span>
										</div>
										<div class="formAddButtonDiv">
											<span class="formAddButton btn btn-primary btn-xs" onclick="formAddBox('pharmacy','phone','','EphoneBoxList','editPhone')">
												<i class="fa fa-plus"></i> Add Phone
											</span>
										</div>

										</div>
										<div class="form-group">
											<label>Admin Employee</label>
											<select id="Admin" class="form-control">
												<option value="0">Select employee..</option>
												<? $emps=$db->fetch("SELECT * FROM empolyees WHERE Type='Admin'",true);
												foreach ($emps as $emp)
												echo "<option value=\"".$emp["Empolyee_ID"]."\">".$emp["FName"]." ".$emp["LName"]."</option>";	
												?>
											</select>
										</div>
										<button type="submit" class="btn btn-primary">Apply Changes</button>
										<button type="button" id="DelPH"  class="btn btn-danger">Remove Branch</button>
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
