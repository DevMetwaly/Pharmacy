<script>
window.onload = function(){
	Send("./php/Medicines_table.php","GET",function(data){
		$.each(data,function(index,row){
			$("#Medicines").append(
			"<tr>"+
			"<td>"+row.Medicin_ID+"</td><td>"+row.M_Name+"</td><td>"+row.Description+"</td><td>"+row.Supplier_ID+"</td><td>"+row.S_Name+"</td>"+
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
			<h1 class="page-header">Medicines</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Medicines Data Table
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Medicine ID</th>
								<th>Name</th>
								<th>Description</th>
								<th>Supplier ID</th>
								<th>Supplier Name</th>
							</tr>
						</thead>
						<tbody id="Medicines">
							
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
