<?php
/**
 * 
 */
class AllCategory extends CI_controller
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
		$getAllCat = $this->AdminModel->getAllCat();
		//echo "<pre>";
		//print_r($getAllCat);
		$this->load->view("admin/AllCategory",["data"=>$getAllCat]);
	}
}