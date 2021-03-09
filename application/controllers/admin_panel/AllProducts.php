<?php
/**
 * 
 */
class AllProducts extends CI_controller
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

	public function index()
	{
		$getAllProducts = $this->AdminModel->getAllProducts();

		//print_r($getAllProducts);
		$this->load->view("admin/AllProducts",["data"=>$getAllProducts]); 
	}

	public function EditProd($id)
	{
		$getProductById = $this->AdminModel->getProductById($id);
		$getCat = $this->AdminModel->getAllCat();
		$getUnit = $this->AdminModel->getUnit();
		$getGal = $this->AdminModel->getGal($id);
		$getBrand = $this->AdminModel->brandData();
		$this->load->view("admin/EditProductsNew",["prodata"=>$getProductById,"data"=>$getCat,"units"=>$getUnit,"getGal"=>$getGal,"brand"=>$getBrand]);
		//echo "<pre>";
		//print_r($getProductById);
	}

	public function DelProd($id)
	{
		$this->db->where("id",$id);
		$this->db->update("products",["active"=>0]);
		$this->session->set_flashdata("Feed","Product Deleted");
		return redirect("admin_panel/AllProducts");
	}

	 public function updateProduct() 
	 {
	 	$prod_name = $this->input->post("prod_name");
		$catId = $this->input->post("cat_id");
		$qty = $this->input->post("qty");
		$unitss = $this->input->post("units");
		$nm = $this->input->post("nm");
		$price = $this->input->post("price");
		$descr = $this->input->post("descr");
		$id = $this->input->post("id");
		$brand = $this->input->post("brand");
		//$stock_qty = $this->input->post("stqty_new");
		//$varsQty = $this->input->post("qtys_new");
		//$varsUnit = $this->input->post("prcce_new");
		$varColor = $this->input->post("colors_new");
		$varSize = $this->input->post("size_new");
		$varsPrcc = $this->input->post("prcce_new");
		$varsPrcc2 = $this->input->post("prcce2_new");

		$proId = $this->input->post("proId");
		$pro_type = $this->input->post("pro_type");
		$var_type = $this->input->post("var_type");
		$offer = $this->input->post("offer");
		$returnable = $this->input->post("returnable");
		$pronameSmall = strtolower($prod_name);
		$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $prod_name)));

		$units = $nm.' '.$unitss;

		if($offer == "" || $offer == 0)
		{
			$salePrice = $price;
			$ofr = 0;
		}
		else
		{
			$ofrPercent = $offer/100;
			$acOfer = $price*$ofrPercent;
			$salePrice = $price - $acOfer;
		}

		$updtProduct = $this->AdminModel->updtProduct($prod_name,$catId,$qty,$units,$price,$descr,$id,$brand,$pro_type,$var_type,$proId,$offer,$salePrice,$returnable,$slug);
		if($pro_type =="various")
		{
			if($var_type=="color")
			{
				if(!empty($varColor))
				{
					$setVarColorPro = $this->AdminModel->setvarProductColor($proId,$varColor,$varsPrcc,$offer);
			    }

				//print_r($setVarColorPro);
			}
			elseif($var_type =="size")
			{
				if(!empty($varSize))
				{
					$setVarSizePro = $this->AdminModel->setvarProductSize($proId,$varSize,$varsPrcc2,$offer);
				}
				//print_r($setVarSizePro);
			}
			//$setvarProduct = $this->AdminModel->setvarProduct($proId,$varsQty,$varsUnit,$varsStQty,$offer); 
		}
				$config['upload_path']          = './uploads/products/';
                $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
				$config['remove_spaces'] = TRUE;
				$fileName = mt_rand(0000000, 9999999);
				$config['file_name'] = $fileName;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('main_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //print_r($error);
                        $this->session->set_flashdata("FL","Maximum size issue!");
                        
                }
                else
                {
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $upload_data['file_name'];
						$addImg = $this->AdminModel->addImg($updtProduct,$file_name);
						
				}
				$this->session->set_flashdata("Feed","Product Updated Successfully");
		return redirect("admin_panel/AllProducts");
	 }

	 public function uplGal()
	 {
	 	$id = $this->input->post("id");
		$this->load->library('upload');
		  $image = array();
		  $ImageCount = count($_FILES['proImg']['name']);
		        for($i = 0; $i < $ImageCount; $i++){
		            $_FILES['file']['name']       = $_FILES['proImg']['name'][$i];
		            $_FILES['file']['type']       = $_FILES['proImg']['type'][$i];
		            $_FILES['file']['tmp_name']   = $_FILES['proImg']['tmp_name'][$i];
		            $_FILES['file']['error']      = $_FILES['proImg']['error'][$i];
		            $_FILES['file']['size']       = $_FILES['proImg']['size'][$i];

		            // File upload configuration
		            $uploadPath = './uploads/products/';
		            $config['upload_path'] = $uploadPath;
		            $config['allowed_types'] = 'jpg|jpeg|png|gif';

		            // Load and initialize upload library
		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);

		            // Upload file to server
		            if($this->upload->do_upload('file')){
		                // Uploaded file data
		                $imageData[$i] = $this->upload->data();
		                 //$uplData[] = $imageData['file_name'];

		                 $data = array("product_id"=>$id,"images"=>$imageData[$i]['file_name']);
		                 $this->db->insert("product_gallery",$data);


		            }
		        }
		        
		        return redirect("admin_panel/AllProducts/EditProd/".$id);
		    }

	public function delgal($id)
	{
		$prodId = $this->uri->segment(5);
		$this->db->where("id",$id);
		$this->db->delete("product_gallery");
		return redirect("admin_panel/AllProducts/EditProd/".$prodId);
	}

	public function updtvariousStQty()
	{
		$var_id = $this->input->post("var_id");
		$stock = $this->input->post("stock");
		$this->db->where("id",$var_id);
		$this->db->update("various",["stock_qty"=>$stock]);
	}

	public function updtvariousQty()
	{
		$var_id = $this->input->post("var_id");
		$qty_unit = $this->input->post("qty_unit");
		$this->db->where("id",$var_id);
		$this->db->update("various",["qty_unit"=>$qty_unit]);
	}

	public function updtvariousPrice()
	{
		$var_id = $this->input->post("var_id");
		$price = $this->input->post("price");
		$this->db->where("id",$var_id);
		$this->db->update("various",["price"=>$price]);
	}

	public function delvarious()
	{
		$var_id = $this->input->post("var_id");
		$this->db->where("id",$var_id);
		$this->db->delete("various");
	}


	public function ChangeVarSize()
	{
		$id = $this->input->post("id");
		$size = $this->input->post("size");
		$this->db->where("id",$id);
		$getvar = $this->db->update("varsize", ["sizeString" =>$size]);
	}

	public function ChangeVarSize_prize()
	{
		$id = $this->input->post("id");
		$price = $this->input->post("price");
		$this->db->where("id",$id);
		$getvar = $this->db->update("varsize", ["price" =>$price]);
	}

	public function ChangeVarColor()
	{
		$id = $this->input->post("id");
		$colorcode = $this->input->post("colorcode");
		$this->db->where("id",$id);
		$getvar = $this->db->update("varcolor", ["color_name" =>$colorcode]);
	}

	public function ChangeVarColor_prize()
	{
		$id = $this->input->post("id");
		$price = $this->input->post("price");
		$this->db->where("id",$id);
		$getvar = $this->db->update("varcolor", ["price" =>$price]);
	}

	public function getVarious()
	{
		$pro_id = $this->input->post("pro_id");
		$this->db->where("pro_id",$pro_id);
		$gtProd = $this->db->get("products")->row();
		if($gtProd->var_type=="size")
		{
			$this->db->where("product_id",$pro_id);
			$getvar = $this->db->get("varsize");
			if($getvar->num_rows()==0)
			{
				$data = array();
			}
			else
			{
				$res = $getvar->result();
				foreach ($res as $key => $value) {
					$data[] = array
									(
										"size" =>$value->sizeString,
										"price"	=>$value->price,
										"salePrice"	=>$value->sale_price,
										"img"	=>$value->img,
										"id"	=>$value->id,
										"var_type" =>$gtProd->var_type
									);
				}
			}
		}
		else
		{
			$this->db->where("product_id",$pro_id);
			$getvar = $this->db->get("varcolor");
			if($getvar->num_rows()==0)
			{
				$data = array();
			}
			else
			{
				$res = $getvar->result();
				foreach ($res as $key => $value) {
					$data[] = array
									(
										"size" =>$value->color_name,
										"price"	=>$value->price,
										"salePrice"	=>$value->sale_price,
										"img"	=>$value->img,
										"id"	=>$value->id,
										"var_type" =>$gtProd->var_type
									);
				}
			}
		}
		
		$s = 1;

		foreach ($data as $key):
			$ss = $s++;
			if($key['var_type']=="size")
			{
				$sz = "<span>".$key['size']."</span>";
			}
			else
			{
				$sz = "<span>".$key['size']."</span>";
			}
		 ?>

			<tr>
				<td><?= $sz; ?></td>
				<td><?= $key['price']; ?></td>
				<td><?= $key['salePrice']; ?></td>
				
			</tr>
		<?php endforeach; 
		echo "<tr><td>".$gtProd->product_name."</td></tr>";
	}


	public function uplvarImg()
	{
		$id = $this->input->post("id");
		$config['upload_path']          = './uploads/products/';
        $config['max_size'] = '*';
		$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
		$config['remove_spaces'] = TRUE;
		$fileName = mt_rand(0000000, 9999999);
		$config['file_name'] = $fileName;
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('varImg'))
        {
                $error = array('error' => $this->upload->display_errors());
                //print_r($error);
                $this->session->set_flashdata("FL","Maximum size issue!");
                
        }
        else
        {
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
				$file_name = $upload_data['file_name'];
				$this->db->where("id",$id);
				$this->db->update("various",["img"=>$file_name]);
				$this->session->set_flashdata("Feed","Image Changed Successfully");
				return redirect("admin_panel/AllProducts");
				
				
		}
	}


	public function getProsettings()
	{
		$pro_id = $this->input->post("pro_id");
		$this->db->where("pro_id",$pro_id);
		$gtProd = $this->db->get("products")->row();
		$data  = array
					(
						"top_pro" =>$gtProd->top_pro,
						"feature_pro"	=>$gtProd->feature_pro,
						"spl_offer"		=>$gtProd->spl_offer,
						"new_pro"		=>$gtProd->new_pro,
						"pro_id"		=>$pro_id,
						"upcoming"		=>$gtProd->upcoming,
						"prod_name"		=>$gtProd->product_name
					);

		echo json_encode($data);
	}

	public function SetProSetting()
	{
		$pro_id = $this->input->post("pro_id");
		$top_pro = $this->input->post("top_pro");
		$upcoming = $this->input->post("upcoming");
		$feature_pro = $this->input->post("feature_pro");
		$spl_offer = $this->input->post("spl_offer");
		$new_pro = $this->input->post("new_pro");
		$data = array
					(
						"top_pro" 		=>$top_pro,
						"feature_pro"	=>$feature_pro,
						"spl_offer"		=>$spl_offer,
						"new_pro"		=>$new_pro,
						"upcoming"		=>$upcoming

						
					);
		$this->db->where("pro_id",$pro_id);
		$this->db->update("products",$data);
		$this->session->set_flashdata("Feed","Product Settings Successfully");
				return redirect("admin_panel/AllProducts");
	}
}