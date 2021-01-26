<?php 
/**
 * 
 */
class AddCategory extends CI_controller
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
		if($this->uri->segment(4)=="edit")
		{
			$id = $this->uri->segment(5);
			$getCatById = $this->AdminModel->getCatById($id);
			$this->load->view("admin/AddCategory",["data"=>$getCatById]);
		}else
		{
			$this->load->view("admin/AddCategory");
		}
	}

	public function addCat()
	{
		$cat_name = $this->input->post("cat_name");
		$dir_name ='./uploads/category';
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
        	
	        	
	        	$config['upload_path']          = './uploads/category/';
                $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
				$config['remove_spaces'] = TRUE;
				$fileName = mt_rand(0000000, 9999999);
				$config['file_name'] = $fileName;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('cat_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //print_r($error);
                        $this->session->set_flashdata("FL","Maximum size issue!");
                        
                }
                else
                {
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $upload_data['file_name'];
						$insrtCat = $this->AdminModel->insrtCat($cat_name,$file_name);
						
				}
				
		if($insrtCat == "exst")
		{
			$this->session->set_flashdata("Feed","Categoty Name ".$cat_name." Alresdy Exist!");
			return redirect("admin_panel/AddCategory");
		}
		elseif($insrtCat == "succ")
		{
			$this->session->set_flashdata("Feed","Categoty Name ".$cat_name." Added Successfully");
			return redirect("admin_panel/AddCategory");
		}
		else
		{
			$this->session->set_flashdata("Feed","Database Error");
			return redirect("admin_panel/AddCategory");
		}
		

		//echo $insrtCat;
	}

	public function editCat($id)
	{
		

		
		
			$dir_name ='./uploads/category';
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
        	
	        	
	        	$config['upload_path']          = './uploads/category/';
                $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
				$config['remove_spaces'] = TRUE;
				$fileName = mt_rand(0000000, 9999999);
				$config['file_name'] = $fileName;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('cat_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //print_r($error);
                        $this->session->set_flashdata("FL","Maximum size issue!");
                        $cat_name = $this->input->post("cat_name");
                        $this->db->where("id",$id);
						$this->db->update("category",["cat_name"=>$cat_name]);
						$updateCat = "succ";
                        
                }
                else
                {
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $upload_data['file_name'];
						$cat_name = $this->input->post("cat_name");
						$updateCat = $this->AdminModel->updateCat($cat_name,$id,$file_name);
						
						
				}
			
				if($updateCat == "succ")
							{
								$this->session->set_flashdata("Feed","Categoty Name ".$cat_name." Updated Successfully");
								return redirect("admin_panel/AllCategory");
							}
							else
							{
								$this->session->set_flashdata("Feed","Database Error");
								return redirect("admin_panel/AllCategory");
							}
		

	}

	function delCat($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("category");
		$this->session->set_flashdata("Feed","Categoty Deleted");
		return redirect("admin_panel/AllCategory");
	}
}