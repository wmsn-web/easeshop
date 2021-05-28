<?php
/**
 * 
 */
class My_wallet extends CI_controller
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
  		$mywish = $this->ThemeModel->getMyWishlist($user_id);
  		$walbal = $this->ThemeModel->getWalletBal($user_id);
  		$walTr = $this->ThemeModel->getWalletTransaction($user_id);
       	$this->load->view("fronts/my_wallet",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"walbal"=>$walbal,"walTr"=>$walTr]);
       	//echo "<pre>";
       	//print_r($walTr);
	}
}