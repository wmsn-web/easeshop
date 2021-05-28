<?php
/**
 * 
 */
class Login extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata("userId"))
		{
			return redirect(base_url());
		}
	}

	public function index()
	{
		//echo $_SERVER['HTTP_REFERER'];
		//echo $useragent=$_SERVER['HTTP_USER_AGENT'];
		$this->load->view("fronts/userLogin");
	}

	public function Register()
	{
		$this->load->view("fronts/registerNew");
	}
	public function ForgotPass()
	{
		$this->load->view("fronts/ForgotPassNew");
	}
	public function verifyExist()
	{
		$number = $this->input->post("number");
		$this->db->where("phone",$number);
		$get = $this->db->get("users")->num_rows();
		if($get==0)
		{
			echo "ok";
		}
		else
		{
			echo "no";
		}
	}

	public function ProcessReg()
	{
		$name = $this->input->post("name");
		$phone = $this->input->post("phone");
		$backUrl = $this->input->post("backUrl");
		$deviceid = $this->input->post("deviceid");
		$pass = $this->input->post("password");
		$pas = password_hash($pass, PASSWORD_DEFAULT);
		$data = array
					(
						"full_name"	=>$name,
						"password"	=>$pas,
						"phone"		=>$phone,
						"deviceid"	=>$deviceid
					);
		$this->db->insert("users",$data);
		$this->db->where("phone",$phone);
		$get = $this->db->get("users")->row();
		$sms = $this->GetSms($phone);
		$this->session->set_userdata("userId",$get->id);
		$this->session->set_flashdata("Feed","Registration Successful");
		return redirect($backUrl);
		//echo $sms;
	}

	public function loginProcess()
	{
		$phone = $this->input->post("phone");
		$pass = $this->input->post("password");
		$deviceid = $this->input->post("deviceid");
		$backUrl = $this->input->post("backUrl");
		$this->db->where("phone",$phone);
		$get = $this->db->get("users");
		if($get->num_rows()==0)
		{
			$this->session->set_flashdata("Feed","Invalid Mobile number");
			$this->session->set_flashdata("Bk",$backUrl);
			return redirect("Login");
		}
		else
		{
			$row = $get->row();
			//print_r($pass);
			//echo password_hash("123456789", PASSWORD_DEFAULT);

			if(!password_verify($pass, $row->password))
			{
				$this->session->set_flashdata("Feed","Invalid Password");
				$this->session->set_flashdata("Bk",$backUrl);
				return redirect("Login");
			}
			else
			{
				$this->db->where("phone",$phone);
				$this->db->update("users",["deviceid"=>$deviceid]);
				$this->session->set_userdata("userId",$row->id);
				$this->session->set_flashdata("Feed","Login Successful");
				return redirect($backUrl);
			}
		}
	}

	public function ChangePassword()
	{
		$phone = $this->input->post("fphone");
		$pass = $this->input->post("password");
		$pas = password_hash($pass, PASSWORD_DEFAULT);
		$this->db->where("phone",$phone);
		$this->db->update("users",["password"=>$pas]);
		$this->session->set_flashdata("Feed","Password successfully Changed");
		return redirect("Login");
	}

	public function GetSms()
	{
		$phone = $this->input->post("phone");
		$otp = mt_rand(000000,999999);
		$this->db->where("phone",$phone);
		$this->db->update("users",["verification_code"=>$otp]);
		$this->db->insert("code_verify",["phone"=>$phone,"code"=>$otp]);
		$sms = $this->db->get("sms_set")->row();
		$smsUser= "easeshop"; //$sms->sms_user;
		$smsPass = "summer@2021";//$sms->sms_pass;
		$number=$phone;
		$sender= "EASESP";//$sms->sender;
		$template_id = "1507161591600771088";
		//$message = "Dear User, Your OTP is ".$otp." Don't share your OTP with anyone. Regards www.easeshop.in";
		$message = "Dear User your OTP number is ".$otp." . Regards easeshop.in";
		$url="https://login.bulksmsgateway.in/sendmessage.php?user=".urlencode($smsUser)."&password=".urlencode($smsPass)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3')."&template_id=".urlencode($template_id);
		/*
			$ch = curl_init($url);
			$ccrl = curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			 $curl_scraped_page = curl_exec($ch);
			 //print_r($curl_scraped_page);
			curl_close($ch); 
		*/

		$ccrl = file_get_contents($url);
		$res = json_decode($ccrl);
		//print_r($ccrl);
		echo $res->status; 
			//echo "success";

	}

	public function verifyCodes()
	{
		$phone = $this->input->post("phone");
		$code = $this->input->post("code");
		if(empty($code))
		{
			echo "empty";
		}
		else
		{
			$this->db->where(["phone"=>$phone,"verification_code"=>$code]);
			$gt = $this->db->get("users")->num_rows();
			if($gt >0)
			{
				$this->db->where(["phone"=>$phone,"code"=>$code]);
				$this->db->delete("code_verify");
				echo "ok";
			}
			else
			{
				echo "empty";
			}
		}
	}

	public function verifyCodesReg()
	{
		$phone = $this->input->post("phone");
		$code = $this->input->post("code");
		if(empty($code))
		{
			echo "empty";
		}
		else
		{
			$this->db->where(["phone"=>$phone,"code"=>$code]);
			$gt = $this->db->get("code_verify")->num_rows();
			if($gt >0)
			{
				$this->db->where(["phone"=>$phone]);
				$this->db->delete("code_verify");
				echo "ok";
			}
			else
			{
				echo "empty";
			}
		}
	}
}