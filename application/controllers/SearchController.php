<?php
/**
 * 
 */
class SearchController extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model("ThemeModel");
	}
	public function search()
	{
		$keywords = $this->input->post("keywords");

		$this->db->like("product_name",$keywords);
		$this->db->or_like("cat_name",$keywords);
		$get = $this->db->get("products");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach($res as $key)
			{
				$data[] = array
								(
									"pro_name"	=>$key->product_name,
									"cat_name"	=>$key->cat_name,
									"pro_id"	=>$key->pro_id,
									"qty"		=>$key->qty
								);
			}
		}
		if(!empty($data))
		{
			foreach($data as $dt)
			{
				//echo "<li onclick=\"selectSrc('".$dt['pro_name']."')\"><b>".$dt['pro_name']."</b> <span style='display:inline-block; float:right; font-size:11px; color:#0084F9'>~~".$dt['cat_name']."</span></li>";
				if($dt['qty']=="Out Of Stock")
				{
					echo "";
				}else
				{
					echo "<li><a href='".base_url('Product_details/index/'.$dt['pro_id'])."'><b>".$dt['pro_name']."</b> <span style='display:inline-block; float:right; font-size:11px; color:#0084F9'>~~".$dt['cat_name']."</span></a></li>";
				}
			}
		}
		else
		{
			echo "NotFound";
		}
	}

	public function search2()
	{
		$keywords = $this->input->post("keywords");
		$this->db->like("product_name",$keywords);
		$this->db->or_like("cat_name",$keywords);
		$get = $this->db->get("products");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach($res as $key)
			{
				$data[] = array
								(
									"pro_name"	=>$key->product_name,
									"cat_name"	=>$key->cat_name,
									"pro_id"	=>$key->pro_id,
									"qty"		=>$key->qty
								);
			}
		}
		if(!empty($data))
		{
			foreach($data as $dt)
			{
				if($dt['qty']=="Out Of Stock")
				{
					echo "";
				}else
				{
				//echo "<li onclick=\"selectSrc2('".$dt['pro_name']."')\"><b>".$dt['pro_name']."</b> <span style='display:inline-block; float:right; font-size:11px; color:#0084F9'>~~".$dt['cat_name']."</span></li>";
					echo "<li><a href='".base_url('Product_details/index/'.$dt['pro_id'])."'><b>".$dt['pro_name']."</b> <span style='display:inline-block; float:right; font-size:11px; color:#0084F9'>~~".$dt['cat_name']."</span></a></li>";
				}
			}
		}
		else
		{
			echo "NotFound";
		}
	}
}