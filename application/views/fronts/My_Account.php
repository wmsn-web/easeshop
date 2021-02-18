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
          <div class="col-md-3">
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
          <div class="cardDiv">
            <div class="card">
              <div class="card-title">
                <h4>My Account</h4>
              </div>
                <div class="card-body">
                  <form action="" method="post" id="proForm">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label>Full Name</label>
                        <input type="text" name="fname" class="form-control unicase-form-control text-input" readonly value="<?= $getUser['name']; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label>Mobile Number</label>
                        <input type="text" name="phone" class="form-control unicase-form-control text-input" readonly value="<?= $getUser['phone']; ?>">
                      </div>
                      <div class="form-group col-sm-12">
                        <h5>Shipping Address</h5>
                      </div>
                       <div class="form-group col-md-6">
                        <label>Address</label> <small class="text-danger" id="msg1"></small>
                        <input type="text" name="addr" id="addr" class="form-control unicase-form-control text-input" value="<?= $getUser['shipData']['address']; ?>">
                      </div>
                       <div class="form-group col-md-6">
                        <label>City</label> <small class="text-danger" id="msg2"></small>
                        <input type="text" name="city" id="city" class="form-control unicase-form-control text-input" value="<?= $getUser['shipData']['city']; ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label>State</label> <small class="text-danger" id="msg3"></small>
                        <select name="state" id="state" class="form-control unicase-form-control text-input">
                          <option selected value="<?= $getUser['shipData']['state']; ?>"><?= $getUser['shipData']['state']; ?></option>
                          <option value="Andhra Pradesh">Andhra Pradesh</option>
                          <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                          <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                          <option value="Assam">Assam</option>
                          <option value="Bihar">Bihar</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Chhattisgarh">Chhattisgarh</option>
                          <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                          <option value="Daman and Diu">Daman and Diu</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Lakshadweep">Lakshadweep</option>
                          <option value="Puducherry">Puducherry</option>
                          <option value="Goa">Goa</option>
                          <option value="Gujarat">Gujarat</option>
                          <option value="Haryana">Haryana</option>
                          <option value="Himachal Pradesh">Himachal Pradesh</option>
                          <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                          <option value="Jharkhand">Jharkhand</option>
                          <option value="Karnataka">Karnataka</option>
                          <option value="Kerala">Kerala</option>
                          <option value="Madhya Pradesh">Madhya Pradesh</option>
                          <option value="Maharashtra">Maharashtra</option>
                          <option value="Manipur">Manipur</option>
                          <option value="Meghalaya">Meghalaya</option>
                          <option value="Mizoram">Mizoram</option>
                          <option value="Nagaland">Nagaland</option>
                          <option value="Odisha">Odisha</option>
                          <option value="Punjab">Punjab</option>
                          <option value="Rajasthan">Rajasthan</option>
                          <option value="Sikkim">Sikkim</option>
                          <option value="Tamil Nadu">Tamil Nadu</option>
                          <option value="Telangana">Telangana</option>
                          <option value="Tripura">Tripura</option>
                          <option value="Uttar Pradesh">Uttar Pradesh</option>
                          <option value="Uttarakhand">Uttarakhand</option>
                          <option value="West Bengal">West Bengal</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>PIN</label> <small class="text-danger" id="msg4"></small>
                        <input type="text" name="zip" id="zip" class="form-control unicase-form-control text-input" value="<?= $getUser['shipData']['pin']; ?>">
                      </div>
                      <div class="form-group col-md-12">
                        <label>Land Mark</label>
                        <input type="text" name="lm" id="lm" class="form-control unicase-form-control text-input" value="<?= $getUser['shipData']['landMark']; ?>">
                      </div>
                      <input type="hidden" id="ship_id" name="ship_id" value="<?= $getUser['shipData']['ship_id']; ?>">
                      <input type="hidden" name="ship_id" value="<?= $this->session->userdata('userId'); ?>">
                      <div class="form-group col-md-6">
                        <label>&nbsp;</label>
                        <button type="button" id="proBtn" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
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