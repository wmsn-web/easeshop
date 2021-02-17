<?php
/**
 * 
 */
class pgResponse extends CI_controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}
 	public function index()
 	{
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");

		// following files need to be included
		require_once("./lib/config_paytm.php");
		require_once("./lib/encdec_paytm.php");

		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";

		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


		if($isValidChecksum == "TRUE") {
			//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				$orderId = $_POST['ORDERID'];
				$status = $_POST["STATUS"];
				$txnid = $_POST['TXNID'];
				$this->db->where("order_id",$orderId);
				$gets = $this->db->get("orders_transaction")->row();
				$user = $gets->user_id;
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d');
				$cartids = html_entity_decode($gets->cart_id);
				$cartIds = json_decode($cartids);
				foreach($cartIds as $crtId)
				{
					$this->db->where("cart_id",$crtId->cart_id);
					$this->db->update("cart",["status"=>1]);
				}
				$txnData = array
								(
									"pay_method"		=>"payTm",
									"txnid"				=>$txnid,
									"payment_status"	=>$status,
									"payment_date"		=>$date,
									"status"			=>"Processing"
								);
				$this->db->where("order_id",$orderId);
				$this->db->update("orders_transaction",$txnData); 
				$this->session->set_userdata("userId",$user);
				$this->session->set_flashdata("Feed","Transaction Successfull!");
				return redirect("My-Cart");
			}
			else {
				
				$orderId = $_POST['ORDERID'];
				$status = $_POST["STATUS"];
				$txnid = $_POST['TXNID'];
				$this->db->where("order_id",$orderId);
				$gets = $this->db->get("orders_transaction")->row();
				$user = $gets->user_id;
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d');
				$this->db->where("order_id",$orderId);
				$this->db->delete("orders_transaction");
				/*
				$this->db->update("orders_transaction",["pay_method"=>"payTm","txnid"=>$txnid,"payment_status"=>$status,"payment_date"=>$date]); */
				$this->session->set_userdata("userId",$user);
				$this->session->set_flashdata("Feed","Transaction Failed!");
				return redirect("My-Cart");
			}
			/*
			if (isset($_POST) && count($_POST)>0 )
			{ 
				foreach($_POST as $paramName => $paramValue) {
						echo "<br/>" . $paramName . " = " . $paramValue;
				}
			} */
			

		}
		else {
			echo "<b>Checksum mismatched.</b>";
			//Process transaction as suspicious.
		}
	}
}

?>