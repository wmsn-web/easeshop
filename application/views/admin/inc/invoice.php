<div class="modal fade" id="InvoiceDetails" role="dialog">
			    <div class="modal-dialog modal-lg">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Invoice</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<div id="printableArea">
			        	<div class="row">
			        		<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">Invoice</h1>
										<div class="billed-from">
											<h6 id="compName">BootstrapDash, Inc.</h6>
											<p>Email: sales@buymenow.app</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-md">
											<label class="tx-gray-600">Ship To</label>
											<div class="billed-to">
												<h6 id="username">Juan Dela Cruz</h6>
												<p><span id="addr">4033 Patterson Road, Staten Island, NY 10301</span><br>
												Tel No: <span id="tel">324 445-4544</span><br>
												Email: <span id="email">youremail@companyname.com</span></p>
											</div>
										</div>
										<div class="col-md">
											<label class="tx-gray-600">Invoice Information</label>
											<p class="invoice-info-row"><span>Invoice No</span> <span id="invNo"></span></p>
											<p class="invoice-info-row"><span>Order ID</span> <span id="orderId">32334300</span></p>
											<p class="invoice-info-row"><span>Issue Date:</span> <span id="fuldate">November 21, 2017</span></p>
											
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="wd-20p">Image</th>
													<th class="wd-40p">Description</th>
													<th class="tx-center">QNTY</th>
													<th class="tx-right">Unit Price</th>
													<th class="tx-right">Amount</th>
												</tr>
											</thead>
											<tbody id="cartData"></tbody>
										</table>
									</div>
									
								</div>
							</div>
						</div>
					</div>
			        	</div>
			        	<a class="btn btn-primary mg-t-40 float-right" onclick="printDiv('printableArea')" href="#">Print</a>
			        </div>
			        </div>
			        
			      </div>
			      
			    </div>
			  </div>