<?php
/**
 * 
 */
class CronJobs extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		
	}

	public function checkUpdateSubscription()
	{
		$get = $this->db->get("subscription");
		if($get->num_rows()==0)
		{
		    
		}else
		{
		    $res = $get->result();
		    foreach($res as $ress)
		    {
		       $duration = $ress->duration;
		       $this->db->query("UPDATE `subscription` SET `status`='0' WHERE `datefrom` <=CURRENT_DATE - INTERVAL $duration DAY");
		        
		    }
		}
	}
}