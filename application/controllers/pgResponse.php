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

				$this->db->where("id",$gets->user_id);
				$gtUser = $this->db->get("users")->row();
				$phone = $gtUser->phone;
				$email = $gtUser->email;
				//Send SMS
				//$snd = $this->sendSms($phone);

				if(!empty($email)):
					$sndMl = $this->sendMails($email,$orderId);
					//print_r($sndMl);
					$this->load->library('email');
					$config = array(
					          
			        'protocol' => 'smtp', 
			        'smtp_host' => 'smtp.hostinger.in', 
			        'smtp_port' => 587, 
			        'smtp_user' => 'adminteam@easeshop.in',  
			        'smtp_pass' => '@ase@2020', 
			        'mailtype' => 'html', 
			        'charset' => 'iso-8859-1'
			        /*
			      	
			        'protocol' => 'smtp', 
			        'smtp_host' => 'ssl://smtp.gmail.com', 
			        'smtp_port' => 465, 
			        'smtp_user' => 'solutions.web2019@gmail.com', 
			        'smtp_pass' => 'Goodnight88', 
			        'mailtype' => 'html', 
			        'charset' => 'iso-8859-1'
			        */
					);
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");

					$mesage = $this->load->view("admin/emails/orderSubmit",["mailData"=>$sndMl],TRUE);

					$this->email->to($email);
					$this->email->from("admin@easeshop.in","Easeshop");
					$this->email->subject("Order Status");
					$this->email->message($mesage);
					$dd = $this->email->send();
				endif;
				$this->session->set_userdata("userId",$user);
				$this->session->set_flashdata("Feed","Transaction Successfull!");
				return redirect("My-Orders");
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


	public function sendSms($phone)
	{
		$sms = $this->db->get("sms_set")->row();
		$smsUser= $sms->sms_user;
		$smsPass = $sms->sms_pass;
		$number=$phone;
		$sender= $sms->sender;
		$message = "Dear Customer, Thanks for your Order. Your order has been placed successfully. We will notify you on Next update. ";

		$url="https://login.bulksmsgateway.in/sendmessage.php?user=".urlencode($smsUser)."&password=".urlencode($smsPass)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch); 
	}

	public function sendMails($email,$orderId)
	{
		$this->db->where("order_id",$orderId);
		$gets = $this->db->get("orders_transaction")->row();
	 	$cartId = html_entity_decode($gets->cart_id);
		 $carts = json_decode($cartId);
	 	foreach($carts as $cart)
			{
				$this->db->where("cart_id",$cart->cart_id);
				$getCrt = $this->db->get("cart")->row();
				$this->db->where("pro_id",$getCrt->product_id);
				$getPro = $this->db->get("products")->row();
				$cartData[] = array
									(
										"product_name"	=>$getPro->product_name,
										"qty"			=>$getCrt->qty,
										"price"			=>$getCrt->price,
										"mnImg"			=>$getPro->main_img,
										"returnable"	=>$getPro->returnable,
										"status"		=>$gets->status,
										"returns"		=>$getCrt->returns,
										"cart_id"		=>$getCrt->cart_id
									);
			}
			$data = array("datas"=>$gets->gross_total,"cartData"=>$cartData);
		return $data;
	}
}

?>