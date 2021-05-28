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
  		$getUser = $this->ThemeModel->getUserDetails($user_id); 
  		$walbal = $this->ThemeModel->getWalletBal($user_id);
  		$getSettings = $this->ThemeModel->getSettings();
		$this->load->view("fronts/My_Cart",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"cartData"=>$getCart,"getUser"=>$getUser,"walbal"=>$walbal,"settings"=>$getSettings]);
		//echo "<pre>";
		//print_r($getSettings);
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

	public function AddShipAddr()
	{
		$addr = $this->input->post("addr");
		$city = $this->input->post("city");
		$state = $this->input->post("state");
		$zip = $this->input->post("zip");
		$lm = $this->input->post("lm");
		$user_id = $this->input->post("user_id");
		$add = $this->ThemeModel->addShippingAddress($addr,$city,$state,$zip,$lm,$user_id);
		echo $add;
	}

	public function UpdateShipAddr()
	{
		$addr = $this->input->post("addr");
		$city = $this->input->post("city");
		$state = $this->input->post("state");
		$zip = $this->input->post("zip");
		$lm = $this->input->post("lm");
		$eml = $this->input->post("eml");
		$user_id = $this->input->post("user_id");
		$ship_id = $this->input->post("ship_id");
		$add = $this->ThemeModel->updtShippingAddress($addr,$city,$state,$zip,$lm,$user_id,$ship_id,$eml);
		echo $add;
	}

	public function AddOrder()
	{
		$user_id = $this->input->post("user_id");
		$ship_id = $this->input->post("ship_id");
		$carts = htmlentities($this->input->post("carts"));
		$subtot = $this->input->post("subtot");
		$tax = $this->input->post("tax");
		$grosstot = $this->input->post("grosstot");
		$orderId = $this->input->post("orderId");
		$walPay = $this->input->post("walPay");
		date_default_timezone_set("Asia/Kolkata");
		$date = date('Y-m-d');
		$addOrders = $this->ThemeModel->addOrders($user_id,$ship_id,$carts,$subtot,$tax,$grosstot,$orderId,$date,$walPay);
		echo $addOrders;

	}
}