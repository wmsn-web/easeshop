<?php
/**
 * 
 */
class AddProducts extends CI_controller
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
		$getCat = $this->AdminModel->getAllCat();
		$getUnit = $this->AdminModel->getUnit();
		$getBrand = $this->AdminModel->brandData();
		$this->load->view("admin/AddProductsNew",["data"=>$getCat,"units"=>$getUnit,"brand"=>$getBrand]); 
	}

	public function insrtProduct()
	{
		$prod_name = $this->input->post("prod_name");
		$catId = $this->input->post("cat_id");
		$qty = $this->input->post("qty");
		$unitss = $this->input->post("units");
		$nm = $this->input->post("nm");
		$price = $this->input->post("price");
		$descr = $this->input->post("descr");
		$units = $nm.' '.$unitss;
		$pro_type = $this->input->post("pro_type");
		$var_type = $this->input->post("var_type");
		$brand = $this->input->post("brand");
		$varColor = $this->input->post("colors");
		$varSize = $this->input->post("size");
		$varsPrcc = $this->input->post("prcce");
		$varsPrcc2 = $this->input->post("prcce2");
		//$varsStQty = $this->input->post("stqty");
		//$varsQty = $this->input->post("qtys");
		//$varsUnit = $this->input->post("prcce");
		$offer = $this->input->post("offer");
		$returnable = $this->input->post("returnable");
		$proId = uniqid();
		if($offer == "" || $offer == "0")
		{
			$salePrice = $price;
			$ofr = "0";
		}
		else
		{
			$ofrPercent = $offer/100;
			$acOfer = $price*$ofrPercent;
			$salePrice = $price - $acOfer;
		}

		


		$setProduct = $this->AdminModel->insrtProducts($prod_name,$catId,$qty,$units,$price,$descr,$pro_type,$var_type, $proId,$brand,$offer,$salePrice,$returnable);
		
		if($pro_type =="various")
		{
			if($var_type=="color")
			{
				$setVarColorPro = $this->AdminModel->setvarProductColor($proId,$varColor,$varsPrcc,$offer);

				print_r($setVarColorPro);
			}
			else
			{
				$setVarSizePro = $this->AdminModel->setvarProductSize($proId,$varSize,$varsPrcc2,$offer);
				print_r($setVarSizePro);
			}
			//$setvarProduct = $this->AdminModel->setvarProduct($proId,$varsQty,$varsUnit,$varsStQty,$offer); 
		}
		
		if($setProduct == "0")
		{
			$this->session->set_flashdata("Feed","Product Already Exist.");
			//return redirect("admin_panel/AddProducts");
		}
		else
		{
			$dir_name ='./uploads/products';
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
        	
	        	
	        	$config['upload_path']          = './uploads/products/';
                $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
				$config['remove_spaces'] = TRUE;
				$fileName = uniqid();
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
						$addImg = $this->AdminModel->addImg($setProduct,$file_name);
						
				}
			$this->session->set_flashdata("Feed","Product Added Successfully.");
			return redirect("admin_panel/AddProducts");
		}

		echo $setProduct;
		
		
	}
}