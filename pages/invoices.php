<script>

window.onload = function(){
	Send("./php/Invoices_table.php","GET",function(data){
		$.each(data,function(index,row){
			$("#Invoice").append(
			"<tr>"+
			"<td>"+row.Customer_ID+"</td><td>"+row.Name+"</td><td>"+row.Address+"</td><td>"+row.Phone+"</td><td>"+ 
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
			<h1 class="page-header">Invoices</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Inovices Data Table
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Invoice ID</th>
								<th>Items</th>
								<th>Employee Name</th>
								<th>Customer Name</th>
								<th>Date</th>
								<th>Total</th>
								<th>Pharmacy</th>
							</tr>
						</thead>
						<tbody id="Invoice">
							<tr>
								<td>0001</td>
								<td>
									Panadol <br>
									Bruffin 500mg <br>
									Refresh Liquid
								</td>
								<td>Ahmed Bally</td>
								<td>Abdelrahman Tarek</td>
								<td>Dec 11, 2017</td>
								<td>230</td>
								<td>A</td>
								
							</tr>
						
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

