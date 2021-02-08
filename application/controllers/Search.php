<?php
/**
 * 
 */
class Search extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model("ThemeModel");
		$this->load->library("pagination");
	}

	public function posts()
	{
		$keys = $_POST['keys'];
		$return = base_url() . "Search/Result/".$keys;
		return redirect($return);
	}

	public function Result() 
	{
       $keys = $this->uri->segment(3);
       $config = array();
        $config["base_url"] = base_url() . "Search/Result/".$keys;
        $config["total_rows"] = $this->ThemeModel->get_count_searchPro($keys);
        $config["per_page"] = 2;
        $config["uri_segment"] = 4;
        $config['num_tag_open'] = '<li><a href="javascript:void(0);">'; 
		$config['num_tag_close'] = '</a></li>'; 
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">'; 
		$config['cur_tag_close'] = '</a></li>'; 
		$config['next_link'] = '<li class="next"><a href="javascript:void(0);"><i class="fa fa-angle-right"></i>'; 
		$config['prev_link'] = '<li class="prev"><a href="javascript:void(0);"><i class="fa fa-angle-left"></i>'; 
		$config['next_tag_open'] = '<li class=""><a href="javascript:void(0);">'; 
		$config['next_tag_close'] = '</a></li>'; 
		$config['prev_tag_open'] = '<li class=""><a href="javascript:void(0);">'; 
		$config['prev_tag_close'] = '</a></li>'; 
		$config['first_tag_open'] = '<li><a href="javascript:void(0);">'; 
		$config['first_tag_close'] = '</a></li>'; 
		$config['last_tag_open'] = '<li><a href="javascript:void(0);">'; 
		$config['last_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		$links = $this->pagination->create_links();
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
       $gtResult = $this->ThemeModel->getSearchKeys($keys,$config['per_page'],$page);
       //echo "<pre>";
       //print_r($this->ThemeModel->get_count_searchPro($keys));
       //print_r($this->uri->segment(5));
       $splOffer = $this->ThemeModel->splOffer();
		$getMenudata = $this->ThemeModel->getMenudata();
		$this->load->view("fronts/CategoryItemsNew",["menus"=>$getMenudata,"brandItem"=>$gtResult,"links"=>$links,"spalOffer"=>$splOffer]);
	}

	function highlight($text, $words) {
	    preg_match_all('~\w+~', $words, $m);
	    if(!$m)
	        return $text;
	    $re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
	    return preg_replace($re, '<b>$0</b>', $text);
	}
}