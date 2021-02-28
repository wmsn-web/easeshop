<?php
/**
 * 
 */
class OtherSettings extends CI_controller
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

	public function index()
	{
		$getRefrl = $this->AdminModel->getRefrl();
		//$getTimeSlot = $this->AdminModel->getTimeSlot();
		//$getAllSlots = $this->AdminModel->getAllSlots();
		$getminOrd = $this->AdminModel->getminOrd();
		$getPrivacy = $this->AdminModel->getPrivacy();
		$getTerms  = $this->AdminModel->getTerms();
		$getCnum = $this->AdminModel->getCnum();
		$getFaqs = $this->AdminModel->getFaqs();
		$getAllPro = $this->AdminModel->getAllProducts();
		$getTax = $this->AdminModel->getTax();
		//print_r($getFaqs);
		$dataR = array("qstn" =>"",
								"ansr"	=>"",
								"id"	=>"");
		//print_r($getRefrl);
		if($this->uri->segment(4)=="edits")
		{
			$id = $this->uri->segment(5);
			$this->db->where("id",$id);
			$get = $this->db->get("faq");
			if($get->num_rows()==0)
			{
				$dataR = array("qstn" =>"",
								"ansr"	=>"",
								"id"	=>"",
								"proId"	=>"");
			}
			else
			{
				$row = $get->row();
				$dataR = array
							(
								"qstn" =>$row->question,
								"ansr"	=>$row->answer,
								"id"	=>$row->id,
								"proId"=>$row->product_id
							);
			}
		}
		$this->load->view("admin/OtherSettings",["ref"=>$getRefrl, "minOrd"=>$getminOrd,"getPrivacy"=>$getPrivacy,"getTerms"=>$getTerms,"getCnum"=>$getCnum,"getFaqs"=>$getFaqs,"faqrow"=>$dataR,"proData"=>$getAllPro,"tx"=>$getTax]);
	}

	public function updtRef()
	{
		$amt = $this->input->post("amount");
		$this->db->update("referral_setting",["amount"=>$amt]);
		$this->session->set_flashdata("Feed","Referral Amount has been Updated");
		return redirect("admin_panel/OtherSettings/?ref");
	}

	public function minOrdr()
	{
		$amt = $this->input->post("amount");
		$this->db->update("settings",["min_order_amt"=>$amt]);
		$this->session->set_flashdata("Feed","Minimum Order Amount has been Updated");
		return redirect("admin_panel/OtherSettings/?moa");
	}

	public function updtTiming()
	{
		$this->db->query("DELETE  FROM slots_timing");
		$startTime = $this->input->post("startTime");
		$finishTime = $this->input->post("finishTime");
		$workHour = $this->input->post("workHour");
		$timeSlot = $this->input->post("timeSlot");
		$esd = $this->input->post("esd");
		$ordPerSlot = $this->input->post("ordPerSlot");
		$slots = $this->input->post("slot");
		$start = $this->input->post("start");
		$end = $this->input->post("end");
		
		
		$data = array
					(
						"start_time"	=>$startTime,
						"finish_time"	=>$finishTime,
						"working_hour"	=>$workHour,
						"time_slot"		=>$timeSlot,
						"each_slot"		=>$esd,
						"take_ord"		=>$ordPerSlot
					);
		$this->db->update("order_timing",$data);
		
		

		foreach(array_keys($slots) as $i) {
			$dataSlot[] = array
								(
									"slot"=>$slots[$i],
									"start"=>$start[$i],
									"end"=>$end[$i]
								);
		}
		$this->db->insert_batch("slots_timing",$dataSlot);
		$this->session->set_flashdata("Feed","Setup Seved");
		return redirect("admin_panel/OtherSettings/?mot");
	}

	public function AddPrivacy()
	{
		$heading = $this->input->post("heading");
		$descr = $this->input->post("descr");
		if(empty($heading))
		{
			$this->session->set_flashdata("Feed","Privacy Added Successfully");
			return redirect("admin_panel/OtherSettings/?priv");
		}
		else
		{
			foreach(array_keys($heading) as $i) {
				$data[] = array
								(
									"heading" =>$heading[$i],
									"description" =>htmlentities($descr[$i])
								);
			}

			$this->db->insert_batch("privacy_policy",$data);
			$this->session->set_flashdata("Feed","Privacy Added Successfully");
			return redirect("admin_panel/OtherSettings/?priv");
		}
	}

	public function privChangeHdClass()
	{
		$heading = $this->input->post("headings");
		$id = $this->input->post("id");

		$this->db->where("id",$id);
		$this->db->update("privacy_policy",["heading"=>$heading]);
		echo "done";
	}

	public function privChangeDescClass()
	{
		$descr = $this->input->post("descr");
		$id = $this->input->post("id");

		$this->db->where("id",$id);
		$this->db->update("privacy_policy",["description"=>$descr]);
		echo "done";
	}

	public function delPrivacy($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("privacy_policy");
		$this->session->set_flashdata("Feed","Privacy Deleted");
		return redirect("admin_panel/OtherSettings/?priv");
	}

	public function Terms()
	{
		$heading = $this->input->post("heading");
		$descr = $this->input->post("descr");
		if(empty($heading))
		{
			$this->session->set_flashdata("Feed","Terms & Condition Added Successfully");
			return redirect("admin_panel/OtherSettings/?terms");
		}
		else
		{
			foreach(array_keys($heading) as $i) {
				$data[] = array
								(
									"heading" =>$heading[$i],
									"description" =>htmlentities($descr[$i])
								);
			}

			$this->db->insert_batch("terms_condition",$data);
			$this->session->set_flashdata("Feed","Terms & Condition Added Successfully");
			return redirect("admin_panel/OtherSettings/?terms");
		}
	}

	public function termChangeHdClass()
	{
		$heading = $this->input->post("headings");
		$id = $this->input->post("id");

		$this->db->where("id",$id);
		$this->db->update("terms_condition",["heading"=>$heading]);
		echo "done";
	}

	public function termChangeDescClass()
	{
		$descr = $this->input->post("descr");
		$id = $this->input->post("id");

		$this->db->where("id",$id);
		$this->db->update("terms_condition",["description"=>$descr]);
		echo "done";
	}

	public function delTerms($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("terms_condition");
		$this->session->set_flashdata("Feed","Terms & Condition Deleted");
		return redirect("admin_panel/OtherSettings/?terms");
	}

	public function setCnum()
	{
		$cNum = $this->input->post("cNum");
		$this->db->update("admin",["c_help_number"=>$cNum]);
		$this->session->set_flashdata("Feed","Customer Care Number Updated");
		return redirect("admin_panel/OtherSettings/?help");
	}

	public function addFaq()
	{
		$proId = $this->input->post("proId");
		$qstn = htmlentities($this->input->post("qstn"));
		$ansr = htmlentities($this->input->post("ansr"));
		$low = strtolower($qstn);
		$replce = str_replace(" ","_",$low);
		$slug = $replce;
		$this->db->where("slug",$slug);
		$get = $this->db->get("faq");
		if($get->num_rows() > 0)
		{
			$this->session->set_flashdata("Feed","Question Already Added");
			return redirect("admin_panel/OtherSettings/?help");
		}
		else
		{
			$this->db->insert("faq",["product_id"=>$proId,"question"=>$qstn, "answer"=>$ansr,"slug"=>$slug]);
			$this->session->set_flashdata("Feed","Question Added Successfully");
			return redirect("admin_panel/OtherSettings/?help");
		}
	}

	public function UpdateFaq()
	{	$proId = $this->input->post("proId");
		$qstn = htmlentities($this->input->post("qstn"));
		$id = $this->input->post("id");
		$ansr = htmlentities($this->input->post("ansr"));
		$low = strtolower($qstn);
		$replce = str_replace(" ","_",$low);
		$slug = $replce;

		$this->db->where("id",$id);
		$this->db->update("faq",["product_id"=>$proId,"question"=>$qstn, "answer"=>$ansr,"slug"=>$slug]);
		$this->session->set_flashdata("Feed","Question Updated Successfully");
		return redirect("admin_panel/OtherSettings/?help");

	}

	public function delFaq($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("faq");
		$this->session->set_flashdata("Feed","Question Deleted Successfully");
		return redirect("admin_panel/OtherSettings/?help");
	}

	public function ChTax()
	{
		$tax = $this->input->post("tax");
		$this->db->update("settings",["tax"=>$tax]);
		$this->session->set_flashdata("Feed","Tax Updated Successfully");
		return redirect("admin_panel/OtherSettings/?tax");
	}
}