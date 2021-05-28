<?php
/**
 * 
 */
class About_Us extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$splOffer = $this->ThemeModel->splOffer();
		$getMenudata = $this->ThemeModel->getMenudata();
		$this->load->view("fronts/aboutus",["menus"=>$getMenudata,"spalOffer"=>$splOffer]);
	}
}