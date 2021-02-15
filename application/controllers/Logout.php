<?php
/**
 * 
 */
class Logout extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$user = $this->session->userdata("userId");
		$this->db->where("id",$user);
		$this->db->update("users",["deviceid"=>null]);
		$this->session->unset_userdata("userId");
		return redirect($_SERVER['HTTP_REFERER']);
	}
}