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
		$this->load->view("fronts/register");
	}
	public function ForgotPass()
	{
		$this->load->view("fronts/ForgotPass");
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
		$this->session->set_userdata("userId",$get->id);
		$this->session->set_flashdata("Feed","Registration Successful");
		return redirect($backUrl);
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
		$phone = $this->input->post("phone");
		$pass = $this->input->post("password");
		$pas = password_hash($pass, PASSWORD_DEFAULT);
		$this->db->where("phone",$phone);
		$this->db->update("users",["password"=>$pas]);
		$this->session->set_flashdata("Feed","Password successfully Changed");
		return redirect("Login");
	}
}