<?php if (!isset($_SESSION['id'])) {header('Location: /users');}
 	include 'views/inc/messages.php';?>
	<div class="row">
		<div class="col-sm-2">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><a href="/users/user">My page</a></li>
						<li>
							<a href="/friends">Friends 
								 <?php if($this->_userRequestcount > 0) { 
								 	echo '<span style="background:#d9534f; padding:5px 8px; border-radius:100%;color:#fff;">' .$this->_userRequestcount . '</span>'; 
								 } ?>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="col-sm-10">
			<div class="well">
				<div class="row">
					<div class="col-sm-4">
						<img src="../public/uploads/avatar/<?= $this->_userData[0]['avatar']; ?>" class="img-responsive"  width="200px"><br>
						<form action="/users/avatarCtrl" method="POST" enctype="multipart/form-data">
						    <div class="form-group">
						    	<input type="file" name="avatar" class="btn btn-primary">
						    </div>
						    <div class="form-group">
								<?php if($this->_userData[0]['avatar'] != 'avatar.png') : ?>
									<input type="submit" name="editAvatar" class="btn btn-primary" value="Edit Image">
									<input type="submit" name="deleteAvatar" class="btn btn-danger" value="Delete Image">
								<?php else: ?>
									<input type="submit" name="addAvatar" class="btn btn-primary" value="Add Image">
								<?php endif; ?>
							</div>
						</form>
					</div>
					<div class="col-sm-8">
						<div>
							<h3>Name: <?= $this->_userData[0]['f_name'] ." ". $this->_userData[0]['l_name']; ?></h3>
	  						<h3>Email: <?= $this->_userData[0]['email']; ?></h3>
						</div>
	  					<div>
	  						<a href="/posts/add" class="btn btn-primary"> Add Post</a>

	  					</div>
					</div>
				</div>	  			
  			</div>
  			<?php if($this->_userData[0]['iid'] !== null) : ?>
  				<h3>My posts</h3>
	  			<?php foreach($this->_userData as $post): ?>
		      			<div class="well">
		      				<h3><a href="/posts/show/<?= $post['iid']; ?>">Post name: <?= $post['title']; ?></a></h3>
		      				<small>Created at : <?=$post['created_aat'];  ?> </small>
		      			</div>
				<?php endforeach; ?>
			<?php else: ?>
				<h3>No post found</h3>
			<?php endif; ?>
		</div>
	</div>
