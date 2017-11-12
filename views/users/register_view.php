	<?php include 'views/inc/messages.php';  ?>
	<form action="/users/create" method="POST" >
		<div class="form-group">
	    	<label>Name:</label>
	    	<input type="text" name="f_name" class="form-control" 
	    			value="<?php if (!empty($_POST['f_name'])) {echo $_POST['f_name'];} echo ""; ?>">
	    </div>
	    <div class="form-group">
	    	<label>Surame:</label>
	    	<input type="text" name="l_name" class="form-control" 
	    			value="<?php if (!empty($_POST['l_name'])) {echo $_POST['l_name'];} echo ""; ?>">
	    </div>
	    <div class="form-group">
	    	<label>Email:</label>
	    	<input type="text" name="email" class="form-control"
	    		value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} echo ""; ?>">
	    </div>
	    <div class="form-group">
	    	<label>Password:</label>
	    	<input type="password" name="password" class="form-control">
	    </div>
	    <div class="form-group">
	    	<label>Confirm Password:</label>
	    	<input type="password" name="conf_password" class="form-control">
	    </div>
	    <div class="form-group">
			<input type="submit" name="register" class="btn btn-primary">
		</div>
	</form>
