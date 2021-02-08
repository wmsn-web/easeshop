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
		$getBanner = $this->ThemeModel->getBanner();
		$newProd = $this->ThemeModel->getNewProducts();
		$splOffer = $this->ThemeModel->splOffer();
		$fetPro = $this->ThemeModel->fetPro();
		$getCat = $this->ThemeModel->getCat();
		$this->load->view("fronts/Home",["menus"=>$getMenudata,"banData" => $getBanner, "new_pro"=>$newProd,"spalOffer"=>$splOffer,"cats"=>$getCat,"fetPro"=>$fetPro ]);
		
		//echo "<pre>";
		//print_r($getCat);
	}
}