<?php
/**
 * 
 */
class Return_Requests extends CI_controller
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
		$delBoys = $this->AdminModel->getDeliveryBoys();
		$returnRequests = $this->AdminModel->returnRequests();
		$this->load->view("admin/Return_Requests",["retrnData"=>$returnRequests,"delBoys"=>$delBoys]);
		//print_r($returnRequests);
		
	}

	public function ChangeAsign()
	{
		$id = $this->input->post("id");
		$dlbId = $this->input->post("dlbId");
		$pickUpDate = $this->input->post("pickUpDate");
		$user_id = $this->input->post("user_id");

		$this->db->where("id",$id);
		$this->db->update("order_return",['asigned_del_boy'=>$dlbId,"pickup_date"=>$pickUpDate]);
		$sms = $this->db->get("sms_set")->row();
		$smsUser= $sms->sms_user;
		$smsPass = $sms->sms_pass;
		$sender= $sms->sender;

		$this->db->where("id",$dlbId);
		$getDlb = $this->db->get("delivery_boys")->row();
		$dlbName = $getDlb->delvr_name;
		$delvr_phone = $getDlb->delvr_phone;

		$this->db->where("id",$user_id);
		$getUser = $this->db->get("users")->row();
		$name = $getUser->full_name;
		$number = $getUser->phone;

		$dt = date_create($pickUpDate);
		$ExpectDate = date_format($dt,'d')." ".date_format($dt,'F').", ".date_format($dt,'Y')." at ".date_format($dt,'h:i:s a');

		
		$message = "Dear ".$name.", Your return request has been accepted. Our pickup person ".$dlbName." ( ".$delvr_phone. " ) will reach you on ".$ExpectDate.". Thank you for your paitence ";
		/*
		$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($smsUser)."&password=".urlencode($smsPass)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//echo $curl_scraped_page = curl_exec($ch);
			curl_close($ch);
			*/
			
	}

	public function AcceptReturn($user_id='',$id='')
	{
		
			$getUserById = $this->AdminModel->getUserById($user_id);
			$this->db->where("id",$id);
			$get = $this->db->get("order_return")->row();
			$this->db->where("id",$id);
			$this->db->update("order_return",["status"=>1]);

			$this->db->where("cart_id",$get->cart_id);
			$this->db->update("cart",["returns"=>"Request Accepted"]);
			
		    
		$toEmail = $getUserById['email'];
		$this->load->library('email');
		$config = array(
		 /*         
        'protocol' => 'sendmail', 
        'smtp_host' => 'smtp.hostinger.in', 
        'smtp_port' => 587, 
        'smtp_user' => 'adminteam@easeshop.in',  
        'smtp_pass' => '@ase@2020', 
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
		$data = array();
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");
		$message = $this->load->view("admin/emails/returnRqEmail",$data,true);
		$this->email->to($toEmail);
		$this->email->from("sales@easeshop.in","Easeshop");
		$this->email->subject("Return Request Accept");
		$this->email->message($message);
		$dd = $this->email->send(); 
		//print_r($dd);

		$this->session->set_flashdata("Feed","Return Accepted");
		return redirect("admin_panel/Return_Requests");

		

	}
}