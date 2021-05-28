<?php 
/**
 * 
 */
class PgResponse extends CI_controller
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
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); 
		//echo "<pre>";
		//print_r($paramList);
		
		
		if($isValidChecksum == "TRUE") {
			//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				$orderId = $_POST['ORDERID'];
				$status = $_POST["STATUS"];
				$txnid = $_POST['TXNID'];
				$this->db->where("order_id",$orderId);
				$gets = $this->db->get("orders_transaction")->row();



				$paymode = $_POST['PAYMENTMODE'];
				$bankName = $_POST['BANKNAME'];
				$this->db->where("order_id",$orderId);
				$gets2 = $this->db->get("orders_transaction")->row();
				$cartids = html_entity_decode($gets2->cart_id);
				$cartIds = json_decode($cartids);
				


				$user = $gets->user_id;
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d');

				if(!empty($gets->wallet_pay))
				{
					$saveData = array
									(
										"user_id"		=>$gets->user_id,
										"orderid"		=>$orderId,
										"proid_notes"	=>"use_cashbackwidthdraw",
										"withdraw"		=>$gets->wallet_pay,
										"date"			=>date('Y-m-d h:i:s')
									);
					$this->db->insert("user_wallet",$saveData);
				}

				foreach($cartIds as $crtId)
				{
					$this->db->where("cart_id",$crtId->cart_id);
					$gtCart = $this->db->get("cart")->row();
					$this->db->where("pro_id",$gtCart->product_id);
					$gtPro = $this->db->get("products")->row();

					if(!empty($gtCart->variation_name))
					{
						$vars = explode("_",$gtCart->variation_name); 
						$pricePro = $vars[1];
					}
					else
					{
						$pricePro = $gtCart->sale_price; 
					}

					$cash = $this->cashbackAsign($gtPro->id,$paymode,$pricePro,$bankName,$gets2->user_id,$orderId);
					
				}

				$cartids = html_entity_decode($gets->cart_id);
				$cartIds = json_decode($cartids);
				foreach($cartIds as $crtId)
				{
					$this->db->where("cart_id",$crtId->cart_id);
					$this->db->update("cart",["status"=>1]);
				}
				$txnData = array
								(
									"pay_method"		=>$paymode."_".$bankName,
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
				$snd = $this->sendSms($phone,$gets2->gross_total);
				//echo $snd;

				if(!empty($email)):
					$sndMl = $this->sendMails($email,$orderId);
					//print_r($sndMl);
					$this->load->library('email');
					$config = array(
					      
			        'protocol' => 'SMTP', 
			        'smtp_host' => 'mail.easeshop.in', 
			        'smtp_port' => 465, 
			        'smtp_user' => '_mainaccount@easeshop.in',  
			        'smtp_pass' => 'n@f535EXqDd7#K', 
			        'mailtype' => 'html', 
			        'charset' => 'iso-8859-1'
			        
					);
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");

					$mesage = $this->load->view("admin/emails/orderSubmit",["mailData"=>$sndMl],TRUE);

					$this->email->to($email);
					$this->email->from("admin@easeshop.in","easeshop");
					$this->email->subject("Order Status");
					$this->email->message($mesage);
					$dd = $this->email->send();
					//print_r($dd);
				endif;
				$this->session->set_userdata("userId",$user);
				$this->session->set_flashdata("Feed","Transaction Successfull!");
				if($dd == TRUE)
				{
					return redirect("My-Orders");
				}
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
				
				$this->session->set_userdata("userId",$user);
				$this->session->set_flashdata("Feed","Transaction Failed!");
				return redirect("My-Cart");
			}
			

		}
		else {
			echo "<b>Checksum mismatched.</b>";
			
		}
		
	}


	public function sendSms($phone,$amount)
	{
		$sms = $this->db->get("sms_set")->row();
		$smsUser= $sms->sms_user;
		$smsPass = $sms->sms_pass;
		$number=$phone;
		$sender= $sms->sender;
		$template_id = "1507161959378710374";
		$message = "Thanks for your order from us. Your easeshop Pay Balance is credited INR ".$amount." and   current Pay balance is INR ".$amount.". Regards easeshop";

		$url="https://login.bulksmsgateway.in/sendmessage.php?user=".urlencode($smsUser)."&password=".urlencode($smsPass)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3')."&template_id=".urlencode($template_id); 
		/*
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			curl_close($ch); */
			echo file_get_contents($url);

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
				if(!empty($getCrt->variation_name))
				{
					$vr = explode("_", $getCrt->variation_name);
					$varName = "--".$vr[2];
				}
				else
				{
					$varName = "";
				}
				$cartData[] = array
									(
										"product_name"	=>$getPro->product_name,
										"qty"			=>$getCrt->qty,
										"price"			=>$getCrt->price,
										"mnImg"			=>$getPro->main_img,
										"returnable"	=>$getPro->returnable,
										"status"		=>$gets->status,
										"returns"		=>$getCrt->returns,
										"cart_id"		=>$getCrt->cart_id,
										"varName"		=>$varName
									);
			}
			$data = array("datas"=>$gets->gross_total,"cartData"=>$cartData);
		return $data;
	}

	public function cashbackAsign($proId,$paymode,$pricePro,$bankName,$user_id,$orderId)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->db->where("pro_id",$proId);
		$getOffer = $this->db->get("cash_back_offer");
		if($getOffer->num_rows()==0)
		{
			return FALSE; // No Offer available
		}
		else
		{

			$offer = $getOffer->row();
			$dateLimit = strtotime($offer->date_limit);
			$today = strtotime(date('Y-m-d'));

			if($offer->offer_type == "Flat")
			{
				$cashBackPrice = $offer->offer_value;
			}
			else
			{
				$per = $offer->offer_value /100;
				$cashBackPrice = $pricePro*$per;
			}

			if($dateLimit > $today)
			{
				if($paymode == "CC")
				{
					$this->db->where(["pro_id"=>$proId,"bank"=>$bankName]);
					$gtCr = $this->db->get("credit_bank")->num_rows();
					if($gtCr > 0)
					{
						$saveData = array
										(
											"user_id"		=>$user_id,
											"orderid"		=>$orderId,
											"proid_notes"	=>$proId."_cashback",
											"deposit"		=>$cashBackPrice,
											"date"			=>date('Y-m-d h:i:s')
										);
						$this->db->insert("user_wallet",$saveData);
					}
					else
					{
						return false; //Bank is not valid
					}
				}
				elseif($paymode == "DC")
				{
					$this->db->where(["pro_id"=>$proId,"bank"=>$bankName]);
					$gtCr = $this->db->get("debit_bank")->num_rows();
					if($gtCr > 0)
					{
						$saveData = array
										(
											"user_id"		=>$user_id,
											"orderid"		=>$orderId,
											"proid_notes"	=>$proId."_cashback",
											"deposit"		=>$cashBackPrice,
											"date"			=>date('Y-m-d h:i:s')
										);
						$this->db->insert("user_wallet",$saveData);
					}
				}
				elseif($paymode == "upi")
				{
					$saveData = array
									(
										"user_id"		=>$user_id,
										"orderid"		=>$orderId,
										"proid_notes"	=>$proId."_cashback",
										"deposit"		=>$cashBackPrice,
										"date"			=>date('Y-m-d h:i:s')
									);
					$this->db->insert("user_wallet",$saveData);
				}
				//return $pricePro;
			}
			else
			{
				return false; //Date expired
			}
			
		}
	}
}

?>