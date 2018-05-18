<script>

window.onload = function(){
	Send("./php/Customers_table.php","GET",function(data){
		$.each(data,function(index,row){
			if(row.Score==null) row.Score =0;
			$("#Customers").append(
			"<tr>"+
			"<td>"+row.cid+"</td><td>"+row.Name+"</td><td>"+row.Address+"</td><td>"+row.Phone+"</td><td>"+row.Score+"</td>"+ 
			"</tr>"
			);
		});

		$('#dataTables-example').DataTable({
            responsive: true,
			"order": [[ 4, "desc" ]]
        });
	});	
}
	
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Customers</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Customers Data Table
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Customer ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Score</th>
							</tr>
						</thead>
						<tbody id="Customers">
							
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
