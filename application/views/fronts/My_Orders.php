<!DOCTYPE html>
<html lang="en"> 

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>Easeshop-MyAccount</title>
<?php include("inc/layout.php"); ?>
<link rel="stylesheet"  type='text/css' href="<?= base_url('assets/css/customnewx.css'); ?>">
<style type="text/css">
  @media only screen and (max-width: 991px) 
{
  #mob-view
  {
    display: none !important;
  }
}
</style>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
 
  <div id="mob-view">
    <?php include("inc/header_top.php"); ?>
  
  <!-- /.header-top --> 
  <!-- ============================================== TOP MENU : END ============================================== -->
  <?php include("inc/main_header.php"); ?>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
  <?php include("inc/menuNew.php"); ?>
  <!-- /.header-nav --> 
  <!-- ============================================== NAVBAR : END ============================================== --> 
  </div>


  <div class="mob-header">
    <?php include("inc/mobheadermenu.php"); ?>
  </div>
  <div class="mobSpace">
    <div class="search-area">
    <form action="<?= base_url('Search/posts'); ?>" method="post">
      <div class="control-group">
        <input name="keys" class="search-field" id="keywords2" placeholder="Search here..." autocomplete="off" />
        <button class="search-button" ></button> </div>
        
    </form>
  </div>
</div>
  <div id="results2">
    <ul id="resContent2"></ul>
  </div>
</header>
<div class="body-content outer-top-vs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row justify-content-center">
          <div class="col-md3">
            <div class="deskSide">
              <div class="card">
                <div class="card-title">
                  <h4>My Account</h4>
                </div>
                  <div class="card-body">
                    <ul  class="deskSidemenu">
                      <li><a href="<?= base_url('My-Account'); ?>">My Account</a></li>
                      <li><a class="active" href="<?= base_url('My-Orders'); ?>">My Orders</a></li>
                       <li><a href="<?= base_url('My-wishlist'); ?>">My Wishlist</a></li>
                      <li><a href="<?= base_url('Change-Password'); ?>">Change Password</a></li>
                      <li><a href="<?= base_url('Logout'); ?>">Logout</a></li>
                    </ul>
                  </div>
              </div>
            </div>
          </div>
          <div class="cardDiv2">
            <div class="card">
              <div class="card-title">
                <h4>My Orders</h4>
              </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="ordTable">
                      <?php if(!empty($ordData)): ?>
                        <tr>
                          <th>Date</th>
                          <th>Order ID</th>
                          <th>Price</th>
                          <th>Status</th>
                        </tr>
                        <?php foreach($ordData as $ord): ?>
                          <tr data-toggle="modal" onclick="getOrdSts('ids_<?= $ord['id']; ?>')" data-target="#orderStatus" class="cp">
                            <td><?= $ord['date']; ?></td>
                            <td class="text-primary">#<?= $ord['order_id']; ?></td>
                            <td>&#8377; <?= $ord['price']; ?></td>
                             <td><span class="badge <?= $ord['bgCol']; ?>"><?= $ord['status']; ?></span></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr class="text-center">No Order Found!</tr>
                      <?php endif; ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="orderStatus" role="dialog">
          <div class="modal-dialog modal-lg">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Order Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body  ordTlbs">
                <div class="row">
                  <div class="col-md-12">
                   
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal fade" id="ReturnReq" role="dialog">
          <div class="modal-dialog modal-md">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Return Request</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <h5>Reason for Return</h5>
                    <form id="rq" action="<?= base_url('My-Orders/returnRequest'); ?>" method="post">
                      <p id="msg" class="text-danger"></p>
                    <div class="form-group">
                      <input type="radio" required name="notes" value="Delivered wrong Product"> <label>Delivered wrong Product.</label>
                    </div>
                    <div class="form-group">
                      <input type="radio" required name="notes" value="Defective parts or Product"> <label>Defective parts or Product.</label>
                    </div>
                    <div class="form-group">
                      <input type="radio" required name="notes" value="Product or parts missing"> <label>Product or parts missing.</label>
                    </div>
                    <div class="form-group">
                      <textarea id="rp" required name="rq" placeholder="Why are you return this product?" class="form-control"></textarea>
                      <input type="hidden" name="user_id" value="<?= $this->session->userdata('userId'); ?>">
                      <input type="hidden" name="crtId" id="crt">
                      <input type="hidden" name="ordId" id="ord">
                      <input type="hidden" name="qty" id="qty">
                    </div>
                    <div class="form-group">
                      <button type="button" id="subb" class="btn btn-primary">Request Return</button>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
      </div>
       <?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="toastMsg">
      <div class="Msgs"><?= $feed; ?></div>
    </div>
  <?php endif; ?>
<?php include("inc/bottomMenu.php"); ?>
<div id="mob-view">
  <?php include("inc/footer.php"); ?>
</div>

<?php include("inc/js.php"); ?>
<?php include("inc/searchjs.php"); ?>
<script type="text/javascript">
  $(".toastMsg").fadeOut(6000);
  function getOrdSts(ids)
  {
    var spl = ids.split("_");
    var id = spl[1];
    $.post("<?= base_url('My-Orders/orderById'); ?>",{
      id: id
    },function(data){
      $(".ordTlbs").html(data);
    })

  }
$("#subb").click(function(){
  if($("input[name='notes']").is(":checked"))
  {
    var inpVal = $("input[name='notes']:checked").val();
    $("#msg").html("");
    var rp = $("#rp").val();
    if(!rp.trim())
    {
      $("#msg").html("Please Select Reason");
    }
    else
    {
      $("#msg").html("");
      $("#rq").submit();

    }
  }
  else
  {
    $("#msg").html("Please Select Reason");
  }
  
});
function rqsupportData(nameId)
{
  spl = nameId.split("_");
  $("#ord").val(spl[0]);
  $("#crt").val(spl[1]);
  $("#qty").val(spl[2]);
}
</script>
</body>

</html>