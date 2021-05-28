<?php
/**
 * 
 */
class TestAndr extends CI_controller
{
	
	public function index()
	{
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$dt = $this->db->insert("test_usr",["name"=>$name,"email"=>$email]);
		if($dt === TRUE)
		{
			echo "Success";
		}
		else
		{
			echo "Failure";
		}

	}

	public function getData()
	{
		$this->db->order_by("id","ASC");
		$get = $this->db->get("test_usr");
		if($get->num_rows()==0)
		{
			echo "No Data Found!";
		}
		else
		{
			$res = $get->result();
			foreach($res as $rs)
			{
				$data["data"][] = array
							(
								"name"=>$rs->name,
								"movie"=>$rs->email
							);
			}
			 header('Content-Type:Application/json');
			echo json_encode($data);
		}
	}
} 