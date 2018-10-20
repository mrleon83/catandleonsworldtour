<?php require APPROOT . '/views/pages/includes/header.php'; ?>
<?php flashMessage('post_message'); ?>
<div class="row mb-3">
	<div class="col-md-12">
		<h1>Posts</h1>
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
	</div> 
<?php endforeach; ?>

<?php require APPROOT . '/views/pages/includes/footer.php'; ?>
