<?php require APPROOT . '/views/pages/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"> Back</i></a>
	<div class="card card-body bg-light mt-5">
		<h2>Add Country</h2>
		<form action="<?php echo URLROOT;?>/countries/add" method="post">
			<div class="form-group">

				<label form="title">Country: <sup>*</sup></label>
				<input type="text" name="country" class="form-control form-control-lg <?php echo (!empty($data['country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['country']; ?>"><span class="invalid-feedback"><?php echo $data['country_err']; ?></span>

				<label form="title">Location: <sup>*</sup></label>
				<input type="text" name="location" class="form-control form-control-lg <?php echo (!empty($data['location_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['location']; ?>"><span class="invalid-feedback"><?php echo $data['location_err']; ?></span>

			</div>
			<input type="submit" value="Submit" class="btn btn-success">
		</form>
</div>


<?php require APPROOT . '/views/pages/includes/footer.php'; ?>