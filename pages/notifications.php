<script>

window.onload = function(){
	Send("./php/Notification_table.php","GET",function(data){

		$.each(data.Expired,function(index,row){
			


		});



		$.each(data.Epire_Soon,function(index,row){



		});



		$.each(data.Out_of_stock,function(index,row){



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
			<h1 class="page-header">Notifications</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">    
			<ul class="nav nav-tabs" id="PH_TABS">
				<li class='active'><a data-toggle="tab" href="#notf_soon">Expire Soon</a></li>
				<li><a data-toggle="tab" href="#notf_exp">Expired</a></li>
				<li><a data-toggle="tab" href="#notf_stock">Out of Stock</a></li>
			</ul>
		</div>

		<div class="col-lg-12 tab-content" id="PH_TABLES">    
			
			<div id="notf_soon" class="panel panel-default tab-pane fade active in ">
					<div class="panel-heading">
					<h4><b>Medicines expire soon.</b></h4>
				</div>

				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover dataTables">
						<thead>
							<tr>
								<th>Medicines</th>
								<th>Status</th>
								<th></th>
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
								<th>Medicines</th>
								<th>Status</th>
								<th></th>
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
								<th>Medicines</th>
								<th>Status</th>
								<th></th>
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

