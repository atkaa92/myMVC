<?php if(!isset($_SESSION['id'])){{header('Location: /posts');}}
	  include 'views/inc/messages.php';?>
	<form action="/posts/create" method="POST">
		<div class="form-group">
	    	<label>Title:</label>
	    	<input type="text" name="title" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>Body:</label>
	    	<input type="text" name="body" class="form-control" >
	    </div>
	    <div class="form-group">
			<input type="submit" name="add_post" class="btn btn-primary">
		</div>
	</form>
