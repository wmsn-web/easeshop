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
		$useragent= md5($_SERVER['HTTP_USER_AGENT']);
		$this->db->where("deviceid",$useragent);
		$getUser = $this->db->get("users");
		if($getUser->num_rows()==1)
		{
			$row = $getUser->row();
			$this->session->set_userdata("userId",$row->id);
		}
	}

	public function index()
	{

		//$this->session->unset_userdata("userId");
		$getMenudata = $this->ThemeModel->getMenudata();
		$getBanner = $this->ThemeModel->getBanner();
		$newProd = $this->ThemeModel->getNewProducts();
		$splOffer = $this->ThemeModel->splOffer();
		$fetPro = $this->ThemeModel->fetPro();
		$getCat = $this->ThemeModel->getCat();
		$getMorePro = $this->ThemeModel->getMorePro();
		$this->load->view("fronts/Home",["menus"=>$getMenudata,"banData" => $getBanner, "new_pro"=>$newProd,"spalOffer"=>$splOffer,"cats"=>$getCat,"fetPro"=>$fetPro,"morePro"=>$getMorePro ]);
		
		//echo "<pre>";
		//print_r($getMorePro);
	}
}