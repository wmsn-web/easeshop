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

	public function getBanner()
	{
		$gtBan = $this->db->get("ad_banner");
		if($gtBan->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gtBan->result();
			foreach($res as $key)
			{
				$data[] = array
							(
								"banImg"	=>$key->images,
								"title"		=>$key->title,
								"sl_text"	=>$key->sl_text
							);
			}
		}
			return $data;

	}

	public function getNewProducts()
	{
		$this->db->order_by("id","DESC");
		$this->db->where(["new_pro"=>"1","status"=>"1"]);
		$getpro = $this->db->get("products");
		if($getpro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getpro->result();
			foreach($res as $key)
			{
				$data[] = array
								(
									"prod_name"		=>$key->product_name, 
									"price"			=>$key->price,
									"sale_price"	=>$key->sale_price,
									"id"			=>$key->id,
									"pro_id"		=>$key->pro_id,
									"mnImg"			=>$key->main_img
								);
			}
		}
		return $data;
	}
	public function splOffer()
	{
		$this->db->order_by("id","DESC");
		$this->db->where(["spl_offer"=>"1","status"=>"1"]);
		$getpro = $this->db->get("products");
		if($getpro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getpro->result();
			foreach($res as $key)
			{
				$data[] = array
								(
									"prod_name"		=>$key->product_name,
									"price"			=>$key->price,
									"sale_price"	=>$key->sale_price,
									"id"			=>$key->id,
									"pro_id"		=>$key->pro_id,
									"mnImg"			=>$key->main_img
								);
			}
		}
		return $data;
	}

	public function fetPro()
	{
		$this->db->order_by("id","DESC");
		$this->db->where(["feature_pro"=>"1","status"=>"1"]);
		$getpro = $this->db->get("products");
		if($getpro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getpro->result();
			foreach($res as $key)
			{
				$data[] = array
								(
									"prod_name"		=>$key->product_name,
									"price"			=>$key->price,
									"sale_price"	=>$key->sale_price,
									"id"			=>$key->id,
									"pro_id"		=>$key->pro_id,
									"mnImg"			=>$key->main_img
								);
			}
		}
		return $data;
	}

	public function getCat()
	{
		$this->db->order_by("id","DESC");
		$get = $this->db->get("category");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach($res as $key)
			{
				$catSlug = str_replace(" ", "_",$key->cat_name);
				$data[] = array
								(
									"cat_name"		=>$catSlug,
									"id"			=>$key->id
								);
			}
		}

		return $data; 
	}

	public function get_count_brandPro($brand)
	{
		$this->db->where("brand",$brand);
		$getBrand = $this->db->get("brands")->row();
		$brandId = @$getBrand->brand_id;
		$this->db->where(["brand_id"=>$brandId,"status"=>1]);
		$getpro = $this->db->get("products")->num_rows();
		return $getpro;
	}

	public function getItemByBrand($brand,$limit, $start)
	{
		$this->db->where("brand",$brand);
		//$this->db->limit($limit, $start);
		$getBrand = $this->db->get("brands")->row();
		$brandId = @$getBrand->brand_id;
		$this->db->where(["brand_id"=>$brandId, "status"=>1]);
		$this->db->limit($limit, $start);
		//$this->db->select("*");
		//$this->db->select_min("sale_price");
		//$this->db->select("SELECT id, MIN(sale_price) FROM products");
		$getpro = $this->db->get("products");
		if($getpro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getpro->result();
			foreach($res as $key)
			{
				$data[] = array
								(
									"prod_name"		=>$key->product_name,
									"price"			=>$key->price,
									"sale_price"	=>$key->sale_price,
									"id"			=>$key->id,
									"pro_id"		=>$key->pro_id,
									"mnImg"			=>$key->main_img,
									"descr"			=>substr($key->descr, 0, 200)
								);
			}
		}
		return $data;
	}

	public function getSearchKeys($keys,$limit, $start)
	{
		
		$this->db->where(["status"=>1]);
		$this->db->like(["product_name"=>$keys]);
		$this->db->or_like(["descr"=>$keys]);
		$this->db->or_like(["cat_name"=>$keys]);
		$this->db->limit($limit, $start);
		$getpro = $this->db->get("products");
		if($getpro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getpro->result();
			foreach($res as $key)
			{
				$data[] = array
								(
									"prod_name"		=>$this->highlight($key->product_name, $keys),
									"price"			=>$key->price,
									"sale_price"	=>$key->sale_price,
									"id"			=>$key->id,
									"pro_id"		=>$key->pro_id,
									"mnImg"			=>$key->main_img,
									"descr"			=>substr($this->highlight($key->descr, $keys), 0, 200)
								);
			}
		}

		return $data;
	}

	function highlight($text, $words) {
	    preg_match_all('~\w+~', $words, $m);
	    if(!$m)
	        return $text;
	    $re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
	    return preg_replace($re, '<b>$0</b>', $text);
	}

	public function get_count_searchPro($keys)
	{
		$this->db->where(["status"=>1]);
		$this->db->like(["product_name"=>$keys]);
		$this->db->or_like(["descr"=>$keys]);
		$this->db->or_like(["cat_name"=>$keys]);
		$getpro = $this->db->get("products");
		$num  = $getpro->num_rows();
		return $num;
	}
}