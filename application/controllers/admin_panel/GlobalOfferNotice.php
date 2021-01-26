<?php
/**
 * 
 */
class GlobalOfferNotice extends CI_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		/*
		if(!$this->session->userdata("UserAdmin"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			return redirect("admin_panel/AdminLogin?refer=$actual_link");
		
		}
		*/
	}
	
	function index()
	{
		$title = $this->input->post("title");
		$message = $this->input->post("message");
		$cat_id = $this->input->post("cat_id");
		
		$dir_name ='./uploads/notice_img';
				if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
        	
	        	
	        	$config['upload_path']          = './uploads/notice_img/';
                $config['max_size'] = '*';
				$config['allowed_types'] = 'png|jpg|PNG|JPG'; 
				$config['remove_spaces'] = TRUE;
				$fileName = mt_rand(0000000, 9999999);
				$config['file_name'] = $fileName;
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('main_img'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        $this->session->set_flashdata("FL","Maximum size issue!");
                        $file_name = "";
                        
                }
                else
                {
                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
						$file_name = $upload_data['file_name'];
						
						
				}

				$imgg = base_url('uploads/notice_img/'.$file_name); 
				//echo $message;

		$this->db->where("deviceid!=",null);
		$users = $this->db->get("users")->result();
		$fcmRegIds = array();
		foreach($users as $usr)
		{
			array_push($fcmRegIds,$usr->deviceid);
		}

		if(isset($fcmRegIds)) {
	      foreach ($fcmRegIds as $key => $token) {
	         $pushStatus = $this->pushNotice($token,$title,$imgg,$message,$file_name,$cat_id);
	      }

	      $this->session->set_flashdata("Feed","Notification Sent Successfully");
	      //return redirect("admin_panel/Send_Offer_Notification");
	   }
	}

		function pushNotice($token,$title,$imgg,$message,$file,$cat_id)
		{

			ignore_user_abort();
	   		ob_start();
			// API access key from Google FCM App Console
		
	$API_ACCESS_KEY = 'AAAATRYK8KY:APA91bFTUS2VayYqtugaMOuPYIAd_Xl2_kgZUdbISYR8NHUZvYCniJlqNakA_WpGub7M-qF1MuJs2Xu7XwswUT4ex7N6x01ypBQq6JOfTHOX4-kmrNVipMb-3k9fXb8E3VCDHlKbGgjr';

	$fcmMsg = array(
		'body' => $message,
		'title' => $title,
		'sound' => "default",
	    'color' => "#203E78",
	    'image' => $imgg
	);

	$fcmData = array('body' => $message,
		'title' => $title,
		'sound' => "default",
	    'color' => "#203E78",
	    'image' => $imgg,
	    'cat_id'=> $cat_id
	);

	$fcmFields = array(
		//'to' => $registrationIDs,
		'to' => $token,
	        'priority' => 'high',
		'notification' => $fcmMsg,
		'data' 	=>$fcmData,
		'isGlobal'=>1
	);

	//print_r($fcmMsg);

	$headers = array(
		'Authorization: key=' . $API_ACCESS_KEY,
		'Content-Type: application/json'
	);

	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
	$result = curl_exec($ch );
	curl_close( $ch );
	//echo $result . "\n\n";


					
				
		}
}