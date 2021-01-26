<?php
/**
 * 
 */
class MembershipPlans extends CI_controller
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
		$getPlan = $this->AdminModel->getPlan();
		//print_r($getPlan);
		$this->load->view("admin/MembershipPlans",["data"=>$getPlan]);
	}

	public function AddPlan()
	{

		$this->load->view("admin/AddPlan");
	}
	public function addPlanDetails()
	{
		$title = $this->input->post("title");
		$descr = htmlentities($this->input->post("descr"));
		$full_descr = htmlentities($this->input->post("full_descr"));
		$price = $this->input->post("price");
		$duration = $this->input->post("duration");

		$insrtPlanData = $this->AdminModel->insrtPlanData($title,$descr,$price,$duration,$full_descr);
		if($insrtPlanData == "succ")
		{
			$this->session->set_flashdata("Feed","Plan added Successfully");
			return redirect("admin_panel/MembershipPlans/AddPlan");
		}
		else
		{
			$this->session->set_flashdata("err","Plan Already Exist");
			return redirect("admin_panel/MembershipPlans/AddPlan");
		}
	}
	public function EditPlans($id)
	{
		$getPlanById = $this->AdminModel->getPlanById($id);
		$this->load->view("admin/EditPlans",["data"=>$getPlanById]);
	}

	public function updatePlans()
	{
		$title = $this->input->post("title");
		$descr = htmlentities($this->input->post("descr"));
		$full_descr = htmlentities($this->input->post("full_descr"));
		$price = $this->input->post("price");
		$duration = $this->input->post("duration");
		$id = $this->input->post("id");

		$updtPlans = $this->AdminModel->updtPlans($id,$title,$descr,$price,$duration,$full_descr);
		$this->session->set_flashdata("Feed","Plan Updated Successfully");
			return redirect("admin_panel/MembershipPlans/EditPlans/".$id);
	}

	public function delPlans($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("mem_plan");
		$this->session->set_flashdata("Feed","Plan Details Deleted");
			return redirect("admin_panel/MembershipPlans/");
	}
}