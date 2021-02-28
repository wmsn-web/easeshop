<?php /**
 * 
 */
class Terms_And_Condition extends CI_controller
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
		$getTerms  = $this->AdminModel->getTerms();
		$this->load->view("fronts/Terms_And_Condition",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"termsData"=>$getTerms]);
	}
}