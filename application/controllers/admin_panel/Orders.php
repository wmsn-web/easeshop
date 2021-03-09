<?php 

class Orders extends CI_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		if(!$this->session->userdata("UserAdmin"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			return redirect("admin_panel/AdminLogin?refer=$actual_link");
		
		}
	}

	public function index()
	{
		//$this->load->view("admin/emails/EmailTemplate");
	}
	
	function NewOrders()
	{
		$delBoys = $this->AdminModel->getDeliveryBoys();
		$sttat = $this->uri->segment(4);
		$NewOrders = $this->AdminModel->newOrders($sttat); 
		//$NewOrders = $this->AdminModel->getSingleOrder();
		$this->load->view("admin/NewOrders",["orderData"=>$NewOrders,"delBoys"=>$delBoys]);
		//$data = array("orderId"=>"1234","name"=>"sanjay","email"=>"sn@gmail", "phone"=>"123456789", "addr"=>"address","city"=>"city","pin"=>"741222","dates"=>"2020-02-21","price"=>"7038.00","msgs"=>"message for you","hdd"=>"proooo","lm"=>"locatioin");
		//$this->load->view("admin/emails/EmailTemplate.php",$data); 
		//echo "<pre>"; 
		//print_r($NewOrders);

		//$string = "123,456,78,000";  
 

	}

	function orderDetails()
	{
		$id = $this->input->post("id");
		$Orders = $this->AdminModel->getSingleOrder($id);
		echo json_encode($Orders);
	}

	public function ChangeStatus()
	{
		
		 $id = 6; // $this->input->post("order_id");
		$status = "Cancel"; //$this->input->post("status");
		$user_id = 6; // $this->input->post("user_id");
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$this->db->where("id",$id);
		//$this->db->update("orders_transaction",["status"=>$status]);
		//$this->db->where(["order_id"=>$id,"user_id"=>$user_id,"status"=>$status]);
		//$this->db->update('order_status',["status_date"=>$date,"status_type"=>1]);

		$Orders = $this->AdminModel->getSingleOrder($id);

		$this->load->library('email');
		$config = array(
		 /*        
        'protocol' => 'sendmail', 
        'smtp_host' => 'smtp.hostinger.in', 
        'smtp_port' => 587, 
        'smtp_user' => 'adminteam@easeshop.in',  
        'smtp_pass' => 'Ease@2020', 
        'mailtype' => 'html', 
        'charset' => 'iso-8859-1'
        */
      	
        'protocol' => 'smtp', 
        'smtp_host' => 'ssl://smtp.gmail.com', 
        'smtp_port' => 465, 
        'smtp_user' => 'solutions.web2019@gmail.com', 
        'smtp_pass' => 'Goodnight88', 
        'mailtype' => 'html', 
        'charset' => 'iso-8859-1'
        
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
			if($status=="Despatched")
			{
				$hdd = "Order Despatched";
				$mmsg = "Your Order has been Confirmed and despatched for delivery.";
			}
			elseif($status=="Delivered"){
				$hdd = "Order Delivered";
				$mmsg = "Your Ordered Product has been delivered.";
			}
			else
			{
				$hdd = "Order Cancelled";
				$mmsg = "Your order has been cancelled by us amount will be credited on your bank account within 5 days.";
			}
		$data = array("orderId"=>$Orders['order_id'],"name"=>$Orders['shipFullName'],"email"=>$Orders['email'], "phone"=>$Orders['shipContact'], "addr"=>$Orders['shipAddr'],"city"=>$Orders['shipCity'],"pin"=>$Orders['shipPin'],"dates"=>$Orders['fullDate'],"price"=>$Orders['grossTotal'],"msgs"=>$mmsg,"hdd"=>$hdd,"lm"=>$Orders['nearLocation']);

		$mesage = $this->load->view("admin/emails/EmailTemplate.php",$data,TRUE);
		$this->email->to($Orders['email']);
		$this->email->from("sales@easeshop.in","Easeshop");
		$this->email->subject("Order Status");
		$this->email->message($mesage);
		//$dd = $this->email->send(); 


		$this->db->where("order_id",$Orders['order_id']);
		$getSlot = $this->db->get("slot_save");
		if($getSlot->num_rows()==0)
		{
			$time = "";
			$dt = "";
		}
		else
		{
			$rowSl = $getSlot->row();
			$time = $rowSl->slot_details;
			$dt = $rowSl->slot_date;
		}
		
		
		$title = "Order Status";
		
		
		if($status == "Despatched"): $message = "You order has been Despatched from our store. Shortly it will be on you door step.";
			$snd = "";
			
		elseif($status == "Delivered"): $message = "Order delivered.";
			$this->db->where("id",$Orders['user_id']);
			$users = $this->db->get("users")->row();
			$phone = $users->phone;
			 $snd = "";
			
		else:
		
			$message = "Your order has cancelled from us please check on you dashboard. Your paid amount will be refund on your bank account within 5 days.";

			$this->db->where("id",$Orders['user_id']);
			$users = $this->db->get("users")->row();
			$phone = $users->phone;
			 $snd = $this->sendSms($phone,$message);
			
		endif;
		//echo 
		

		/*
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=gcEZrm1b36kyUP5zdQfROIeXGFxCJYjVuslnAihD97qLBp0t2aiMpfojCPJSBv2VhZOgtYc7KwyQEdUk&sender_id=NOWBUY&language=english&route=qt&numbers=".urlencode($phone)."&message=".urldecode($smsCode)."&variables=".urlencode($smsKey)."&variables_values=".urlencode($smsVal)."",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));
        

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        */
	}


	


				
			
	
	

	public function CancelStatus()
	{
		$id = $this->input->post("order_id");
		$status = $this->input->post("status");
		$user_id = $this->input->post("user_id");
		$amt = $this->input->post("amt");

		$this->db->where("user_id",$user_id);
		$row = $this->db->get("wallet")->row();
		$bal = $row->balance + $amt;

		$this->db->where("user_id",$user_id);
		$this->db->update("wallet",["balance"=>$bal]);

		$this->db->where("id",$id);
		$this->db->update("orders_transaction",["status"=>$status,"cancel_by"=>"admin"]);
	}

	public function ChangeAsign()
	{
		$id = $this->input->post("order_id");
		$dlbId = $this->input->post("dlbId");
		$this->db->where("id",$id);
		$this->db->update("orders_transaction",["asigned_delivery_boy"=>$dlbId]);
		echo "Delivery Boy Asigned.";
		
	}
	public function PaymentStatus($id='')
	{
		$this->db->where("id",$id);
		$this->db->update("orders_transaction",["payment_status"=>"Paid"]);
		$this->session->set_flashdata("Feed","Payment Status Successfully Changed");
		return redirect("admin_panel/Orders/NewOrders/Delivered");
	}

	public function sendSms($phone,$message)
	{
		$sms = $this->db->get("sms_set")->row();
		$smsUser= $sms->sms_user;
		$smsPass = $sms->sms_pass;
		$number=$phone;
		$sender= $sms->sender;
		
		

		$url="https://login.bulksmsgateway.in/sendmessage.php?user=".urlencode($smsUser)."&password=".urlencode($smsPass)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
		
			//$ch = curl_init($url);
			//curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//echo  $curl_scraped_page = curl_exec($ch);
			//curl_close($ch); 
		
		echo file_get_contents($url);
	}
}