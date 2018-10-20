<?php require APPROOT . '/views/pages/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"> Back</i></a>
	<div class="card card-body bg-light mt-5">
		<h2>Add Blog Post</h2>
		<p>Create a blog post</p>
		<form action="<?php echo URLROOT;?>/posts/add" method="post">
			<div class="form-group">

				<label form="title">Title: <sup>*</sup></label>
				<input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>"><span class="invalid-feedback"><?php echo $data['title_err']; ?></span>

				<label form="body">Body: <sup>*</sup></label>
				<textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : '';?>"><?php echo $data['body']; ?>
				</textarea>
					<span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
			</div>
			<input type="submit" value="Submit" class="btn btn-success">
		</form>
</div>


<?php require APPROOT . '/views/pages/includes/footer.php'; ?>