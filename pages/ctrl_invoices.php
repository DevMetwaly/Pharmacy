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
									<form role="form">

									<label>Search Medicines</label>
									<div class="form-group input-group">
										<input type="text" class="form-control" placeholder="Search by name, id or code..">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>

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
											<tbody>

												<tr>
													<td>1</td>
													<td>Panadol Extra</td>
													<td>201512</td>
													<td>14-01-2019</td>
													<td>
														<input type="text" class="form-control" value="3">
														<input type="button" class="table-button plus" value="+">
														<input type="button" class="table-button minus" value="-">
													</td>
													<td>40.00</td>
													<td class="text-center"><i class="fa fa-minus-circle"></i></td>
												</tr>
												<tr>
													<td>2</td>
													<td>Panadol Plus</td>
													<td>201513</td>
													<td>14-01-2019</td>
													<td>
														<input type="text" class="form-control" value="3">
														<input type="button" class="table-button plus" value="+">
														<input type="button" class="table-button minus" value="-">
													</td>
													<td>35.00</td>
													<td class="text-center"><i class="fa fa-minus-circle"></i></td>
												</tr>

											</tbody>
											</table>
											<h4>Total: 75.00 L.E</h4>
											<h4>Discount: 0%</h4>
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
											<input type="text" class="form-control" placeholder="Customer Phone..">
										</div>
										<label>Customer Name</label>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Customer name..">
										</div>
										<label>Customer Address</label>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Address..">
										</div>
										<button type="submit" class="btn btn-default btn-info">Confirm & Print</button>
										<button type="submit" class="btn btn-default btn-success">Confirm</button>
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
