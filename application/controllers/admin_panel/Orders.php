<?php
/**
 * 
 */
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
		$this->load->view("admin/emails/EmailTemplate");
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
		
		$id = $this->input->post("order_id");
		$status = $this->input->post("status");
		$user_id = $this->input->post("user_id");
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$this->db->where("id",$id);
		$this->db->update("orders_transaction",["status"=>$status]);
		//$this->db->where(["order_id"=>$id,"user_id"=>$user_id,"status"=>$status]);
		//$this->db->update('order_status',["status_date"=>$date,"status_type"=>1]);

		$Orders = $this->AdminModel->getSingleOrder($id);

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
			if($status=="Despatched")
			{
				$hdd = "Order Despatched";
				$mmsg = "Your Order has been Confirmed and despatched for delivery.";
			}
			elseif($status=="Delivered'"){
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
		$dd = $this->email->send(); 


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
		if($status == "Pending"): $message = "Thank you for your order. Your order is pending for approval.";
			$smsCode = ""; $smsKey = ""; $smsVal = "";
		elseif($status == "Processing"): $message = "Your order has approved it is under process.";
			$smsCode = "42299"; $smsKey = "{BB}|{CC}"; $smsVal = $dt."|".$time;
		elseif($status == "Packed"): $message = "Your Order goods has been Packed and ready for Despatch.";
			$smsCode = ""; $smsKey = ""; $smsVal = "";
		elseif($status == "Despatched"): $message = "You order has been Despatched from our store. Shortly it will be on you door step.";
			$smsCode = "42348"; $smsKey = "{BB}"; $smsVal = $time;
		elseif($status == "Delivered"): $message = "Order delivered.";
			$smsCode = ""; $smsKey = ""; $smsVal = "";
		else:
		
			$message = "Your order has cancelled from us please check on you dashboard. Ypur paid amount added to your wallet.";
			$smsCode = ""; $smsKey = ""; $smsVal = "";
		endif;
		$this->db->where("id",$Orders['user_id']);
		$users = $this->db->get("users")->row();
		$phone = $users->phone;
		$fcmRegIds = $users->deviceid;
		$ordrId = $Orders['order_id'];
		$pushStatus = $this->pushNotice($fcmRegIds,$title,$message,$id,$ordrId);

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


	function pushNotice($fcmRegIds,$title,$message,$id,$ordrId)
		{

		ignore_user_abort();
   		ob_start();
		// API access key from Google FCM App Console
	
					$API_ACCESS_KEY = 'AAAATRYK8KY:APA91bFTUS2VayYqtugaMOuPYIAd_Xl2_kgZUdbISYR8NHUZvYCniJlqNakA_WpGub7M-qF1MuJs2Xu7XwswUT4ex7N6x01ypBQq6JOfTHOX4-kmrNVipMb-3k9fXb8E3VCDHlKbGgjr';

					$fcmMsg = array(
						'body' => $message,
						'title' => $title,
						'sound' => "default",
					    'color' => "#203E78",
					    
					);

					$fcmData = array('body' => $message,
						'title' => $title,
						'sound' => "default",
					    'color' => "#203E78",
					    'isGlobal'=>0,
					    'order_id'=>$ordrId,
					    'ord_id'=> $id
					);

					$fcmFields = array(
						//'to' => $registrationIDs,
						'to' => $fcmRegIds,
					        'priority' => 'high',
						'notification' => $fcmMsg,
						'data' 	=>$fcmData
					);

					//print_r($fcmMsg);

					$headers = array(
						'Authorization: key=' . $API_ACCESS_KEY,
						'Content-Type: application/json'
					);

					$ch = curl_init();
					curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
					curl_setopt( $ch,CURLOPT_POST, true );
					curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
					curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
					curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
					$result = curl_exec($ch );
					curl_close( $ch );
					//echo $result . "\n\n";


				
			
	
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
}