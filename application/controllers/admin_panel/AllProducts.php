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

		$updtProduct = $this->AdminModel->updtProduct($prod_name,$catId,$qty,$units,$price,$descr,$id,$brand,$pro_type,$var_type,$proId,$offer,$salePrice,$returnable);
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
		$getvar = $this->db->update("varcolor", ["colorcode" =>$colorcode]);
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
		$this->db->where("product_id",$pro_id);
		$getvar = $this->db->get("various");
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
									"qty_unit" =>$value->qty_unit,
									"price"	=>$value->price,
									"stock"	=>$value->stock_qty,
									"img"	=>$value->img,
									"id"	=>$value->id
								);
			}
		}
		$s = 1;

		foreach ($data as $key):
			$ss = $s++;
			if($key['img']==null)
			{
				$img = "<form action='".base_url('admin_panel/AllProducts/uplvarImg')."' method='post' enctype='multipart/form-data'>
						<label id='lb_".$ss."' for='inp_".$ss."'><i class='fas fa-upload cp'></i></label>
						<input onchange='maketick(this.id)' id='inp_".$ss."' type='file' name='varImg' class='upld' required>
						<input type='hidden' name='id' value='".$key['id']."'>
						<button id='bt_".$ss."'  class='btn plbtn'>Upload</button>
				</form>";
			}
			else
			{
				$img = "<form action='".base_url('admin_panel/AllProducts/uplvarImg')."' method='post' enctype='multipart/form-data'>
						<label id='lb_".$ss."' for='inp_".$ss."'><img width='35' src='".base_url('uploads/products/'.$key['img'])."' /></label>
						<input onchange='maketick(this.id)' id='inp_".$ss."' type='file' name='varImg' class='upld' required>
						<input type='hidden' name='id' value='".$key['id']."'>
						<button  id='bt_".$ss."'  class='btn plbtn'>Upload</button>
				</form>";
			}
		 ?>

			<tr>
				<td class="text-center"><?= $img; ?></td>
				<td><?= $key['qty_unit']; ?></td>
				<td><?= $key['price']; ?></td>
				<td><?= $key['stock']; ?></td>
				
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
}