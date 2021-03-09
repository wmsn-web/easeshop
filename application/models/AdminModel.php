<?php
/**
 * 
 */
class AdminModel extends CI_model
{
	
	function getUser($user)
	{
		$this->db->where(["admin_user"=>$user,"status"=>1]);
		$query = $this->db->get("admin");

		return $query;

	}
	//Add Category
	public function insrtCat($cat_name,$filename)
	{
		$this->db->where("cat_name",$cat_name);
		$get = $this->db->get("category");
		if($get->num_rows() > 0)
		{
			$return = "exst";
		}
		else
		{
			$this->db->insert("category",["cat_name"=>$cat_name,"cat_img"=>$filename]);
			$return = "succ";
		}
		return $return;
	}
	//All Category
	public function getAllCat()
	{
		$getCat = $this->db->get("category");
		if($getCat->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getCat->result();
			foreach ($res as $key) {
				$catId = $key->id;
				$this->db->where("cat_id",$catId);
				$prod = $this->db->get("products")->num_rows();

				$data[] = array
								(
									"cat_name"=>$key->cat_name,
									"catId"=>$catId,
									"prod"=>$prod,
									"cat_img"=>$key->cat_img
								);

			}
		}

		return $data;
	}

	public function getCatById($id)
	{
		$this->db->where("id",$id);
		$getCat = $this->db->get("category"); 
		if($getCat->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$row = $getCat->row();
			$data = array("cat_name"=>$row->cat_name,"catId"=>$id,"cat_img"=>$row->cat_img);
		}

		return $data;
	}

	public function updateCat($cat_name='',$id='',$file_name='')
	{
		$this->db->where("id",$id);
		$this->db->update("category",["cat_name"=>$cat_name,"cat_img"=>$file_name]);
		$return = "succ";
		return $return;
	}

	public function getUnit()
	{
		$getUnt = $this->db->get("units");
		if($getUnt->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getUnt->result();
			foreach ($res as $key) {
				
				$data[] = array
								(
									"unt_name"=>$key->unt_name,
								);

			}
		}

		return $data;
	}

	public function insrtProducts($prod_name,$catId,$qty,$units,$price,$descr,$pro_type,$var_type, $proId,$brand,$offer,$salePrice,$returnable,$slug)
	{
		$this->db->where(["product_name"=>$prod_name,"cat_id"=>$catId]);
		$get = $this->db->get("products");
		if($get->num_rows() > 0)
		{
			$return = "0";
		}
		else
		{
			$this->db->where("id",$catId);
			$getCat = $this->db->get("category")->row();
			$proArray = array
							(
								"pro_id"=>$proId,
								"product_name"=>$prod_name,
								"pro_type"=>$pro_type,
								"var_type"=>$var_type,
								"brand_id"=>$brand,
								"cat_id"=>$catId,
								"cat_name"=>$getCat->cat_name,
								"qty"=>$qty,
								"units"=>$units,
								"price"=>$price,
								"offer"=>$offer,
								"descr"=>$descr,
								"active"=>1,
								"sale_price"=>$salePrice,
								"returnable"=>$returnable,
								"slug"		=>$slug
							);
			$this->db->insert("products",$proArray);
			$return = $proId;
		}

		return $return;
	}

	public function setvarProduct($proId,$varsQty,$varsUnit,$varsStQty,$offer)
	{
		foreach(array_keys($varsQty) as $i) {

			if($offer == "" || $offer == "0")
				{
					$salePrice = $varsUnit[$i];
					$ofr = 0;
				}
				else
				{
					$ofrPercent = $offer/100;
					$acOfer = $varsUnit[$i]*$ofrPercent;
					$salePrice = $varsUnit[$i] - $acOfer;
				}

				$data[] = array
								(
									"product_id"=>$proId,
									"qty_unit"=>$varsQty[$i],
									"price"=>$varsUnit[$i],
									"stock_qty"=>$varsStQty[$i],
									"sale_price"=>$salePrice
								);
			
		}
		$this->db->insert_batch("various",$data);
		

	}
	public function setvarProductSize($proId,$varSize,$varsPrcc2,$offer)
	{
		foreach(array_keys($varSize) as $i) {

			if($offer == "" || $offer == "0")
				{
					$salePrice = $varsPrcc2[$i];
					$ofr = 0;
				}
				else
				{
					$ofrPercent = $offer/100;
					$acOfer = $varsPrcc2[$i]*$ofrPercent;
					$salePrice = $varsPrcc2[$i] - $acOfer;
				}

				$data[] = array
								(
									"product_id"=>$proId,
									"sizeString"=>$varSize[$i],
									"price"=>$varsPrcc2[$i],
									"sale_price"=>$salePrice
								);
			
		}
		$this->db->insert_batch("varsize",$data);
	}
	

