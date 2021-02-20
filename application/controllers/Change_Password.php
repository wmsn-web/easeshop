<?php
/**
 * 
 */
class Change_Password extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userId"))
		{
			return redirect("Login");
		}
	}

	public function index()
	{
	 $splOffer = $this->ThemeModel->splOffer();
		$getMenudata = $this->ThemeModel->getMenudata();
		$user_id = $this->session->userdata("userId");
  		$getUser = $this->ThemeModel->getUserDetails($user_id);
  		$getMyOrders = $this->ThemeModel->getMyOrders($user_id);
		$this->load->view("fronts/Change_Password",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"getUser"=>$getUser,"ordData"=>$getMyOrders]);
	}

	public function Chpass()
	{
		$userId = $this->input->post("userid");
		$oldPass = $this->input->post("oldPass");
		$newPass = $this->input->post("newPass");
		$nps = password_hash($newPass, PASSWORD_DEFAULT);
		$this->db->where("id",$userId);
		$get = $this->db->get("users")->row();
		$olp = $get->password;
		if(!password_verify($oldPass, $olp))
		{
			$this->session->set_flashdata("Feed","Invalid Old Password!");
			return redirect('Change-Password');
		}
		else
		{
			$this->db->where("id",$userId);
			$this->db->update("users",["password"=>$nps]);
			$this->session->set_flashdata("Feed","Password Changed");
			$this->session->unset_userdata("userId");
			return redirect('Change-Password');
		}
	}
}