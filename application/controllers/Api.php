<?php 

/**
 * 
 */
class API extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function SetVisitor()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		$vs_from = "Android";
		$times = date('h:i:s');
		$address = $this->input->post("address");

		$data['ip'] = $ip;
		$data['date'] = $date;
		$data['vs_from'] = $vs_from;

		$datas['ip'] = $ip;
		$datas['date'] = $date;
		$datas['vs_from'] = $vs_from;
		$datas['times'] = $times;
		$datas['address'] = $address;

		$this->db->where($data);
		$gt = $this->db->get("visitors")->num_rows();
		if($gt > 0)
		{

		}
		else
		{
			$this->db->insert("visitors",$datas);
			echo "done";
		}

		//echo json_encode($datas);
	}
}