<?php
/**
 * 
 */
class PayU extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function success()
	{
		$status=$_POST["status"];
		$firstname=$_POST["firstname"];
		$amount=$_POST["amount"];
		$txnid=$_POST["txnid"];
		$posted_hash=$_POST["hash"];
		$key=$_POST["key"];
		$productinfo=$_POST["productinfo"];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$salt="Ir8qVihIW0";

		if (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo $status;
		   } else {
		   		$this->db->where("order_id",$productinfo);
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
				//Update Order Transaction
					$txnData = array
									(
										"pay_method"		=>"PauMoney",
										"txnid"				=>$txnid,
										"payment_status"	=>$status,
										"payment_date"		=>$date,
										"status"			=>"Processing"
									);
					$this->db->where("order_id",$productinfo);
					$this->db->update("orders_transaction",$txnData);
				//Update Order Transaction end
		   	$this->db->where("phone",$phone);
		   	$gtU = $this->db->get("users");
		   	$gtUr = $gtU->row();
		   	$userId = $gtUr->id;

		   	$this->session->set_userdata("userId",$gtUr->id);

		   	//Send Email and SMS
		   	if(!empty($email)):
					$sndMl = $this->sendMails($email,$productinfo);
					//print_r($sndMl);
					$this->load->library('email');
					$config = array(
					         
			        'protocol' => 'sendmail', 
			        'smtp_host' => 'smtp.hostinger.in', 
			        'smtp_port' => 587, 
			        'smtp_user' => 'adminteam@easeshop.in',  
			        'smtp_pass' => 'Easeshop@2021', 
			        'mailtype' => 'html', 
			        'charset' => 'iso-8859-1'
			        /*
			        'protocol' => 'smtp', 
			        'smtp_host' => 'ssl://smtp.gmail.com', 
			        'smtp_port' => 465, 
			        'smtp_user' => 'solutions.web2019@gmail.com', 
			        'smtp_pass' => 'Goodnight88$$', 
			        'mailtype' => 'html', 
			        'charset' => 'iso-8859-1'
			        */
					);
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->set_newline("\r\n");

					$mesage = $this->load->view("admin/emails/orderSubmit",["mailData"=>$sndMl],TRUE);

					$this->email->to($email);
					$this->email->from("admin@easeshop.in","easeshop");
					$this->email->subject("Order Status");
					$this->email->message($mesage);
					//$dd = "";
					$dd = $this->email->send();
					//print_r($dd);
				endif;
				//$this->session->set_userdata("userId",$user);
				$this->session->set_flashdata("Feed","Transaction Successfull!");
				if($dd == TRUE)
				{
					return redirect("My-Orders");
				}
				return redirect("My-Orders");
				//print_r($mesage);
		   }
	}
	public function failed()
	{
		$status=$_POST["status"];
		$firstname=$_POST["firstname"];
		$amount=$_POST["amount"];
		$txnid=$_POST["txnid"];
		$posted_hash=$_POST["hash"];
		$key=$_POST["key"];
		$productinfo=$_POST["productinfo"];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$salt="wTepCSFvaL";

		$this->db->where("phone",$phone);
		   	$gtU = $this->db->get("users");
		   	$gtUr = $gtU->row();
		   	$userId = $gtUr->id;
		   	$this->session->set_userdata("userId",$gtUr->id);
		   	$this->session->set_flashdata("Feed","Transaction Failed!");
		   	return redirect("My-Cart");
	}

	public function sendMails($email,$productinfo)
	{
		$this->db->where("order_id",$productinfo);
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
}