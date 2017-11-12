<?php include 'views/inc/messages.php';  ?>
	<form action="/users/doLogin" method="POST">
	    <div class="form-group">
	    	<label>Email:</label>
	    	<input type="text" name="email" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>Password:</label>
	    	<input type="password" name="password" class="form-control">
	    </div>
	    <div class="form-group">
			<input type="submit" name="login" class="btn btn-primary">
		</div>
	</form>
