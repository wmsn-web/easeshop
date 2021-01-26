<?php
/**
 * 
 */
class ShippingZone extends CI_controller
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
		$getZone = $this->db->get("shiping_zone");
		if($getZone->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getZone->result();
			foreach($res as $key)
			{
				$data[] = array("location_name"=>$key->location_name, "zip_code"=>$key->zip_code,"zone_id"=>$key->zone_id);
			}
		}
		$this->load->view("admin/ShippingZone",["data"=>$data]);
	}

	public function addShipping()
	{
		$location_name = $this->input->post("location_name");
		$zip_code = $this->input->post("zip_code");

		$this->db->where("zip_code",$zip_code);
		$get = $this->db->get("shiping_zone")->num_rows();
		if($get >0)
		{
			$this->session->set_flashdata("Feed","Zone Already Exist!");
			return redirect("admin_panel/ShippingZone");
		}
		else
		{
			$this->db->insert("shiping_zone",["location_name"=>$location_name,"zip_code"=>$zip_code]);
			$this->session->set_flashdata("Feed","Zone Added Successfully");
			return redirect("admin_panel/ShippingZone");
		}
	}

	public function getZoneById()
	{
		$zone_id = $this->input->post("zone_id");
		$this->db->where("zone_id",$zone_id);
		$key = $this->db->get("shiping_zone")->row();

		$data = array("location_name"=>$key->location_name, "zip_code"=>$key->zip_code,"zone_id"=>$key->zone_id);
		echo json_encode($data);
	}

	public function EditShipping()
	{
		$location_name = $this->input->post("location_name");
		$zip_code = $this->input->post("zip_code");
		$zone_id = $this->input->post("zone_id");
		$this->db->where("zone_id",$zone_id);
		$this->db->update("shiping_zone",["location_name"=>$location_name,"zip_code"=>$zip_code]);
		$this->session->set_flashdata("Feed","Zone Updated Successfully");
			return redirect("admin_panel/ShippingZone");
	}
}