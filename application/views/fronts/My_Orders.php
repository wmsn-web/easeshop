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
                      <li><a class="active" href="<?= base_url('My-Account'); ?>">My Account</a></li>
                      <li><a href="<?= base_url('My-Orders'); ?>">My Orders</a></li>
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
                  <table class="ordTable">
                    <tr>
                      <th>Date</th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Status</th>
                    </tr>
                    <tr data-toggle="modal" onclick="getOrdSts()" data-target="#orderStatus" class="cp">
                      <td>20-02-2021</td>
                      <td class="text-primary">Samsung Galaxy 3 Smart phone With 6GB Ram, And more extra features</td>
                      <td>&#8377; 56999.00</td>
                       <td><span class="badge badge-warning">Cancelled</span></td>
                    </tr>
                    <tr>
                      <td>20-02-2021</td>
                      <td>Samsung Galaxy 3 Smart phone With 6GB Ram, And more extra features >Processing</span></td>
                      <td>&#8377; 56999.00</td>
                      <td><span class="badge badge-success">Cancelled</span></td>
                    </tr>
                    <tr>
                      <td>20-02-2021</td>
                      <td>Samsung Galaxy 3 Smart phone With 6GB Ram, And more extra features </td>
                      <td>&#8377; 56999.00</td>
                      <td><span class="badge badge-danger">Cancelled</span></td>
                    </tr>
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
<div class="modal fade" id="orderStatus" role="dialog">
          <div class="modal-dialog modal-lg">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Order Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
              </div>
              <div class="modal-body">
                <div class="row">
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
<?php include("inc/bottomMenu.php"); ?>
<div id="mob-view">
  <?php include("inc/footer.php"); ?>
</div>

<?php include("inc/js.php"); ?>
<?php include("inc/searchjs.php"); ?>
<script type="text/javascript">
  $("#proBtn").click(function(){
      addr = $("#addr").val();
      city = $("#city").val();
      state = $("#state").val();
      zip = $("#zip").val();
      lm = $("#lm").val();
      ship_id = $("#ship_id").val();
      user_id = "<?= $this->session->userdata('userId'); ?>";
      if(addr == ""){$("#addr").addClass("inpDanger").focus(); $("#msg1").html("Please Enter your address");}
      else if(city == ""){$("#addr").removeClass("inpDanger"); $("#msg1").html("");$("#city").addClass("inpDanger").focus(); $("#msg2").html("Please Enter your City Name");}
      else if(state == ""){$("#city").removeClass("inpDanger"); $("#msg2").html("");$("#state").addClass("inpDanger").focus(); $("#msg3").html("Please Enter your State Name");}
      else if(zip == ""){$("#state").removeClass("inpDanger"); $("#msg3").html("");$("#zip").addClass("inpDanger").focus(); $("#msg4").html("Please Enter your PIN/ZIP");}
      else
      {
        $("#addr").removeClass("inpDanger"); $("#msg1").html("");
        $("#city").removeClass("inpDanger"); $("#msg2").html("");
        $("#state").removeClass("inpDanger"); $("#msg3").html("");
        $("#zip").removeClass("inpDanger"); $("#msg4").html("");
        //Insert into database
        $.post("<?= base_url('My-Cart/UpdateShipAddr'); ?>",{
          addr: addr,
          city: city,
          state: state,
          zip: zip,
          lm: lm,
          user_id: user_id,
          ship_id: ship_id
        },function(resp){
          if(resp == "done")
          {
            location.href="<?= base_url('My-Account'); ?>";
          }
          else
          {
            return false;
          }
        })
      }
    });
</script>
</body>

</html>