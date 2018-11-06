<?php require APPROOT . '/views/pages/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"> Back</i></a>
	<div class="card card-body bg-light mt-5">
		<h2>Add Dates</h2>
		<form action="<?php echo URLROOT;?>/posts/add_dates" method="post" enctype="multipart/form-data">
			<div class="form-group row" >
				<label for="country">Country: <sup>*</sup></label>
				<select name="select_country">
					<option value="new">Select</option>
				<?foreach($data['countries'] as $countries){?>
			    	<option value="<?php echo $countries->id ?>"><?php echo $countries->country ?></option>
				<?php } ?>
				</select>
			</div>

			<div class="form-group row">
				<label for="Sub Country">Sub Country</label>
				<select name="select_subcountry">
					<option value="new">Select</option>
				<?foreach($data['sub_country'] as $sub_country){?>
			    	<option value="<?php echo $countries->id ?>"><?php echo $sub_country->sub_country ?></option>
				<?php } ?>
				</select>
			</div>

			<div class="form-group row">
				<label for="datefrom">Date From</label>
				<input type="date" name="datefrom">
			</div>

			<div class="form-group row">
				<label for="dateto">Date Left</label>
				<input type="date" name="dateto">
			</div>

			<div class="form-group row">
				<div class="col-md-12">
			<input type="submit" value="Submit" class="btn btn-success">
			</div>
			</div>
		</form>
</div>
<?php require APPROOT . '/views/pages/includes/footer.php'; ?>