<script>

window.onload = function(){
	Send("./php/notifications_table.php","GET",function(data){

		$.each(data.Expired,function(index,row){
			$("#notf_exp_table").append(
			"<tr>"+
			"<td>"+row.Pharmacy_ID+"</td><td>"+row.Expire_Data+"</td><td>"+row.Name+"</td>"+
			"</tr>"
			);



		});



		$.each(data.Epire_Soon,function(index,row){
			$("#notf_soon_table").append(
			"<tr>"+
			"<td>"+row.Pharmacy_ID+"</td><td>"+row.Expire_Data+"</td><td>"+row.Name+"</td>"+
			"</tr>"
			);


		});



		$.each(data.Out_of_stock,function(index,row){
			$("#notf_stock_table").append(
			"<tr>"+
			"<td>"+row.Pharmacy_ID+"</td><td>"+row.Quantity+"</td><td>"+row.Name+"</td>"+
			"</tr>"
			);

		});


		$('.dataTables').DataTable({
            responsive: true
        });

		function func(){
			//$("a[href$='"+location.hash+"']").parent().addClass("active")[1];
			$("a[href$='"+location.hash+"']").trigger("click")[1];
		}

		window.onhashchange= func;
        $("a[href$='"+location.hash+"']").trigger("click")[1];


	});	
}
	
</script>



<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Notifications</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">    
			<ul class="nav nav-tabs" id="PH_TABS">
				<li class="active"><a data-toggle="tab" href="#notf_soon">Expire Soon</a></li>
				<li><a data-toggle="tab" href="#notf_exp">Expired</a></li>
				<li><a data-toggle="tab" href="#notf_stock">Need Restock</a></li>
			</ul>
		</div>

		<div class="col-lg-12 tab-content" id="PH_TABLES">    
			
			<div id="notf_soon" class="panel panel-default tab-pane fade active in ">
					<div class="panel-heading">
					<h4><b>Medicines expire soon.</b></h4>
				</div>

				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover dataTables" >
						<thead>
							<tr>
								<th>Pharmacy</th>
								<th>Expire Date</th>
								<th>Medicine Name</th>
							</tr>
						</thead>
						<tbody id="notf_soon_table">
						</tbody>
					</table>
				</div>
			</div>

			<div id="notf_exp" class="panel panel-default tab-pane fade">
					<div class="panel-heading">
					<h4><b>Expired medicines.</b></h4>
				</div>

				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover dataTables">
						<thead>
							<tr>
								<th>Pharmacy</th>
								<th>Expire Date</th>
								<th>Medicine Name</th>
							</tr>
						</thead>
						<tbody id="notf_exp_table">
						</tbody>
					</table>
				</div>
			</div>

			<div id="notf_stock" class="panel panel-default tab-pane fade">
					<div class="panel-heading">
					<h4><b>Medicines need to restock.</b></h4>
				</div>

				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover dataTables">
						<thead>
							<tr>
								<th>Pharmacy</th>
								<th>Quantity</th>
								<th>Medicine Name</th>
							</tr>
						</thead>
						<tbody id="notf_stock_table">
						</tbody>
					</table>
				</div>
			</div>

		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>

