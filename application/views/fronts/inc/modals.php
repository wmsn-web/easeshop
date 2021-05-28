<div class="modal fade" id="WalletModal" role="dialog">
			    <div class="modal-dialog modal-sm">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Wallet Balance</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<h4>You have <b class="text-success">&#8377; <?= $walbal; ?></b></h4>
			        	<p>You are able to purchase with your wallet balance only <?= $settings['wallet_pay_percent']; ?>%</p><p>Pay with wallet will apply automatically.</p>
			        	<small><a href="">T&c Apply</a></small>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>