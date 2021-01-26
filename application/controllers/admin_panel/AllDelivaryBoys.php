<?php
/**
 * 
 */
class AllDelivaryBoys extends CI_controller
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
		$this->load->view("admin/AllDelivaryBoys",["delBoys"=>$delBoys]);
		//print_r($delBoys);
	}

	public function getDelBId()
	{
		$id = $this->input->post("id");
		$getDelBbyId = $this->AdminModel->getDelBbyId($id);
	}
}