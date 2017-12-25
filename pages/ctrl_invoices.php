
<script>
sold_products=[];
invoice=[];
var j=1;
function total(){
	sum=0;
	for(i in invoice){
		sum+=parseFloat(invoice[i].Price)*parseFloat(invoice[i].Quantity);
	}
	$("#total").text(sum);
}
function delRowInvoice(row,id){
	a=confirm("Do you want to delete this row?");
	if(a){
		for(i in invoice){
			if(parseInt(invoice[i].Product_ID)==id)
				invoice.splice(i,1);
				sold_products.splice(i,1);
		}
		$(row).closest('tr').remove();
		total();
		j--;
	}
}
function invoiceButton(thisButton, inc, Limit){
			b=$(thisButton).closest("td").find('input:nth-child(1)');
			a=b.val()
			
            if(inc && a<Limit){
                a++;
				//Check here that we don't pass database limit.
                $(thisButton).closest("td").find('input:nth-child(1)').val(a);				
            }
            else if(!inc && a>1){
                a--;
				//Checking that we sell at least one.
				{$(thisButton).closest("td").find('input:nth-child(1)').val(a);}
				
            }
			for(key in invoice){
					if(invoice[key].Product_ID == b.attr('id')){
						invoice[key].Quantity =a;
						
					}
				}
			total();
}
window.onload=function(){
$( "#Apply" ).on( "submit", function( event ) {
  event.preventDefault();
  var phone=$("#Customer_Phone").val();
  var name=$("#Customer_Name").val();
  var address=$("#Customer_Address").val();
  Send("php/Invoices_ctrl.php?action=invoice","POST", function (data) {
	  alert(data.msg);
	  if(data.type="success")
		  location.reload();
  },"Phone=" + phone+"&Name="+name+"&Address="+address+"&invoices="+JSON.stringify(invoice));
});

$( ".autocomplete" ).autocomplete({
					minLength:3,

  source: function( request, response ) {
		Send("php/Invoices_ctrl.php?action=search","POST", function (data) {
			response($.map(data, function (value, key) {
				return {
					label: value.Name,
					value: value.Product_ID
					};
			}),);
		},"q=" + request.term);
	},
	select: function( event, ui ){
		Send("php/Invoices_ctrl.php?action=get","POST",function (data){
		var result = $.grep(sold_products, function(e){ return e.Product_ID == data.Product_ID; });
		if(result == ""){
			sold_products.push(data);
			
			$("#Invoice").append(
			"<tr>"
				+"<td>"+ (j++) +"</td>"
				+"<td>"+data.Name+"</td>"
				+"<td>"+data.Barcode+"</td>"
				+"<td>"+data.Expire_Date+"</td>"
				+"<td><input type=\"text\" class=\"form-control\" id=\""+data.Product_ID+"\" value=\"1\">"
					+"<input type=\"button\" onclick='invoiceButton(this,1,"+data.Quantity+")' class='table-button' value='+'>"
					+"<input type=\"button\" onclick='invoiceButton(this,0,"+data.Quantity+")' class='table-button' value='-'></td>"
				+"<td>"+data.Price+"</td>"
				+"<td class=\"text-center\"><i class=\"fa fa-minus-circle\" onclick='delRowInvoice(this,"+data.Product_ID+")'></i></td>"
			+"</tr>");
			data.Quantity=1;
			invoice.push(data);
		}else{
			for(key in invoice){
				if(invoice[key].Product_ID == data.Product_ID && data.Quantity >= invoice[key].Quantity+1){
					invoice[key].Quantity+=1;
					$("#"+data.Product_ID).val(invoice[key].Quantity);
				}
			}
		
		}
		total();
		},"q="+ui.item.value);
		return false;
	}	
});
$( ".autocompletenumber" ).autocomplete({
					minLength:3,

  source: function( request, response ) {
		Send("php/Invoices_ctrl.php?action=getnumber","POST", function (data) {
			response($.map(data, function (value, key) {
				return {
					label: value.Phone,
					value: value.Customer_ID
					};
			}),);
		},"q=" + request.term);
	},
	select: function( event, ui ){
		Send("php/Invoices_ctrl.php?action=number","POST",function (data){
			if(data !="null"){
				$("#Customer_Phone").val(data.Phone);
				$("#Customer_Name").val(data.Name);
				$("#Customer_Address").val(data.Address);
			}
		},"q="+ui.item.value);
		return false;
	}
});

}
</script>
<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Invoices Panel</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							Create a new invoice
						</div>

						<div class="panel-body">

							<div class="row">

								<div class="col-lg-12">
									

									<label>Search Medicines</label>
									<div class="form-group input-group">
										<input type="text" class="autocomplete form-control" placeholder="Search by name, id or code.." onsubmit="return false;">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>
									<form role="form" id="Apply">
									<label>Invoice:</label>
									<div class="panel panel-primary">
										<div class="panel-heading">
												List of current added medicines
										</div>

										<div class="panel-body">
											<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Item Name</th>
													<th>Code</th>
													<th>Expire Date</th>
													<th>Quantity</th>
													<th>Price</th>
													<th></th>
												</tr>
											</thead>
											<tbody id="Invoice">
											</tbody>
											</table>
											<h4>Total: <span id="total">0</span> L.E</h4>
											<!--<h4>Discount: 0%</h4>-->
											</div>
										</div>
									</div>

									<ul class="nav nav-pills">
										<li><a data-toggle="pill" href="#client">Register Customer</a></li>
										<li><a data-toggle="pill" href="#noclient">Print</a></li>
									</ul>
								  
								  <div class="tab-content"><br>
									<div id="client" class="tab-pane fade">
										<label>Customer Phone</label>
										<div class="form-group input-group">
											<span class="input-group-addon">#</span>
											<input type="text" id="Customer_Phone" class="autocompletenumber form-control" placeholder="Customer Phone..">
										</div>
										<label>Customer Name</label>
										<div class="form-group">
											<input type="text" id="Customer_Name"class="form-control" placeholder="Customer name..">
										</div>
										<label>Customer Address</label>
										<div class="form-group">
											<input type="text" id="Customer_Address" class="form-control" placeholder="Address..">
										</div>
										<button type="submit" class="btn btn-default btn-success">Confirm & Print</button>
										<button type="reset" class="btn btn-default">Reset</button>
									</div>

									<div id="noclient" class="tab-pane fade">
										<button type="submit" class="btn btn-default btn-success">Confirm & Print</button>
									</div>

								</form>
								</div>

							</div>

						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
</div>
