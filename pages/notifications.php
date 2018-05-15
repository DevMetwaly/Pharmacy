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
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Blank</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>