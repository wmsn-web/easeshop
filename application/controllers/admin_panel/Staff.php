<?php 
/**
 * 
 */
class Staff extends CI_controller
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
		$getAllStaff = $this->AdminModel->getAllStaff();
		$this->load->view("admin/Staff",["staffData"=>$getAllStaff]);
	}

	public function addStaff()
	{
		$user = $this->input->post("userName");
		$mob = $this->input->post("mob");
		$pass = password_hash($this->input->post("pass"), PASSWORD_DEFAULT);
		$setStaff = $this->AdminModel->setStaff($user,$mob,$pass);
		if($setStaff == "exst_usr")
		{
			$this->session->set_flashdata("Feed","Username Already Exist!");
			return redirect("admin_panel/Staff");
		}
		elseif($setStaff == "exst_mob")
		{
			$this->session->set_flashdata("Feed","Mobile Number Already Registered!");
			return redirect("admin_panel/Staff");
		}
		elseif($setStaff == "succ")
		{
			$this->session->set_flashdata("Feed","Staff Added Successfully");
			return redirect("admin_panel/Staff");
		}
		else
		{
			$this->session->set_flashdata("Feed","Internal Server Error!");
			return redirect("admin_panel/Staff");
		}

	}

	public function ChangeStatus()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$getr = $this->db->get("admin")->row();
		if($getr->status == "1")
		{
			$this->db->where("id",$id);
			$this->db->update("admin",["status"=>0]);
			echo "";
		}
		else
		{
			$this->db->where("id",$id);
			$this->db->update("admin",["status"=>1]);
			echo "on";
		}

	}

	public function getStafById()
	{
		$id = $this->input->post("id");
		$this->db->where("id",$id);
		$key = $this->db->get("admin")->row();
		$data = array
								(
									"user"	=>$key->admin_user,
									"mobile"=>$key->mobile,
									"login_type"=>$key->login_type,
									"status"	=>$key->status,
									"id"	=>$key->id
								);
		echo json_encode($data);
	}

	public function updateStaff()
	{
		$user = $this->input->post("userName");
		$mob = $this->input->post("mob");
		$chpas = $this->input->post("chpas");
		$id = $this->input->post("id");
		$pass = password_hash($this->input->post("pass"), PASSWORD_DEFAULT);

		if($chpas == "yes")
		{
			$data = array
						(
							"admin_user"=>$user,
							"mobile"=>$mob,
							"password"=>$pass,
						);
		}
		else
		{
			$data = array
						(
							"admin_user"=>$user,
							"mobile"=>$mob,
						);
		}
		$this->db->where("id",$id);
		$this->db->update("admin",$data);
		$this->session->set_flashdata("Feed","Staff updated Successfully");
			return redirect("admin_panel/Staff");
	}

	public function DelStaff($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("admin");
		$this->session->set_flashdata("Feed","Staff Deleted");
			return redirect("admin_panel/Staff");

	}
}