<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/form_layout.php"); ?>
		<title>Slider Banner - Admin Panel</title>
	</head>
	<body class="main-body app sidebar-mini dark-theme">
		<div id="global-loader" class="light-loader">
			<img src="<?= base_url(); ?>admin_assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
		</div>
		<?php include("inc/sidemenu.php"); ?>
		<div class="main-content app-content">
			<?php include("inc/header.php"); ?>
			<div class="container-fluid">

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Slider Banner</h4>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Upload Banner</h3>
							</div>
							<div class="card-body">
								<?= form_open_multipart('admin_panel/SliderBanner/uploadBanner'); ?>
							<div class="form-group">
								<label>Slider Title</label>
								<input type="text" name="title" class="form-control" value=""  />
							</div>
							<div class="form-group">
								<label>Slider Text</label>
								<input type="text" name="sl_text" class="form-control" value=""  />
							</div>
							<div class="form-group">
								<label>Select an Image</label>
								<input type="file" name="main_img" class="dropify"  data-height="100" required=""  />
							</div>
							
							<!--div class="form-group">
								<label>Select Category</label>
								<select type="text" name="cat_id" class="form-control" placeholder="" required="">
									<option selected value="">Select Category</option>
									<?php if(!empty($catData)): ?>
										<?php foreach($catData as $cat): ?>
											<option value="<?= $cat['catId']; ?>"><?= $cat['cat_name']; ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div-->
							<input type="hidden" name="cat_id" value="1">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control">
									<option  value="Show">Show</option>
									<option  value="Hide">Hide</option>
								</select>
							</div>
							<button class="btn btn-primary">Update</button>
						</form>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="card  scrolTbody">
							<div class="card-header">
								<h3 class="card-title">All Banners</h3>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Image</th>
											<th>Title</th>
											<th>Text</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data as $key):
											if($this->uri->segment(5)==$key['id'])
											{
												$style = "style='opacity:0.25'";
											}
											else
											{
												$style = "style='opacity:1'";
											}
										 ?>
											<tr <?= $style; ?>>
												<td><img src="<?= base_url('uploads/banners/'.$key['imgg']); ?>" width="100"></td>
												<td><?= $key['title']; ?></td>
												<td><?= $key['sl_text']; ?></td>
												<td>
													<a href="<?= base_url('admin_panel/SliderBanner/index/editBanner/'.$key['id']); ?>">Update</a><?= nbs(5); ?>
													<a onclick="return confirm('Delete this Banner?');" href="<?= base_url('admin_panel/SliderBanner/DelBanner/'.$key['id']); ?>" class="text-danger">Delete</a></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<!-- row closed -->
				<?php if($feed = $this->session->flashdata("Feed")){ ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php } ?>
			</div>
			
				<div class="modal fade" id="edtModal" role="dialog">
			    <div class="modal-dialog modal-md">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-header">
			          <h4 class="modal-title">Edit Banner</h4>
			          <button onclick="location.href='<?= base_url('admin_panel/SliderBanner'); ?>'" type="button" class="close">&times;</button>
			          
			        </div>
			        <div class="modal-body">
			        	<?= form_open_multipart('admin_panel/SliderBanner/EdituploadBanner'); ?>
							<div class="form-group">
								<label>Banner Title</label>
								<input type="text" name="title" class="form-control" value="<?= $banData['title']; ?>" required="" />
							</div>
							<div class="form-group">
								<label>Slider Text</label>
								<input type="text" name="sl_text" class="form-control" value="<?= $banData['sl_text']; ?>"  />
							</div>
							<div class="form-group">
								<label>Select an Image</label>
								<input type="file" name="main_img" class="dropify"  data-height="100" data-default-file='<?= base_url('uploads/banners/'.$banData['imgg']); ?>' />
							</div>
							<input type="hidden" name="cat_id" value="1">
							<!--div class="form-group">
								<label>Select Category</label>
								<select type="text" name="cat_id" class="form-control" placeholder="" required="">
									<option  value="">Select Category</option>
									<?php if(!empty($catData)): ?>
										<?php foreach($catData as $cat):
											if($cat['catId']==$banData['cat_id'])
											{
												$selected = "selected";
											}
											else
											{
												$selected = "";
											}
										 ?>
											<option <?= $selected; ?> value="<?= $cat['catId']; ?>"><?= $cat['cat_name']; ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div-->
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control">
									
									<option  value="Show">Show</option>
									<option  value="Hide">Hide</option>
								</select>
							</div>
							<input type="hidden" name="id" value="<?= $this->uri->segment(5); ?>">
							<button class="btn btn-primary">Update</button>
						</form>
			        </div>
			        
			      </div>
			      
			    </div>
			  </div>

			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/form_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".flashd").fadeOut(5000);
				
			});
		</script>
		<?php
				if($this->uri->segment(4)=="editBanner"): ?>
					<script type="text/javascript">
						$("#edtModal").modal('show');
					</script>
					
				<?php endif; ?>
	</body>
</html>