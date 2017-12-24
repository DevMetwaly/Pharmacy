<script>
window.onload = function(){
	Send("./php/Employees_ctrl.php?action=table","GET",function(data){
		$.each(data,function(index,row){
			$("#Employees").append(
			"<tr>"+
			"<td>"+row.Empolyee_ID+"</td><td>"+row.Pharmacy_Number+"</td><td>"+row.FName+"</td><td>"+row.LName+"</td><td>"+row.Phone+"</td><td>"+row.Address+"</td><td>"+row.Type+"</td><td>"+row.Salary+"</td><td>"+row.Shift+"</td><td>"+row.Hire_Date+"</td>"+ 
			"</tr>"
			);
		});
		$('#dataTables-example').DataTable({
            responsive: true
        });
	});	
}
	
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Employees</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Employees Data Table
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Employee ID</th>
								<th>Pharmacy</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Type</th>
								<th>Salary</th>
								<th>Shift</th>
								<th>Hire Date</th>
							</tr>
						</thead>
						<tbody id="Employees">
							
						</tbody>
					</table>
					<!-- /.table-responsive -->
					
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
