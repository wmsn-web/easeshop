<?php
/**
 * 
 */
class My_Account extends CI_controller
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
		$this->load->view("fronts/My_Account",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"getUser"=>$getUser]);
	}
}