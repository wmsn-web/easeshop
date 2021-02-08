<?php
/**
 * 
 */
class Category extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->model("ThemeModel");
		$this->load->library("pagination");
	}

	public function index($brand='') 
	{

	}

	public function Items($brand='')
	{
		$config = array();
        $config["base_url"] = base_url() . "Category/Items/".$brand;
        $config["total_rows"] = $this->ThemeModel->get_count_brandPro($brand);
        $config["per_page"] = 10;
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $links = $this->pagination->create_links();
		$getItemByBrand = $this->ThemeModel->getItemByBrand($brand,$config['per_page'],$page);
		
		$splOffer = $this->ThemeModel->splOffer();
		$getMenudata = $this->ThemeModel->getMenudata();
		$this->load->view("fronts/CategoryItemsNew",["menus"=>$getMenudata,"brandItem"=>$getItemByBrand,"links"=>$links,"spalOffer"=>$splOffer]);

		//echo "<pre>";
		//print_r($splOffers);

	}
}