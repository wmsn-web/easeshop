<?php
/**
 * 
 */
class My_wishlist extends CI_controller
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
       	$this->load->view("fronts/My_whishlist",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"mywish"=>$mywish]);
       	//echo "<pre>";
       	//print_r($mywish);
	}

	public function AddWish($proId = '', $userId='')
	{
        $this->db->where(["product_id"=>$proId,"user_id"=>$userId]);
        $num = $this->db->get("wishlist")->num_rows();
        if($num > 0)
        {
        	$this->session->set_flashdata("Feed","Already exist");
        	return redirect('Product_details/index/'.$proId);
        }
        else
        {
        	$this->db->insert("wishlist",["product_id"=>$proId,"user_id"=>$userId]);
        	$this->session->set_flashdata("Feed","Wishlist added successfully");
        	return redirect('Product_details/index/'.$proId);
        }
	}

	public function delWish($id='')
	{
		$this->db->where("id",$id);
		$this->db->delete("wishlist");
		$this->session->set_flashdata("Feed","Wishlist Deleted Successfully");
        	return redirect('My_wishlist');
	}
}