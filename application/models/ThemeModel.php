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

	public function getProDetailsById($proId)
	{
		$this->db->where(["pro_id"=>$proId,"status"=>1]);
		$getpro = $this->db->get("products");
		if($getpro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$key = $getpro->row();
			$this->db->order_by("id","ASC");
			$this->db->where("product_id",$key->id);
			$gtGal = $this->db->get("product_gallery");
			if($gtGal->num_rows()==0)
			{
				$galData = array();
			}
			else
			{
				$allgal = $gtGal->result();
				foreach($allgal as $gal)
				{
					$galData[] = array
										(
											"galImg"	=>$gal->images,
											"gal_id"	=>$gal->id
										);
				}
			}
			if($key->pro_type == "various")
			{
				if($key->var_type == "color")
				{
					$this->db->where("product_id",$key->pro_id);
					$gtvar = $this->db->get("varcolor")->result();
					foreach($gtvar as $vars)
					{
						$vardata[] = array
											(
												"sale_price"=>$vars->sale_price,
												"varName"	=>$vars->color_name,
												"varId"		=>$vars->id
											);
					}
				}
				else
				{
					$this->db->where("product_id",$key->pro_id);
					$gtvar = $this->db->get("varsize")->result();
					foreach($gtvar as $vars)
					{
						$vardata[] = array
											(
												"varName"	=>$vars->sizeString,
												"sale_price"=>$vars->sale_price,
												"varId"		=>$vars->id
											);
					}
				}
			}
			else
			{
				$vardata = array();
			}
			
				$data = array
								(
									"prod_name"		=>$key->product_name,
									"price"			=>$key->price,
									"sale_price"	=>$key->sale_price,
									"id"			=>$key->id,
									"pro_id"		=>$key->pro_id,
									"mnImg"			=>$key->main_img,
									"descr"			=>$key->descr,
									"galData"		=>$galData,
									"stock"			=>$key->qty,
									"varData"		=>$vardata,
									"pro_type"		=>$key->pro_type,
									"var_type"		=>$key->var_type,
									"cat_id"		=>$key->cat_id
								);
			
		}

		return $data;
	}

	public function getCart($user_id)
	{
		$this->db->order_by("cart_id","ASC");
		$this->db->where(["user_id"=>$user_id,"status"=>0]);
		$cartGet = $this->db->get("cart");
		$numRow = $cartGet->num_rows();

		$getSetting = $this->db->get("settings")->row();

		$this->db->where("user_id",$user_id);
		$getShip = $this->db->get("shipping_address");
		$numShip = $getShip->num_rows();
		$rowShip = $getShip->row();
		if($numShip > 0)
		{
			$shipData = array
							(
								"address"	=>$rowShip->address,
								"city"		=>$rowShip->city,
								"state"		=>$rowShip->state,
								"pin"		=>$rowShip->pin,
								"landMark"	=>$rowShip->nearby_location,
								"ship_id"	=>$rowShip->ship_id
							);
		}
		else
		{
			$shipData = array();
		}

		if($numRow == 0)
		{
			$cartData = array();
			$totAmt = "0.00";
		}
		else
		{
			$this->db->where("user_id",$user_id);
			$this->db->select_sum("price");
			$Amts = $this->db->get("cart")->row();
			$totAmt = round($Amts->price);
			$res = $cartGet->result();
			foreach($res as $key)
			{
				if(!empty($key->variation_name))
				{
					$var = explode("_", $key->variation_name);
					$varname = $var[2];
				}
				else
				{
					$varname = "";
				}
				$this->db->where(["pro_id"=>$key->product_id,"status"=>1]);
				$getpro = $this->db->get("products")->row();
				$cartall[] = ["cart_id"=>$key->cart_id];
				$cartData[] = array
									(
										"cart_id"		=>$key->cart_id,
										"product_id"	=>$key->product_id,
										"sale_price"	=>$key->sale_price,
										"qty"			=>$key->qty,
										"price"			=>round($key->price),

										"prod_name"		=>$getpro->product_name,
										"pricePro"		=>round($getpro->price),
										"sale_price"	=>round($getpro->sale_price),
										"id"			=>$getpro->id,
										"pro_id"		=>$getpro->pro_id,
										"mnImg"			=>$getpro->main_img,
										"stock"			=>$getpro->qty,
										"varname"		=>$varname,

										
								

									);
			}
		}
		$tx = $getSetting->tax / 100;
		$nowTx = $tx*$totAmt;
		$grandTot = round($nowTx+$totAmt);

		$data = array(
						"numCart"	=>$numRow,
						"totAmt"	=>$totAmt,
						"cartData"	=>$cartData,
						"tax"		=>$getSetting->tax,
						"grand"		=>$grandTot,
						"shipData"	=>$shipData,
						"cartall"	=>@$cartall
					);
		return $data;
	}

	public function addShippingAddress($addr,$city,$state,$zip,$lm,$user_id)
	{
		$data = array
					(
						"user_id"			=>$user_id,
						"address"			=>$addr,
						"city"				=>$city,
						"state"				=>$state,
						"pin"				=>$zip,
						"nearby_location"	=>$lm
					);
		$this->db->insert("shipping_address",$data);
		return "done";
	}

	public function updtShippingAddress($addr,$city,$state,$zip,$lm,$user_id,$ship_id)
	{
		$data = array
					(
						"user_id"			=>$user_id,
						"address"			=>$addr,
						"city"				=>$city,
						"state"				=>$state,
						"pin"				=>$zip,
						"nearby_location"	=>$lm
					);
			$this->db->where("user_id",$user_id);
			$getSh = $this->db->get("shipping_address")->num_rows();
			if($getSh > 0)
			{
				$this->db->where(["ship_id"=>$ship_id,"user_id"=>$user_id]);
				$this->db->update("shipping_address",$data);
				return "done";
			}
			else
			{
				$this->db->insert("shipping_address",$data);
				return "done";
			}
		}

	public function getUserDetails($user_id)
	{
		$this->db->where("id",$user_id);
		$get = $this->db->get("users");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$row = $get->row();
				$this->db->where("user_id",$user_id);
				$getShip = $this->db->get("shipping_address");
				$numShip = $getShip->num_rows();
				$rowShip = $getShip->row();
				if($numShip > 0)
				{
					$shipData = array
									(
										"address"	=>$rowShip->address,
										"city"		=>$rowShip->city,
										"state"		=>$rowShip->state,
										"pin"		=>$rowShip->pin,
										"landMark"	=>$rowShip->nearby_location,
										"ship_id"	=>$rowShip->ship_id
									);
				}
				else
				{
					$shipData = array
									(
										"address"	=>"",
										"city"		=>"",
										"state"		=>"",
										"pin"		=>"",
										"landMark"	=>"",
										"ship_id"	=>""
									);
				}
			$data = array
						(
							"name"		=>$row->full_name,
							"phone"		=>$row->phone,
							"shipData"	=>$shipData
						);
		}

		return $data;
	}

	public function addOrders($user_id,$ship_id,$carts,$subtot,$tax,$grosstot,$orderId,$date)
	{
		$data = array
					(
						"order_id"	=>$orderId,
						"cart_id"	=>$carts,
						"user_id"	=>$user_id,
						"shipping_address_id"	=>$ship_id,
						"prices"	=>$subtot,
						"tax"		=>$tax,
						"gross_total"	=>$grosstot,
						"order_date"	=>$date
					);
		$this->db->where(["order_id"=>$orderId,"user_id"=>$user_id]);
		$get = $this->db->get("orders_transaction")->num_rows();
		if($get > 0)
		{
			return "exist";
		}
		else
		{
			$this->db->insert("orders_transaction",$data);
			return "done";
		}
	}
}