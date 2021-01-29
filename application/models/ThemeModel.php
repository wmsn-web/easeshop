<?php
/**
 * 
 */
class ThemeModel extends CI_Model
{
	
	public function getMenudata()
	{
		$data = array();

		$this->db->order_by("id","ASC");
		$getCat = $this->db->get("category");
		if($getCat->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$resCat = $getCat->result();
			foreach($resCat as $rscat)
			{
				$subData = [];
				$this->db->where("cat_id",$rscat->id);
				$this->db->order_by("brand_id","ASC");
				$getSubCat = $this->db->get("brands");
				if($getSubCat->num_rows()==0)
				{
					$subData = array();
				}
				else
				{
					$subRes = $getSubCat->result();
					foreach($subRes as $sbres)
					{
						$subData[] = array
										(
											"subCat"	=>$sbres->brand,
											"subcat_id"	=>$sbres->brand_id,
											"links"		=>"Category/Items/".$sbres->brand
										);
					}
				}
				$data[] = array
								(
									"catId"	=>$rscat->id,
									"catName"	=>$rscat->cat_name,
									"subData"	=>$subData
								);
			}
		}

		return $data;
	}
}