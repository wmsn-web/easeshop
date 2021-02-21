<?php 
/**
 * 
 */
class Home extends CI_controller
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
	
	function index()
	{
		$dashdata = $this->AdminModel->dashdata();
		//$dashdata = array();
		$this->load->view("admin/AdminHome",["dashdata"=>$dashdata]); 

	}
	function dashboard()
	{
		$dashdata = array();
		//$dashdata = $this->AdminModel->dashdata();
		$this->load->view("admin/AdminHome",["dashdata"=>$dashdata]); 
	}

	function logout()
	{
		$this->session->unset_userdata("UserAdmin");
		$this->session->set_flashdata("Feed","You have Successfully Logged out. Login Again.");
		return redirect("admin_panel/AdminLogin");
	}

	public function testSms()
	{

          
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=gcEZrm1b36kyUP5zdQfROIeXGFxCJYjVuslnAihD97qLBp0t2aiMpfojCPJSBv2VhZOgtYc7KwyQEdUk&sender_id=FSTSMS&message=".urlencode('This is a test message')."&language=english&route=p&numbers=".urlencode('7063245845'),
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

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}

}