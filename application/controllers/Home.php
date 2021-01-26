<?php
/**
 * 
 */
class Home extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("fronts/Home");
		//echo password_hash("Admin123456", PASSWORD_DEFAULT);
	}
}