<?php
/**
 * 
 */
class Home extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model("ThemeModel");
	}

	public function index()
	{
		$getMenudata = $this->ThemeModel->getMenudata();
		$this->load->view("fronts/Home",["menus"=>$getMenudata]);
		//echo password_hash("Admin123456", PASSWORD_DEFAULT);
		//echo "<pre>";
		//print_r($getMenudata);
	}
}