	public function setvarProductColor($proId,$varColor,$varsPrcc,$offer)
	{
		foreach(array_keys($varColor) as $i) {

			if($offer == "" || $offer == "0")
				{
					$salePrice = $varsPrcc[$i];
					$ofr = 0;
				}
				else
				{
					$ofrPercent = $offer/100;
					$acOfer = $varsPrcc[$i]*$ofrPercent;
					$salePrice = $varsPrcc[$i] - $acOfer;
				}

				$data[] = array
								(
									"product_id"=>$proId,
									"color_name"=>$varColor[$i],
									"price"=>$varsPrcc[$i],
									"sale_price"=>$salePrice
								);
			
		}
		$this->db->insert_batch("varcolor",$data);
	}

	function addImg($setProduct,$file_name)
	{
		$this->db->where("pro_id",$setProduct);
		$this->db->update("products",["main_img"=>$file_name]);
	}

	public function getAllProducts()
	{
		$this->db->where("active",1);
		$get = $this->db->get("products");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$var = array();
				if($key->pro_type == "various")
				{
					$this->db->where("product_id",$key->pro_id);
					$getr = $this->db->get("various")->result();
					foreach ($getr as $val) {
						$var[] = array
										(
											"qty_unit"=>$val->qty_unit,
											"price"=>$val->price
										);
					}
				}
				$this->db->where("brand_id",$key->brand_id);
				$brnd = $this->db->get("brands");
				if($brnd->num_rows()==0)
				{
					$brand = "";
				}
				else
				{
					$brnds = $brnd->row();
					$brand = $brnds->brand;
				}
				if($key->offer == null)
				{
					$offer = 0;
				}
				else
				{
					$offer = $key->offer;
				}
				$data[] = array
								(
									"prod_name"=>$key->product_name,
									"cat_name"=>$key->cat_name,
									"qty"=>$key->qty,
									"units"=>$key->units,
									"price"=>$key->price,
									"offer"=>$offer,
									"img"=>$key->main_img,
									"prId"=>$key->id,
									"var"=>$var,
									"brand"=>$brand,
									"pro_type"=>$key->pro_type,
									"pro_id"=>$key->pro_id

								);
			}
		}

		return $data;
	}

	public function getProductById($id)
	{
		$this->db->where("id",$id);
		$get = $this->db->get("products");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$row = $get->row();
			$unt = $row->units;
			$expl = explode(" ", $unt);
			$nm = $expl[0];
			$units = @$expl[1];

			if($row->var_type=="size")
			{
				$this->db->where("product_id",$row->pro_id);
				$getVarious = $this->db->get("varsize");
				if($getVarious->num_rows()==0)
				{
					$variousData = array();
				}
				else
				{
					$resVarious = $getVarious->result();
					foreach ($resVarious as $verkey) {
						$variousData[] = array
												(
													"var_id"=>$verkey->id,
													"size"=>$verkey->sizeString,
													"price"=>$verkey->price,
													"sale_price"=>$verkey->sale_price
												);
					}
				}
			}
			elseif($row->var_type=="color")
			{
				$this->db->order_by("id","ASC");
				$this->db->where("product_id",$row->pro_id);
				$getVarious = $this->db->get("varcolor");
				if($getVarious->num_rows()==0)
				{
					$variousData = array();
				}
				else
				{
					$resVarious = $getVarious->result();
					foreach ($resVarious as $verkey) {
						$variousData[] = array
												(
													"var_id"=>$verkey->id,
													"size"=>$verkey->color_name,
													"price"=>$verkey->price,
													"sale_price"=>$verkey->sale_price
												);
					}
				}
			}
			else
			{
				$variousData = array();
			}
			
			if($row->offer == null)
				{
					$offer = 0;
				}
				else
				{
					$offer = $row->offer;
				}
			$data = array
						(
							"prod_name"=>$row->product_name,
							"cat_name"=>$row->cat_name,
							"cat_id"=>$row->cat_id,
							"qty"=>$row->qty,
							"units"=>$units,
							"nm"=>$nm,
							"price"=>$row->price,
							"offer"=>$offer,
							"pro_type"=>$row->pro_type,
							"var_type"=>$row->var_type,
							"img"=>$row->main_img,
							"prId"=>$row->id,
							"descr"=>$row->descr,
							"brand_id"=>$row->brand_id,
							"various"=>$variousData,
							"proId"=>$row->pro_id,
							"returnable"=>$row->returnable
						);
		}

		return $data;
	}

	public function getGal($id)
	{
		$this->db->where("product_id",$id);
		$get = $this->db->get("product_gallery");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$data[]= array
								("id"=>$key->id,"images"=>$key->images);
			}


		}

		return $data;
	}

	public function updtProduct($prod_name,$catId,$qty,$units,$price,$descr,$id,$brand,$pro_type,$var_type,$proId,$offer,$salePrice,$returnable,$slug)
	{
		$this->db->where("id",$catId);
		$getCat = $this->db->get("category")->row();
		$proArray = array
							(
								"product_name"=>$prod_name,
								"pro_type"=>$pro_type,
								"var_type"=>$var_type,
								"brand_id"=>$brand,
								"cat_id"=>$catId,
								"cat_name"=>$getCat->cat_name,
								"qty"=>$qty,
								"units"=>$units,
								"price"=>$price,
								"offer"=>$offer,
								"descr"=>$descr,
								"sale_price"=>$salePrice,
								"returnable"=>$returnable,
								"slug"		=>$slug
							);
		$this->db->where("id",$id);
		$this->db->update("products",$proArray);
		$this->db->where("id",$id);
		$gget = $this->db->get("products")->row();
		$proId = $gget->pro_id;
		if($pro_type == "single")
		{
			$this->db->where("product_id",$proId);
			$this->db->delete("varcolor");

			$this->db->where("product_id",$proId);
			$this->db->delete("varsize");

			$this->db->where("pro_id",$proId);
			$this->db->update("products",["var_type"=>null]);
		}
		else
		{
			if($var_type == "color")
			{
				$this->db->where("product_id",$proId);
				$gtVr = $this->db->get("varcolor");
				if($gtVr->num_rows() > 0)
				{
					$rows = $gtVr->result();
					foreach($rows as $vr)
					{
						$prc = $vr->price;
						if($offer == "" || $offer == 0)
							{
								$salePrice = $prc;
								$ofr = 0;
							}
							else
							{
								$ofrPercent = $offer/100;
								$acOfer = $prc*$ofrPercent;
								$salePrice = $prc - $acOfer;
							}
							$this->db->where(["product_id"=>$proId,"price"=>$prc]);
							$this->db->update("varcolor",["sale_price"=>$salePrice]);
					}
				}
			}
			elseif($var_type == "size")
			{
				$this->db->where("product_id",$proId);
				$gtVr = $this->db->get("varsize");
				if($gtVr->num_rows() > 0)
				{
					$rows = $gtVr->result();
					foreach($rows as $vr)
					{
						$prc = $vr->price;
						if($offer == "" || $offer == 0)
							{
								$salePrice = $prc;
								$ofr = 0;
							}
							else
							{
								$ofrPercent = $offer/100;
								$acOfer = $prc*$ofrPercent;
								$salePrice = $prc - $acOfer;
							}
							$this->db->where(["product_id"=>$proId,"price"=>$prc]);
							$this->db->update("varsize",["sale_price"=>$salePrice]);
					}
				}
			}
		}
		return $proId;

	}

	public function uploadGal($data)
	{
		$this->db->insert_batch("product_gallery",$data);
	}

	public function getAllBanner()
	{
		$get = $this->db->get("ad_banner");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach($res as $row)
			{
				$this->db->where("id",$row->cat_id);
				$gt = $this->db->get("category");
				if($gt->num_rows()==0)
				{
					$cat_name = "";
				}
				else
				{
					$roww = $gt->row();
					$cat_name = $roww->cat_name;
				}
				$data[] = array("title"=>$row->title,"sl_text"=>$row->sl_text,"imgg"=>$row->images,"cat_name"=>$cat_name,"status"=>$row->status,"id"=>$row->id);
			}

		}

		return $data;
	}

	public function getBannerById($id)
	{
		$this->db->where("id",$id);
		$get = $this->db->get("ad_banner");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$row = $get->row();
			$this->db->where("id",$row->cat_id);
				$gt = $this->db->get("category");
				if($gt->num_rows()==0)
				{
					$cat_name = "";
				}
				else
				{
					$roww = $gt->row();
					$cat_name = $roww->cat_name;
				}
			$data = array("title"=>$row->title,"sl_text"=>$row->sl_text,"imgg"=>$row->images,"cat_id"=>$row->cat_id,"cat_name"=>$cat_name,"status"=>$row->status);
		}

		return $data;
	}

	public function getBanner()
	{
		$get = $this->db->get("ad_banner");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$row = $get->row();
			$data = array("title"=>$row->title,"imgg"=>$row->images,"status"=>$row->status);
		}

		return $data;
	}

	public function addbanner($title,$sl_text,$file_name,$status,$cat_id) 
	{
		$data = array
					(
						"title"=>$title,
						"sl_text"=>$sl_text,
						"images"=>$file_name,
						"cat_id"=>$cat_id,
						"status"=>$status
					);
		$this->db->insert("ad_banner",$data);
		return "succ";
	}
	public function addbannerTs($title,$status,$cat_id)
	{
		$data = array
					(
						"title"=>$title,
						"cat_id"=>$cat_id,
						"status"=>$status
					);
		$this->db->update("ad_banner",$data);
		return "succ";
	}

	public function updtbanner($id,$title,$sl_text,$status,$cat_id)
	{
		$data = array
					(
						"title"=>$title,
						"sl_text"=>$sl_text,
						"cat_id"=>$cat_id,
						"status"=>$status
					);
		$this->db->where("id",$id);
		$this->db->update("ad_banner",$data);
	}

	public function updtbannerFile($id,$title,$sl_text,$file_name,$status,$cat_id)
	{
		$data = array
					(
						"title"=>$title,
						"sl_text"=>$sl_text,
						"images"=>$file_name,
						"cat_id"=>$cat_id,
						"status"=>$status
					);
		$this->db->where("id",$id);
		$this->db->update("ad_banner",$data);
	}

	public function insrtPlanData($title,$descr,$price,$duration,$full_descr)
	{
		$this->db->where("title",$title);
		$get = $this->db->get("mem_plan");
		if($get->num_rows() > 0)
		{
			$return = "exst";
		}
		else
		{
			$data = array
						(
							"title"=>$title,
							"descr"=>$descr,
							"price"=>$price,
							"duration"=>$duration,
							"full_descr"=>$full_descr
						);
			$this->db->insert("mem_plan",$data);
			$return = "succ";
		}

		return $return;
	}

	public function getPlan()
	{
		$get = $this->db->get("mem_plan");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$data[] = array
						(
							"title"=>$key->title,
							"descr"=>$key->descr,
							"price"=>$key->price,
							"duration"=>$key->duration,
							"full_descr"=>$key->full_descr,
							"id"=>$key->id
						);
			}
		}

		return $data;
	}

	public function getPlanById($id)
	{
		$this->db->where("id",$id);
		$get = $this->db->get("mem_plan");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$key = $get->row();
			
				$data = array
						(
							"title"=>$key->title,
							"descr"=>$key->descr,
							"price"=>$key->price,
							"duration"=>$key->duration,
							"full_descr"=>$key->full_descr,
							"id"=>$key->id
						);
			
		}

		return $data; 
	}

	public function updtPlans($id,$title,$descr,$price,$duration,$full_descr)
	{
		$data = array
						(
							"title"=>$title,
							"descr"=>$descr,
							"price"=>$price,
							"duration"=>$duration,
							"full_descr"=>$full_descr
						);
		$this->db->where("id",$id);				
		$this->db->update("mem_plan",$data);
	}

	public function insBrand($brand,$cat_id,$file_name)
	{
		$this->db->where("brand",$brand);
		$chk =$this->db->get("brands")->num_rows();
		if($chk)
		{
			$return = "esxt";
		}
		else
		{
			$this->db->insert("brands",["brand"=>$brand,"cat_id"=>$cat_id,"image"=>$file_name]);
			$return = "success";
		}

		return $return;
	}

	public function brandData()
	{
		$getbrnd = $this->db->get("brands");
		if($getbrnd->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getbrnd->result();
			foreach ($res as $key) {
				$this->db->where("id",$key->cat_id);
				$gtcat = $this->db->get("category")->row();
				$data[] = array
							(
								"brand_id"=>$key->brand_id,
								"brand"=>$key->brand,
								"cat_name"=>$gtcat->cat_name,
								"image"=>$key->image
							);
			}
		}

		return $data;
	}

	public function getRefrl()
	{
		$gtref = $this->db->get('referral_setting');
		if($gtref->num_rows()==0)
		{
			$this->db->insert("referral_setting",["amount"=>0]);
			$data = array();
		}
		else
		{
			$row = $gtref->row();
			$data = array("amount"=>$row->amount);
		}

		return $data;
	}

	public function getTimeSlot()
	{
		$get = $this->db->get("order_timing");
		$row = $get->row();

		$data = array
					(
						"start_time"	=>$row->start_time,
						"finish_time"	=>$row->finish_time,
						"working_hour"	=>$row->working_hour,
						"time_slot"		=>$row->time_slot,
						"each_slot"		=>$row->each_slot,
						"take_ord"		=>$row->take_ord
					);

		return $data;
	}

	public function getAllSlots()
	{
		$get = $this->db->get("slots_timing");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"slot" =>$key->slot,
									"start" =>$key->start,
									"end"	=>$key->end
								);
			}
		}

		return $data;
	}

	public function getAllUsers()
	{
		$this->db->order_by("id","DESC");
		$getall = $this->db->get("users");
		if($getall->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getall->result();
			foreach ($res as $key) {
				if($key->verification_status == 1)
				{
					$status = "<b style='color:#090'>Active</b>";
				}
				else
				{
					$status = "<b style='color:#f00'>Inactive</b>";
				}
				$data[] = array
								(
									"user_id"	=>$key->id,
									"name"		=>$key->full_name,
									"username"	=>$key->username,
									"email"		=>$key->email,
									"phone"		=>$key->phone,
									"status"	=>$status
								);
			}
		}

		return $data;
	}

	public function getUserById($id)
	{
		$this->db->where("id",$id);
		$get = $this->db->get("users");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$key = $get->row();
			if($key->verification_status == 1)
				{
					$status = "Block";
				}
				else
				{
					$status = "Blocked";
				}
				$this->db->where("user_id",$id);
				$getWlt = $this->db->get("wallet");
				if($getWlt->num_rows()==0)
				{
					$wldata = "0.00";
				}
				else
				{
					$row = $getWlt->row();
					$wldata = $row->balance;
				}
				$this->db->where("user_id",$key->id);
				$gtShip = $this->db->get("shipping_address");
				if($gtShip->num_rows()==0)
				{
					$addr = "Not found!";
					$city = "Not found!";
					$state = "Not found!";
					$pin = "Not found!";
					$lm = "Not found!";
				}
				else
				{
					$rShip = $gtShip->row();
					$addr = $rShip->address;
					$city = $rShip->city;
					$state = $rShip->state;
					$pin = $rShip->pin;
					$lm = $rShip->nearby_location;
				}
			$data = array
								(
									"user_id"	=>$key->id,
									"name"		=>$key->full_name,
									"username"	=>$key->username,
									"email"		=>$key->email,
									"phone"		=>$key->phone,
									"status"	=>$status,
									"wldata"	=>$wldata,
									"proImg"	=>$key->profileimage,
									"addr"		=>$addr,
									"city"		=>$city,
									"state"		=>$state,
									"pin"		=>$pin,
									"lm"		=>$lm
								);
		}

		return $data;
	}

	public function rechargeWlt($id,$amt)
	{
		$this->db->where("user_id",$id);
		$getWlt = $this->db->get("wallet");
		$note = "Reward Added to wallet";
		if($getWlt->num_rows()==0)
		{
			$this->db->insert("wallet",["user_id"=>$id,"balance"=>$amt]);
			$this->db->insert("transaction",["user_id"=>$id,"notes"=>$note,"credit"=>$amt]);
			return $amt;
		}
		else
		{
			$rowWlt = $getWlt->row();
			$balance = $rowWlt->balance + $amt;
			$this->db->where("user_id",$id);
			$this->db->update("wallet",["balance"=>$balance]);
			$this->db->insert("transaction",["user_id"=>$id,"notes"=>$note,"credit"=>$amt]);
			return $balance;
		}
	}

	public function getminOrd()
	{
		$get = $this->db->get("settings");
		$row = $get->row();
		$data = array
					(
						"minOrdAmt"=>$row->min_order_amt
					);
		return $data;
	}

	public function getPrivacy()
	{
		$this->db->order_by("id","ASC");
		$getpr = $this->db->get("privacy_policy");
		if($getpr->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getpr->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"id"=>$key->id,
									"heading"=>$key->heading,
									"descr"	=>$key->description
								);
			}
		}

		return $data;
	}

	public function getTerms()
	{
		$this->db->order_by("id","ASC");
		$gettr = $this->db->get("terms_condition");
		if($gettr->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gettr->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"id"=>$key->id,
									"heading"=>$key->heading,
									"descr"	=>$key->description
								);
			}
		}

		return $data;
	}

	public function getCnum()
	{
		$get = $this->db->get("admin")->row();
		return  $get->c_help_number;
	}

	public function getFaqs()
	{
		$this->db->order_by("id","DESC");
		$get = $this->db->get("faq");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				
				$getPro = $this->getProductById($key->product_id);
				if(!empty($getPro))
				{
					$prod_name = $getPro['prod_name'];
				}
				else
				{
					$prod_name = "";
				}
				$data[] = array
								(

									"qstn" =>$key->question,
									"ansr"	=>$key->answer,
									"id"	=>$key->id,
									"prod_name"=>$getPro['prod_name']
								);
			}
		}

		return $data;
	}

	public function newOrders($sttat)
	{
		$this->db->where("status",$sttat);
		$this->db->order_by("id","DESC");
		$getOrd = $this->db->get("orders_transaction");
		if($getOrd->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getOrd->result();
			foreach ($res as $key) {
				$string = $key->cart_id;
				$str_arr = preg_split ("/\,/", $string);
				$cardData = []; 
				foreach($str_arr as $cart_id)
				{
					$this->db->order_by("cart_id","ASC");
					$this->db->where("cart_id",$cart_id);
					$getCart = $this->db->get("cart");
					if($getCart->num_rows()==0)
					{
						$cardData = array();
					}
					else
					{
						$resCart = $getCart->result();
						foreach($resCart as $carts)
						{
							$this->db->where("id",$carts->product_id);
							$getProd = $this->db->get("products");
							$proRow = $getProd->row();
							if($getProd->num_rows()==0)
							{
								$product_name = "";
								$proImg = "";
							}
							else
							{
								$product_name = $proRow->product_name;
								$proImg = base_url('uploads/products/'.$proRow->main_img);
								//Check if any various products in cart
								if($carts->variation_name == "undefined-undefined" || $carts->variation_name == "")
								{
									$variousData = array();
									$proImgs = $proImg;
									$price = $proRow->sale_price;
									$qty_unit = $proRow->units;
								}
								else
								{
									$expl = explode("-", $carts->variation_name);
									$varId = $expl[0];
									//Get Details from Various table
									$this->db->where("id",$varId);
									$getVar = $this->db->get("various");
									if($getVar->num_rows()==0)
									{
										$qty_unit = "";
										$price = "";
										$proImg = "";
									}
									else
									{
										$varRow = $getVar->row();
										$qty_unit = $varRow->qty_unit;
										$price = $varRow->price;
										$proImgs = base_url('uploads/products/'.$varRow->img);

									}
								}
								
							}
							$cardData[] = array
											(
												"cart_id"		=>$carts->cart_id,
												"userId"		=>$carts->user_id,
												"product_name"	=>$product_name,
												"proImg"		=>$proImgs,
												"qty_unit"		=>$qty_unit,
												"pricePer"		=>$price,
												"purchaseQty"	=>$carts->qty,
												"cartPrice"		=>$carts->price
											);
						}
						
					}
				} 
				//Get User Details
				$this->db->where("id",$key->user_id);
				$getUser = $this->db->get("users")->row();

				//Get Shipping Address
				$this->db->where("ship_id",$key->shipping_address_id);
				$getShip = $this->db->get("shipping_address")->row();

				
				
				$data[] = array
								(
									"id"	=>$key->id,
									"order_id"=>$key->order_id,
									"user_id"	=>$key->user_id,
									"user_name"=>@$getUser->full_name,
									"contactNo"=>@$getUser->phone,
									"date"		=>@$key->order_date,
									"grossTotal"=>$key->gross_total,
									"shipFullName" =>@$getShip->full_name,
									"shipContact" =>@$getShip->phone,
									"shipAddr"	=>@$getShip->address,
									"shipCity"	=>@$getShip->city,
									"shipPin"	=>@$getShip->pin,
									"nearLocation"	=>@$getShip->nearby_location,
									"cardData" =>$cardData,
									"status"	=>$key->status,
									
									"pay_status"=>$key->payment_status,
									"pay_method"=>$key->pay_method,
									

								);
			}
		}

		return $data;
	}

	//Single Order
	public function getSingleOrder($id)
	{
		$this->db->where("id",$id);
		//$this->db->order_by("id","DESC");
		$getOrd = $this->db->get("orders_transaction");
		if($getOrd->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$key = $getOrd->row();
			
				$string = html_entity_decode($key->cart_id);

				$str_arr = json_decode($string);
				$cardData = []; 
				foreach($str_arr as $cart_id)
				{
					$this->db->order_by("cart_id","ASC");
					$this->db->where("cart_id",$cart_id->cart_id);
					$getCart = $this->db->get("cart");
					if($getCart->num_rows()==0)
					{
						$cardData = array();
					}
					else
					{
						$resCart = $getCart->result();
						foreach($resCart as $carts)
						{
							$this->db->where("pro_id",$carts->product_id);
							$getProd = $this->db->get("products");
							$proRow = $getProd->row();
							if($getProd->num_rows()==0)
							{
								$product_name = "";
								$proImg = "";
							}
							else
							{
								$product_name = $proRow->product_name;
								$proImg = base_url('uploads/products/'.$proRow->main_img);
								//Check if any various products in cart
								if($carts->variation_name == "undefined-undefined" || $carts->variation_name == "")
								{
									$variousData = array();
									$proImgs = $proImg;
									$price = $proRow->sale_price;
									$qty_unit = $proRow->units;
									$varName = "";
								}
								else
								{
									$expl = explode("_", $carts->variation_name);
									$varId = $expl[0];
									$varName = $expl[2];
									
								}
								
							}
							$this->db->where("cart_id",$carts->cart_id);
							$this->db->select_sum("price");
							$getSub = $this->db->get("cart")->row();
							$subTotal = $getSub->price;
							$cardData[] = array
											(
												"cart_id"		=>$carts->cart_id,
												"userId"		=>$carts->user_id,
												"product_name"	=>$product_name." ".$varName,
												"proImg"		=>$proImg,
												
												"purchaseQty"	=>$carts->qty,
												"cartPrice"		=>$carts->price
												

											);
						}
						
					}
				} 
				//Get User Details
				$this->db->where("id",$key->user_id);
				$getUser = $this->db->get("users")->row();

				//Get Shipping Address
				$this->db->where("ship_id",$key->shipping_address_id);
				$getShip = $this->db->get("shipping_address")->row();

				$dt = date_create($key->order_date);
				$fullDate = date_format($dt,"F").",".date_format($dt,'d').", ".date_format($dt,"Y");;
				
				$data = array
								(
									"id"	=>$key->id,
									"order_id"=>$key->order_id,
									"user_id"	=>$key->user_id,
									"user_name"=>@$getUser->full_name,
									"contactNo"=>@$getUser->phone,
									"email"=>@$getUser->email,
									"date"		=>$key->order_date,
									"grossTotal"=>$key->gross_total,
									"shipFullName" =>@$getUser->full_name,
									"shipContact" =>@$getUser->phone,
									"shipAddr"	=>@$getShip->address,
									"shipCity"	=>@$getShip->city,
									"shipPin"	=>@$getShip->pin,
									"nearLocation"	=>@$getShip->nearby_location,
									"cartData" =>$cardData,
									"status"	=>$key->status,
									"fullDate"	=>$fullDate,
									"subTotal"		=>$key->prices,
									"tax"			=>$key->tax,
									"discount"		=>$key->coupon_discount

								);
			
		}

		return $data;
	}

	public function returnRequests()
	{
		$this->db->order_by("id","DESC");
		$get = $this->db->get("order_return");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key => $req) {
				$this->db->where("id",$req->user_id);
				$getUser = $this->db->get("users");
				if($getUser->num_rows()==0)
				{
					$name = "";
				}
				else
				{
					$name = $getUser->row()->full_name;
				}
				$this->db->where("cart_id",$req->cart_id);
				$gtCrt = $this->db->get("cart")->row();
				$this->db->where("pro_id",$gtCrt->product_id);
				$getProd = $this->db->get("products");
				if($getProd->num_rows()==0)
				{
					$proname = "";
				}
				else
				{
					$proname = $getProd->row()->product_name;
				}
				if($req->photo =="")
				{
					$photo = "<i class='fas picture-o'></i>";
				}
				else
				{
					//$photo = base_url('uploads/products/'.$req->photo);
					$photo = $req->photo;
				}
				$data[] = array
							(
								"order_id"		=>$req->order_id,
								"custName"		=>$name,
								"product_name"	=>$proname,
								"reason"		=>$req->notes,
								"qty"			=>$req->qty,
								"price"			=>@$req->amount,
								"status"		=>$req->status,
								"photo"			=>$photo,
								"id"			=>$req->id,
								"pickup_date"	=>@$req->pickup_date,
								"user_id"		=>$req->user_id

							);
			}
		}

		return $data;
	}

	public function addDelBoys($name,$phone,$email,$password,$file_name)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->db->where("delvr_phone",$phone);
		$get = $this->db->get("delivery_boys")->num_rows();
		if($get >0)
		{
			$ret = "exst";
		}
		else
		{
			$data = array
						(
							"delvr_name" =>$name,
							"delvr_email"=>$email,
							"delvr_phone"=>$phone,
							"delvr_password"=>$password,
							"profile_pic"	=>$file_name,
							"join_date"		=>date('Y-m-d')
						);
			$this->db->insert("delivery_boys",$data);
			$ret = "succ";
		}

		return $ret;

	}

	public function getDeliveryBoys()
	{
		$this->db->order_by("id","DESC");
		$get = $this->db->get("delivery_boys");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$data[] = array
							(
								"id"		=>$key->id,
								"name"		=>$key->delvr_name,
								"email"		=>$key->delvr_email,
								"phone"		=>$key->delvr_phone,
								"pro_pic"	=>$key->profile_pic,
								"join_date"	=>$key->join_date
							);
			}
		}

		return $data;
	}

	public function getDelBbyId($id)
	{
		$this->db->where("id",$id);
		$get = $this->db->get("delivery_boys");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$key = $get->row();
			
				$data = array
							(
								"id"		=>$key->id,
								"name"		=>$key->delvr_name,
								"email"		=>$key->delvr_email,
								"phone"		=>$key->delvr_phone,
								"pro_pic"	=>$key->profile_pic,
								"join_date"	=>$key->join_date
							);
			
		}

		echo json_encode($data);
	}

	public function setStaff($user,$mob,$pass)
	{
		$this->db->where("admin_user",$user);
		$chk1 = $this->db->get("admin")->num_rows();
		if($chk1 > 0)
		{
			$return = "exst_usr";
		}
		else
		{
			$this->db->where("mobile",$mob);
			$chk2 = $this->db->get("admin")->num_rows();
			if($chk2 > 0)
			{
				$return = "exst_mob";
			}
			else
			{
				$data = array
							(
								"admin_user"=>$user,
								"mobile"=>$mob,
								"password"=>$pass,
								"login_type"=>"staff",
								"status"	=>1
							);
				$this->db->insert("admin",$data);
				$return = "succ";
			}
		}

		return $return;
	}

	public function getAllStaff()
	{
		$this->db->where("login_type","staff");
		$get = $this->db->get("admin");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"user"	=>$key->admin_user,
									"mobile"=>$key->mobile,
									"login_type"=>$key->login_type,
									"status"	=>$key->status,
									"id"	=>$key->id
								);
			}
		}

		return $data;
	}

	public function dashdata()
	{
		$totUser = $this->db->get("users")->num_rows();
		$this->db->where("active",1);
		$totProducts = $this->db->get("products")->num_rows();
		$this->db->where("status","Pending");
		$newOrder = $this->db->get("orders_transaction")->num_rows();
		$this->db->where("status",0);
		$requests = $this->db->get("order_return")->num_rows();

		$data = array
					(
						"totUser"		=>$totUser,
						"totProducts"	=>$totProducts,
						"newOrder"		=>$newOrder,
						"requests"		=>$requests
					);
		return $data;
	}

	public function getPreniumMember()
	{
		$this->db->order_by("id","DESC");
		$get = $this->db->get("subscription");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$this->db->where("id",$key->user_id);
				$usr = $this->db->get("users")->row();

				$this->db->where("id",$key->sid);
				$plan = $this->db->get("mem_plan")->row();

				$data[] = array
								(
									"name" 		=>$usr->full_name,
									"email"		=>$usr->email,
									"mobile"	=>$usr->phone,
									"amount"	=>$plan->price,
									"valiupto"	=>$key->dateto,
									"fetures"	=>$plan->descr,
									"plan_name"	=>$plan->title,
									"descr"		=>$plan->descr,
									"status"	=>$key->status
									
								);
			}
		}

		return $data;
	}

	public function getTax()
	{
		$get = $this->db->get("settings");
		$row = $get->row();
		$data = array
					(
						"tax"=>$row->tax
					);
		return $data;
	}
	
	
}