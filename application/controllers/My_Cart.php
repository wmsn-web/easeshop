<?php
/**
 * 
 */
class My_Cart extends CI_controller
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
  		$getCart = $this->ThemeModel->getCart($user_id);
		$this->load->view("fronts/My_Cart",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"cartData"=>$getCart]);
		//echo "<pre>";
		//print_r($getCart);
	}

	public function delCart($id='')
	{
		$this->db->where("cart_id",$id);
		$this->db->delete("cart");
		$this->session->set_flashdata("Feed",'Cart Deleted');
		return redirect("My-Cart");

	}

	public function edtQtyPrc()
	{
		$id = $this->input->post("id");
		$fixPrc = $this->input->post("fixPrc");
		$qty = $this->input->post("qty");
		echo $price = $qty*$fixPrc;
		$this->db->where("cart_id",$id);
		$this->db->update("cart",["qty"=>$qty,"price"=>$price]);
	}
}