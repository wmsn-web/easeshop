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
    $getSet =  $this->ThemeModel->getSettings();
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
                        <th>Price</th>';
                        if($ordd['status']=="Delivered" && $ordd['exp']=="no"):
                          echo '<th>Return</th>';
                        endif;
                        
                     echo '</tr>';
			foreach($getOrdById['cartData'] as $crts)
			{
				echo '<tr>
                        <td><img src="'.base_url('uploads/products/'.$crts['mnImg']).'" width="45"></td>
                        <td>'.$crts["product_name"];
                        if(!empty($crts["returns"])): 
                         echo ' <span class="badge badge-danger">Return '.$crts["returns"].'</span>';
                       endif;
                         echo '</td>
                        <td>'.$crts["qty"].'</td>
                        <td>&#8377; '.number_format($crts["price"],2).'</td>';
                        if($crts['status']=="Delivered" && $ordd['exp']=="no" && empty($crts["returns"])):
                        if($crts['returnable']=="yes")
                  {
                    echo '<td><button data-toggle="modal" onclick="rqsupportData(\''.$id.'_'.$crts["cart_id"].'_'.$crts["qty"].'\')"  data-target="#ReturnReq" class="btn btns-warn">Return Product</button></td>';
                  }
                  else
                  {
                    echo '<td><span class="badge badge-danger">Non-Returnable Product</span></td>';
                  }
                  else: echo '<td></td>';
                endif;
                     echo  '</tr>';
                  


			}
      if(!$ordd['tax']=="0"):
			 echo '<tr>
                        <td class="nobrd"></td>
                        <td class="nobrd"></td>
                        <td>Tax('.$ordd['tax'].'%)</td>
                        <td>'.number_format($ordd['txAmt'],2).'</td>
                      </tr>';
      endif;

       echo               '<tr>
                        <td class="nobrd"></td>
                        <td class="nobrd"></td>
                        <td><b>Total</b></td>
                        <td>'.number_format($ordd['total'],2).'</td>
                      </tr>';

			echo '</table>';
			echo '</div> </div>
                </div>
                  <div class="col-md-12">
                    <div class="ordStatus">';
                    if($ordd['status']=="Cancel"):
                      echo '<h3 style="color:#f00">Order Cancelled by Us</h3>';
                      echo '<p>Paid amount will be refund your bank account within 5days</p>';
                    else:
                      echo '<ol class="progtrckr" data-progtrckr-steps="3">
                                <li class="'.$ordd['pross'].'">Processing</li>
                                <li class="'.$ordd['disp'].'">Dispatch</li>
                                <li class="'.$ordd['delvr'].'">Delivared</li>
                            </ol>
                          </div>
                        </div>';
                    endif;

      
		}
	}

  public function returnRequest()
  {
    $user_id = $this->input->post("user_id");
    $crtId = $this->input->post("crtId");
    $ordId = $this->input->post("ordId");
    $qty = $this->input->post("qty");
    $rq = htmlentities($this->input->post("rq"));
    $notes = $this->input->post("notes");
    $fNote = $notes."_".$rq;
    date_default_timezone_set('Asia/Kolkata');
    $chkData = array
                    (
                      "user_id" =>$user_id,
                      "cart_id" =>$crtId,
                      "order_id"=>$ordId
                    );
    $Data = array
                    (
                      "user_id" =>$user_id,
                      "cart_id" =>$crtId,
                      "qty"     =>$qty,
                      "notes"   =>$fNote,
                      "request_date"  =>date('Y-m-d'),
                      "order_id"=>$ordId,
                      "status"  =>0
                    );
    $this->db->where($chkData);
    $gt = $this->db->get("order_return")->num_rows();
    if($gt > 0)
    {
        $this->session->set_flashdata("Feed","Request Already Exist!");
        return redirect("My-Orders");
    }
    else
    {
      $this->db->where("cart_id",$crtId);
      $this->db->update("cart",["returns"=>"Requested"]);
      $this->db->insert("order_return",$Data);
      $this->session->set_flashdata("Feed","Request Submitted successfully");
        return redirect("My-Orders");
    }
  }
}