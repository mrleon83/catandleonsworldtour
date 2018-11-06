<?php require APPROOT . '/views/pages/includes/header.php'; 
include('adminheader.php');
?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"> Back</i></a>
	<div class="card card-body bg-light mt-5">
		<h2>Add Blog Post</h2>
		<p>Create a blog post</p>
		<form action="<?php echo URLROOT;?>/posts/add" method="post" enctype="multipart/form-data">
			<div class="form-group row" >

				<label for="title">Title: <sup>*</sup></label>
				<input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>"><span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
			</div>

			<div class="form-group row">			
				<label for="body">Body: <sup>*</sup></label>
				<textarea name="body"  style="height: 400px;" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : '';?>"><?php echo $data['body']; ?>
				</textarea>
					<span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
			</div>

			<div class="form-group row">
			  <label for="country">Country</label>
			  <select class="form-control  form-control-lg" id="country" name="country">
			    <option value=''>Country</option>
			    <?foreach($data['countries'] as $countries){?>
			    	<option value="<?php echo $countries->id ?>"><?php echo $countries->country ?></option>
				<?php } ?>
			  </select>
			</div>

			<div class="form-group row">
			  <label for="country">Country Location</label>
			  <select class="form-control  form-control-lg" id="sub_country" name="sub_country">
			    <option value=''>Country Location</option>
			    <?foreach($data['sub_countries'] as $sub_countries){?>
			    	<option value="<?php echo $sub_countries->id ?>"><?php echo $sub_countries->sub_country ?></option>
				<?php } ?>
			  </select>
			</div>

			<div class="form-group row">
				<label for="file_upload">Image: <sup>*</sup></label>
				<input type="file" name="file_upload" class="form-control form-control-lg">
			</div>

			<div class="form-group row"">
		          <label for="privacy">Privacy</label>
		          <select class="form-control form-control-lg" id="privacy" name="privacy">
		          	<option value='0'>Public</option>
		          	<option value="1">Private</option>
		          </select>
		        </div>


			<div class="form-group row">
				<div class="col-md-12">
			<input type="submit" value="Submit" class="btn btn-success">
			</div>
			</div>
		</form>
</div>
<?php require APPROOT . '/views/pages/includes/footer.php'; ?>

