<?php
/**
 * 
 */
class Product_details extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		
	}

	public function index($proId="")
	{
		$getProDetailsById = $this->ThemeModel->getProDetailsById($proId);
		//echo "<pre>";
		//print_r($getProDetailsById);
		$splOffer = $this->ThemeModel->splOffer();
		$getMenudata = $this->ThemeModel->getMenudata();
		if(!empty($getProDetailsById))
        {
		   $this->load->view("fronts/product_details",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"proData"=>$getProDetailsById]);
		}
		else
		{
			return redirect(base_url());
		}
	}
}