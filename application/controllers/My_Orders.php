<?php
/**
 * 
 */
class My_Orders extends CI_controller
{
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("userId"))
		{
			return redirect("Login");
		}
	}

	public function index()
	{
		$splOffer = $this->ThemeModel->splOffer();
		$getMenudata = $this->ThemeModel->getMenudata();
		$user_id = $this->session->userdata("userId");
  		$getUser = $this->ThemeModel->getUserDetails($user_id);
  		$getMyOrders = $this->ThemeModel->getMyOrders($user_id);
		$this->load->view("fronts/My_Orders",["menus"=>$getMenudata,"spalOffer"=>$splOffer,"getUser"=>$getUser,"ordData"=>$getMyOrders]);
		//echo "<pre>";
		//print_r($getMyOrders);
	}

	public function orderById()
	{
		$id = $this->input->post("id");
		$getOrdById = $this->ThemeModel->getOrdById($id);
		$ordd = $getOrdById;
		if(!empty($getOrdById['cartData']))
		{
			echo '<div class="row">
                  <div class="col-md-12">
                    <div class="ordTlb">
                    <div class="table-responsive">';
			echo '<table class="tbl tbl-brd">
                      <tr>
                      	<th>Image</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                      </tr>';
			foreach($getOrdById['cartData'] as $crts)
			{
				echo '<tr>
                        <td><img src="'.base_url('uploads/products/'.$crts['mnImg']).'" width="45"></td>
                        <td>'.$crts["product_name"].'</td>
                        <td>'.$crts["qty"].'</td>
                        <td>&#8377; '.number_format($crts["price"],2).'</td>
                      </tr>';


			}
			 echo '<tr>
                        <td class="nobrd"></td>
                        <td class="nobrd"></td>
                        <td>Tax('.$ordd['tax'].'%)</td>
                        <td>'.number_format($ordd['txAmt'],2).'</td>
                      </tr>
                      <tr>
                        <td class="nobrd"></td>
                        <td class="nobrd"></td>
                        <td><b>Total</b></td>
                        <td>'.number_format($ordd['total'],2).'</td>
                      </tr>';

			echo '</table>';
			echo '</div> </div>
                </div>
                  <div class="col-md-12">
                    <div class="ordStatus">
                      <ol class="progtrckr" data-progtrckr-steps="3">
                          <li class="'.$ordd['pross'].'">Processing</li>
                          <li class="'.$ordd['disp'].'">Dispatch</li>
                          <li class="'.$ordd['delvr'].'">Delivared</li>
                      </ol>
                    </div>
                  </div>';
		}
	}
}