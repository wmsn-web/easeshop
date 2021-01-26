<?php 
/**
 * 
 */
class ChangePassword extends CI_controller
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
		$this->load->view("admin/ChangePassword");
	}

	public function chps()
	{
		$pass = $this->input->post("password");
		$pwd = password_hash($pass, PASSWORD_DEFAULT);
		$this->db->where("admin_user","admin");
		$this->db->update("admin",["password"=>$pwd]);
		$this->session->unset_userdata("UserAdmin");
		$this->session->set_flashdata("Feed","Password Changed Successfully. Please login with new password.");
		return redirect("admin_panel/AdminLogin");

	}
}