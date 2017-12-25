<script>
window.onload = function(){
	Send("./php/Suppliers_table.php","GET",function(data){
		$.each(data,function(index,row){
			$("#Suppliers").append(
			"<tr>"+
			"<td>"+row.Supplier_ID+"</td><td>"+row.Name+"</td><td>"+row.Phone+"</td><td>"+row.Location+"</td><td>"+row.Email+"</td>"+
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
                    <h1 class="page-header">Suppliers</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Suppliers Data Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Supplier ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody id="Suppliers">
                                    
                                    
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
        <!-- /#page-wrapper -->
