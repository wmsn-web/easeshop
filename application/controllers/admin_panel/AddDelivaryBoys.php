<?php
/**
 * 
 */
class AddDelivaryBoys extends CI_controller
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
		$this->load->view("admin/AddDelivaryBoys");
	}

	public function addBoys()
	{
		$name = $this->input->post("name");
		$phone = $this->input->post("phone");
		$email = $this->input->post("email");
		$password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
		
		$dir_name ='./uploads/delivary_boys';
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
        	
	        	
	        	$config['upload_path']          = './uploads/delivary_boys/';
                $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
				$config['remove_spaces'] = TRUE;
				$fileName = uniqid();
				$config['file_name'] = $fileName;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('pro_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //print_r($error);
                        $addImg = "inv";
                        
                        
                }
                else
                {
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $upload_data['file_name'];
						$addImg = $this->AdminModel->addDelBoys($name,$phone,$email,$password,$file_name);
						
				}

				if($addImg == "inv")
				{
					$this->session->set_flashdata("Feed","Invalid Image");
                        return redirect("admin_panel/AddDelivaryBoys");
				}
				elseif($addImg =="succ")
				{
					$this->session->set_flashdata("Feed","Delivary Boy Register successfully");
                        return redirect("admin_panel/AddDelivaryBoys");
				}
				else
				{
					$this->session->set_flashdata("Feed","Delivary Boy Already Exist!");
                        return redirect("admin_panel/AddDelivaryBoys");
				}
	}

	public function updateBoys()
	{
		$id = $this->input->post("id");
		$name = $this->input->post("name");
		$phone = $this->input->post("phone");
		$email = $this->input->post("email");

		if ($_FILES['pro_pic']['name']=="")
		{
			$this->db->where("id",$id);
			$this->db->update("delivery_boys",["delvr_name"=>$name,"delvr_email"=>$email,"delvr_phone"=>$phone]);
			$this->session->set_flashdata("Feed","Delivary Boy Updated");
            return redirect("admin_panel/AllDelivaryBoys");
		}
		else
		{
			$config['upload_path']          = './uploads/delivary_boys/';
            $config['max_size'] = '*';
			$config['allowed_types'] = 'png|jpg|PNG|JPG|jpeg|JPEG|gif|GIF'; # add video extenstion on here
			$config['remove_spaces'] = TRUE;
			$fileName = uniqid();
			$config['file_name'] = $fileName;
            
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('pro_pic'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                    $this->session->set_flashdata("Feed","Invalid Image Selected");
            		return redirect("admin_panel/AllDelivaryBoys");
                    
                    
            }
            else
            {
                    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
					$file_name = $upload_data['file_name'];
					$this->db->where("id",$id);
					$this->db->update("delivery_boys",["delvr_name"=>$name,"delvr_email"=>$email,"delvr_phone"=>$phone,"profile_pic"=>$file_name]);
					$this->session->set_flashdata("Feed","Delivary Boy Updated");
            		return redirect("admin_panel/AllDelivaryBoys");
					
			}
		}
	}

	public function ChangePawword()
	{
		$id = $this->input->post("id");
		$password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
		$this->db->where("id",$id);
		$this->db->update("delivery_boys",["delvr_password"=>$password]);
		$this->session->set_flashdata("Feed","Delivary Boy Updated");
            		return redirect("admin_panel/AllDelivaryBoys");
	}

	public function DelDelvrBoys($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("delivery_boys");
		$this->session->set_flashdata("Feed","Delivary Boy Deleted");
            		return redirect("admin_panel/AllDelivaryBoys");
	}
}