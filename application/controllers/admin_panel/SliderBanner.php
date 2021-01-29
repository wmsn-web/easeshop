<?php
/**
 * 
 */
class SliderBanner extends CI_controller
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
		$getBanner = $this->AdminModel->getAllBanner();
		$getAllCat = $this->AdminModel->getAllCat();
		$getBannerById = array();
		if($this->uri->segment(5))
		{
			$id = $this->uri->segment(5);
			$getBannerById = $this->AdminModel->getBannerById($id);
		}
		
		$this->load->view("admin/SliderBanner",["data"=>$getBanner,"catData"=>$getAllCat,"banData"=>$getBannerById]); 
	}

	public function uploadBanner()
	{
		$title = $this->input->post("title");
		$status = $this->input->post("status");
		$cat_id = $this->input->post("cat_id");
		$dir_name ='./uploads/banners';
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
        	
	        	
	        	$config['upload_path']          = './uploads/banners/';
                $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
				$config['remove_spaces'] = TRUE;
				$fileName = mt_rand(0000000, 9999999);
				$config['file_name'] = $fileName;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('main_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        $this->session->set_flashdata("FL","Maximum size issue!");
                        
                }
                else
                {
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $upload_data['file_name'];
						
						$addbanner = $this->AdminModel->addbanner($title,$file_name,$status,$cat_id); 
						
				}
				//$addbanner = $this->AdminModel->addbannerTs($title,$status,$cat_id);
				$this->session->set_flashdata("Feed","Banner Successfully Updated.");
				return redirect("admin_panel/SliderBanner");
	}

	public function DelBanner($id='')
	{
		$this->db->where("id",$id);
		$this->db->delete("ad_banner");
		$this->session->set_flashdata("Feed","Banner Successfully Deleted.");
		return redirect("admin_panel/SliderBanner");
	}

	public function EdituploadBanner()
	{
		$title = $this->input->post("title");
		$status = $this->input->post("status");
		$cat_id = $this->input->post("cat_id");
		$id = $this->input->post("id");

		


		$dir_name ='./uploads/banners';
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
        	
	        	
	        	$config['upload_path']          = './uploads/banners/';
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
                        $updtbanner = $this->AdminModel->updtbanner($id,$title,$status,$cat_id);
                        
                }
                else
                {
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $upload_data['file_name'];
						
						$updtbanner = $this->AdminModel->updtbannerFile($id,$title,$file_name,$status,$cat_id); 
						
				}
				//$addbanner = $this->AdminModel->addbannerTs($title,$status,$cat_id);
				$this->session->set_flashdata("Feed","Banner Successfully Updated.");
				return redirect("admin_panel/SliderBanner");
	}

}