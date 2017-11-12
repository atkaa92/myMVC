<?php if(!isset($_SESSION['id']) || $_SESSION['id'] !== $this->_editPost[0]['user_id']){
	{header('Location: /posts');}} ;
	include 'views/inc/messages.php';?>
	<?php if(isset($error)): ?>
		<div class="alert alert-danger">
		  <strong>Danger!</strong> <?= $error;?>
		</div>
	<?php endif; ?>
		<a href="/posts/show/<?= $this->_editPost[0]['id']; ?>" class="btn btn-default">Back to Post</a><hr>
	<form action="/posts/update/<?= $this->_editPost[0]['id'];; ?>" method="POST">
		<div class="form-group">
	    	<label for="usr">Title:</label>
	    	<input type="text" name="title" class="form-control" value="<?= $this->_editPost[0]['title']; ?>">
	    </div>
	    <div class="form-group">
	    	<label for="pwd">Body:</label>
	    	<input type="text" name="body" class="form-control" value="<?= $this->_editPost[0]['body']; ?>">
	    </div>
	    <div class="form-group">
			<input type="submit" name="edit_post" class="btn btn-primary">
		</div>
	</form>
