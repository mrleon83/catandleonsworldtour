<?php require APPROOT . '/views/pages/includes/header.php'; ?>
<?php flashMessage('post_message'); ?>
<div class="row mb-3">
	<div class="col-md-6">
		<h1>Admin</h1>
	</div>
	<div class="col-md-2">		
		<a href="<?php echo URLROOT;?>/posts/add_dates" class="btn btn-primary">
			<i class="fa fa-pencil"></i> Add Dates
		</a>
	</div>
	<div class="col-md-2">
		<a href="<?php echo URLROOT;?>/posts/add_country" class="btn btn-primary">
			<i class="fa fa-pencil"></i> Add Country
		</a>
	</div>
	<div class="col-md-2">
		<a href="<?php echo URLROOT;?>/posts/add" class="btn btn-primary pull-right">
			<i class="fa fa-pencil"></i> Add Post
		</a>
	</div>
</div>

<?php foreach($data['posts'] as $post) : ?>
	<div class="card card-body mb-3">
		<h4 class="card-title">
			<?php echo $post->title ?>
		</h4>
		<div class="bg-light p-2 mb-3">
			Written By <?php echo $post->name ?> on <?php echo $post->created ?>
		</div>
		<p class="card-text"><?php echo $post->body ?></p>
		<p cass="card-text"><img src="app/<?php echo $post->file_location;?>" width="50%"></p>
		<a href=" <?php URLROOT;?>posts/show/<?php echo $post->postid ?>" class="btn btn-dark">More</a>
	</div>

<?php endforeach; ?>

<?php require APPROOT . '/views/pages/includes/footer.php'; ?>

