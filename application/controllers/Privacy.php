<?php /**
 * 
 */
class Privacy extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
	}

	public function index()
	{
		$splOffer = $this->ThemeModel->splOffer();
		$getMenudata = $this->ThemeModel->getMenudata();
		$getPrivacy = $this->AdminModel->getPrivacy();
		$this->load->view("fronts/Privacy",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"privacyData"=>$getPrivacy]);
	}
}