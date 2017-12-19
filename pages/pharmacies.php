<script>
window.onload = function(){
	Send("./php/Pharmacies_table.php","GET",function(data){
		$.each(data,function(index,row){
			phones="";
			$.each(row.phones,function(index,phone){
		
				phones+= phone.Phone+"<br>";
				
			});
			$("#pharmacies").append("<tr><td>"+row.Pharmacy_Number+"</td><td>"+row.Location+
			"</td><td>"+phones+"</td></tr>");
		});
		$('#dataTables-example').DataTable({
            responsive: true
        });
	});	
}
	
</script>
<div id="page-wrapper" >
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Pharmacies</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Pharmacies Data Table
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Pharmacy</th>
								<th>Location</th>
								<th>Phones</th>
							</tr>
						</thead>
						<tbody id="pharmacies">
							
							
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

