<?php
/**
 * 
 */
class SendMail extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->library('email');
		$config = array(
		       
        'protocol' => 'smtp', 
        'smtp_host' => 'mail.easeshop.in', 
        'smtp_port' => 465, 
        'smtp_user' => '_mainaccount@easeshop.in',  
        'smtp_pass' => 'n@f535EXqDd7#K', 
        'mailtype' => 'html', 
        'charset' => 'iso-8859-1'
    );
		$mesage = "Test Mail";//$this->load->view("admin/emails/EmailTemplate.php",$data,TRUE);
		$this->email->to("wmsn.web@gmail.com");
		$this->email->from("sales@easeshop.in","easeshop");
		$this->email->subject("Order Status");
		$this->email->message($mesage);
		$dd = $this->email->send(); 
		echo $this->email->print_debugger(); 
	}
}