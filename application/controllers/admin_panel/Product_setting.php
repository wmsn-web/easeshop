<?php 
/**
 * 
 */
class Product_setting extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		if(!$this->session->userdata("UserAdmin"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			return redirect("admin_panel/AdminLogin?refer=$actual_link");
		
		}
	}

	public function index($proId = '')
	{
		$getProductById = $this->AdminModel->getProductById($proId);
		$getbanks = $this->AdminModel->getAllBanks($proId);
		$getOffers = $this->AdminModel->getOffers($proId);
		//echo "<pre>";
		//print_r($getbanks);
		$this->load->view("admin/product_setting",["prodata"=>$getProductById,"banks"=>$getbanks,"proId"=>$proId,"offers"=>$getOffers]);
	}

	public function saveSetting()
	{
		$proId = $this->input->post("proId");
		$debit_card = $this->input->post("debit_card");
		$credit_card = $this->input->post("credit_card");
		$debit_bank = $this->input->post("bank_debit");
		$credit_bank = $this->input->post("bank_credit");
		$upi = $this->input->post("upi");
		$cashback_type = $this->input->post("cashback_type");
		$cashback_value = $this->input->post("cashback_value");
		$limit_date = $this->input->post("limit_date");

		$data = array
					(
						"pro_id"			=>$proId,
						"debit_card"		=>$debit_card,
						"credit_card"		=>$credit_card,
						"upi"				=>$upi,
						"offer_type"		=>$cashback_type,
						"offer_value"		=>$cashback_value,
						"date_limit"		=>$limit_date
						
					);
		if(!empty($debit_bank)):
			foreach($debit_bank as $dbank)
			{
				$this->db->where(["pro_id"=>$proId,"bank"=>$dbank]);
				$gts = $this->db->get("debit_bank")->num_rows();
				if($gts > 0)
				{

				}else
				{
					$this->db->insert("debit_bank",["pro_id"=>$proId,"bank"=>$dbank]);
				}
				
			}
		endif; 
		if(!empty($credit_bank)):
			foreach($credit_bank as $cbank)
			{
				$this->db->where(["pro_id"=>$proId,"bank"=>$cbank]);
				$gts = $this->db->get("credit_bank")->num_rows();
				if($gts > 0)
				{

				}else
				{
					$this->db->insert("credit_bank",["pro_id"=>$proId,"bank"=>$cbank]);
				}
				
			}
		endif; 
		$this->db->where("pro_id",$proId);
		$gets = $this->db->get("cash_back_offer")->num_rows();
		if($gets > 0)
		{
			$this->db->where("pro_id",$proId);
			$this->db->update("cash_back_offer",$data);
		}
		else
		{
			$this->db->insert("cash_back_offer",$data);
		}

		$this->session->set_flashdata("Feed","Cashback Setting updated");
		return redirect("admin_panel/Product_setting/index/".$proId);
	}

	public function removeDbank()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$this->db->delete("debit_bank");
	}

	public function removeCbank()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$this->db->delete("credit_bank");
	}
}