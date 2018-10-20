<?php require APPROOT . '/views/pages/includes/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"> Back</i></a>
<h1><?php echo $data['post']->title; ?></h1>
<br/>
<div class="bg-secondary text-white p-2 mb-3">
	Written By <?php  echo $data['user']->name ?> On <?php echo $data['post']->created_at ?>
</div>
<p><?php echo $data['post']->body ?></p>

<?if($data['post']->user_id == $_SESSION['user_id']) :?>
<hr>
<a href="<?php echo URLROOT;?>/posts/edit/<?php echo $data['post']->id ?>" class = "btn btn-dark">Edit</a>
<form action="<?php echo URLROOT ?>/posts/delete/<?php echo $data['post']->id;?>" method="post" class=" pull-right">
	<input type="submit" value="Delete" class="btn btn-danger">


</form>


<?php endif; ?>



<?php require APPROOT . '/views/pages/includes/footer.php'; ?>