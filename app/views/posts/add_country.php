<?php require APPROOT . '/views/pages/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"> Back</i></a>
	<div class="card card-body bg-light mt-5">
		<h2>Add Country</h2>
		<form action="<?php echo URLROOT;?>/posts/add_country" method="post" enctype="multipart/form-data">
			<div class="form-group row" >
				<label for="country">Country: <sup>*</sup></label>
				<select name="select_country">
					<option value="new">Add New</option>
				<?foreach($data['countries'] as $countries){?>
			    	<option value="<?php echo $countries->id ?>"><?php echo $countries->country ?></option>
				<?php } ?>
				</select>
			</div>

			<div class="form-group row">
				<label for="country_input">Enter new country</label>
				<input type="text" name="country_input">
			</div>

			<div class="form-group row">
				<label for="Sub Country">Sub Country</label>
				<select name="select_subcountry">
					<option value="new">Add new</option>
				<?foreach($data['sub_country'] as $sub_country){?>
			    	<option value="<?php echo $countries->id ?>"><?php echo $sub_country->sub_country ?></option>
				<?php } ?>
				</select>
			</div>

			<div class="form-group row">
				<label for="subcountry_input">Enter new sub country</label>
				<input type="text" name="subcountry_input">
			</div>

			<div class="form-group row">
				<div class="col-md-12">
			<input type="submit" value="Submit" class="btn btn-success">
			</div>
			</div>
		</form>
</div>
<?php require APPROOT . '/views/pages/includes/footer.php'; ?>