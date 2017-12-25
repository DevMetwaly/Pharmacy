<script>
var x=[];
function delRow(row,id){
	a=confirm("Do you want to delete this row?");
	if(a){
		$(row).closest('tr').remove();
		Send("./php/Inventory_table.php?action=delete","POST",function(data){
			alert(data.msg);
		},"id="+id+"");
	}
	
}
window.onload = function(){
	Send("./php/Inventory_table.php?action","GET",function(data){
		var arr=[];
		var active="active in";
		$.each(data,function(index,row){
			if(arr[row.Pharmacy_ID]==undefined){
				arr[row.Pharmacy_ID]=true;
				$("#PH_TABS").append('<li class='+active+'><a data-toggle="tab" href=#'+row.Pharmacy_ID+'>'+row.Pharmacy_ID+'</a></li>');
				$("#PH_TABLES").append(
				'<div id='+row.Pharmacy_ID+' class="panel panel-default tab-pane fade '+active+' ">'
					+'<div class="panel-heading">'
					+'<h4><b>Pharmacy'+ row.Pharmacy_ID +'Inventory Data Table</b></h4>'
				+'</div>'

				+'<div class="panel-body">'
					+'<table width="100%" class="table table-striped table-bordered table-hover dataTables">'
						+'<thead>'
							+'<tr>'
								+'<th>Product ID</th>'
								+'<th>Name</th>'
								+'<th>Price</th>'
								+'<th>Quantity</th>'
								+'<th>Expire Date</th>'
								+'<th>Barcode</th>'
								+'<th></th>'
							+'</tr>'
						+'</thead>'
						+'<tbody id=Inventory'+row.Pharmacy_ID+'>'
						+'</tbody>'
					+'</table>'
					
				+'</div>'
				);
				active="";
			}
			
			$("#Inventory"+row.Pharmacy_ID).append(
				"<tr>"+
					"<td>"+row.Product_ID +"</td>"+
					"<td>"+row.M_Name +"</td>"+
					"<td>"+row.Price +"</td>"+
					"<td>"+row.Quantity +"</td>"+
					"<td>"+row.Expire_Date +"</td>"+
					"<td>"+row.Barcode +"</td>"+
					'<td class="text-center"><i class="fa fa-minus-circle" onclick="delRow(this,'+row.Product_ID+')"></i></td>'+
				
				"</tr>"
			
			);
		});
		$('.dataTables').DataTable({
            responsive: true
        });
	});	

	
}
</script>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Inventory</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">    
			<h5>Select the ID of the pharmacy to show current inventory.</h5>
			<ul class="nav nav-tabs" id="PH_TABS">
				
			</ul>
		</div>

		<div class="col-lg-12 tab-content" id="PH_TABLES">    

			
			
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>

