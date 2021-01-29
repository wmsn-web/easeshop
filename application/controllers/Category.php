<?php
/**
 * 
 */
class Category extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model("ThemeModel");
	}

	public function index()
	{

	}

	public function Items($brand)
	{
		echo $brand;
	}
}