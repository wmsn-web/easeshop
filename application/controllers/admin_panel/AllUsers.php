<?php
/**
 * 
 */
class AllUsers extends CI_controller
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
	
	 

	
	function index()
	{
		$allUsers = $this->AdminModel->getAllUsers();
		$this->load->view("admin/AllUsers",["allUsers"=>$allUsers]);
	}

	public function getUserIndv()
	{
		$id = $this->input->post("user_id");
		$getUserById = $this->AdminModel->getUserById($id);
		echo json_encode($getUserById);
	}

	public function rechargeAmt()
	{
		$id = $this->input->post("user_id");
		$amt = $this->input->post("rechAmt");
		$rechargeWlt = $this->AdminModel->rechargeWlt($id,$amt);
		echo $rechargeWlt;
		
	}

	public function BlockUser()
	{
		$id = $this->input->post("user_id");
		$this->db->where("id",$id);
		$this->db->update("users",["verification_status"=>'0']);
		echo "blocked";
	}

	public function unBlockUser()
	{
		$id = $this->input->post("user_id");
		$this->db->where("id",$id);
		$this->db->update("users",["verification_status"=>'1']);
		echo "unblocked";
	}
}