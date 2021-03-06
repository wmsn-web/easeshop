<?php
/**
 * 
 */
class My_Account extends CI_controller
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
  		$getUser = $this->ThemeModel->getUserDetails($user_id);
		$this->load->view("fronts/My_Account",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"getUser"=>$getUser]);
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

	public function AddReviews()
	{
		$user_id = $this->input->post("user_id");
		$proId = $this->input->post("proId");
		$stars = $this->input->post("stars");
		$review = $this->input->post("review");
		$rview = htmlentities($review);

		$postReviews = $this->ThemeModel->postReviews($user_id,$proId,$stars,$rview);
		if($postReviews == "succ")
		{
			$this->session->set_flashdata("Feed","Thank you for your review");
			return redirect("Product_details/index/".$proId);
		}

	}
}