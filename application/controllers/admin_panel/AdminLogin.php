<?php
/**
 * 
 */
class AdminLogin extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		if($this->session->userdata("UserAdmin")){
			return redirect("admin_panel/dashboard");
		}
		
		
	}

	function index()
	{
		$this->load->view("admin/AdminLogin");
	}

	function loginProcess()
	{
		$user = $this->input->post("username");
		$password = $this->input->post("password");
		$getUser = $this->AdminModel->getUser($user); 
		$num = $getUser->num_rows();
		$row = $getUser->row();
		$pawd = $row->password;//taken from database
		if($num ==0)
		{
			$this->session->set_flashdata("Feed","Invalid Username!");
			return redirect("admin_panel/AdminLogin");
		}
		if (password_verify($password, $pawd)) {
				$back = base_url('admin_panel/Home/dashboard');
				if($_GET['refer'] == "")
			{
				$back = base_url('admin_panel/Home/dashboard');
			}
			else
			{
				$back = $_GET['refer'];
			}
				$this->session->set_userdata("UserAdmin",$user);
				return redirect($back);

		}else{
			$this->session->set_flashdata("Feed","Invalid Password!");
			return redirect("admin_panel/AdminLogin");
		}

		

	}
}