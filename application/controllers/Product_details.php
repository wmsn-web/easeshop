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
		$getAllReviews = $this->ThemeModel->getAllReviews($proId);
		$getFaq = $this->ThemeModel->getFaq($proId);
		if(!empty($getProDetailsById))
        {
		   $this->load->view("fronts/product_details",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"proData"=>$getProDetailsById,"allReviews"=>$getAllReviews,"faqData"=>$getFaq]);
		}
		else
		{
			return redirect(base_url());
		}
	}

	public function addToCart()
	{
		$pro_id = $this->input->post("proId");
		$varnm = $this->input->post("varnm");
		$user_id = $this->input->post("user_id");
		$cat_id = $this->input->post("cat_id");
		$sale_price = $this->input->post("sale_price");
		$qty = $this->input->post("qty");
		$price = $this->input->post("price");
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');

		$data = array
					(
						"product_id"	 =>$pro_id,
						"variation_name" =>$varnm,
						"user_id"		=>$user_id,
						"cat_id"		=>$cat_id,
						"sale_price"	=>$sale_price,
						"qty"			=>$qty,
						"price"			=>$price,
						"date"			=>$date,
						"status"		=>0
					);
		$this->db->insert("cart",$data);
		$this->session->set_flashdata("Feed",'Product Added to cart');
		return redirect("Product_details/index/".$pro_id);
	}
}