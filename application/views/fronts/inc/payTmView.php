<form id="checkout" method="post" action="<?= base_url('pgRedirect'); ?>"> 
		<input id="ORDER_ID" tabindex="1" maxlength="20" size="20" type="hidden"
			name="ORDER_ID"  value='<?= rand(); ?>'>
		<input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?= $this->session->userdata('userId'); ?>">
		<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
		<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
		<input type="hidden" title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="<?= $cartData['grand']; ?>">
		<input value="CheckOut" type="hidden" 	onclick="">
	</form>