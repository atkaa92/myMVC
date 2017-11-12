	<?php if(count($this->_profileData) < 1){{header('Location: /users');}} 
	?>
	<div class="well">
		<div class="row">
			<div class="col-sm-3">
				<img src="../../public/uploads/avatar/<?= $this->_profileData[0]['avatar']; ?>" class="img-responsive" width="200px">
			</div>
			<div  class="col-sm-5">
				<h3>Name: <?= $this->_profileData[0]['f_name']." ".$this->_profileData[0]['l_name']; ?></h3>
				<h3>Email: <?= $this->_profileData[0]['email']; ?></h3>
			</div>
			<?php if (isset($_SESSION['id'])): ?>
				<div  class="col-sm-2">
					<a href="/users/messages/<?= $this->_profileData[0]['id'];?>" type="button" class="btn btn-default" id="sentMessage">Sent Message</a>
				</div>
			<?php endif ; ?>
		</div>
	</div>
	<?php if($this->_profileData[0]['iid'] !== null) : ?>
		<?php foreach($this->_profileData as $post): ?>
  			<div class="well">
  				<h3><a href="/posts/show/<?= $post['iid']; ?>">Post name: <?= $post['title']; ?></a></h3>
  				<small>Created at : <?=$post['created_aat'];  ?> </small>
  				</div>
		<?php endforeach; ?>
	<?php else: ?>
		<h3>No post found</h3>
	<?php endif; ?>
	<?php if(isset($_SESSION['id']) && empty($this->_sentFriendStatus) && empty($this->_getFriendStatus)): ?>
		<a href="/friends/friend/<?= $this->_profileData[0]['id']; ?>" class="btn btn-primary">Add to friendlist</a>
	<?php elseif(isset($_SESSION['id']) && !empty($this->_sentFriendStatus) && $this->_sentFriendStatus[0]['status'] == 0): ?>
		<h3>Request already sent !!!</h3>
	<?php elseif(isset($_SESSION['id']) && !empty($this->_getFriendStatus) && $this->_getFriendStatus[0]['status'] == 0): ?>
		<h3>You have friend request from this user !!!</h3>
		<p><a href="/friends/accept/<?= $this->_getFriendStatus[0]['id']; ?>" class="btn btn-primary">Accept friend request</a></p>
		<p><a href="/friends/unfriend/<?= $this->_getFriendStatus[0]['id']; ?>" class="btn btn-danger">Decline friend request</a></p>
	<?php elseif(isset($_SESSION['id']) && !empty($this->_sentFriendStatus) && $this->_sentFriendStatus[0]['status'] == 1): ?>
		<h3>User already in your friend list !!!</h3>
		<p><a href="/friends/unfriend/<?= $this->_sentFriendStatus[0]['id']; ?>" class="btn btn-danger">Delete form friendlist</a></p>
	<?php elseif(isset($_SESSION['id']) &&  !empty($this->_getFriendStatus) && $this->_getFriendStatus[0]['status'] == 1): ?>
		<h3>User already in your friend list !!!</h3>
		<p><a href="/friends/unfriend/<?= $this->_getFriendStatus[0]['id']; ?>" class="btn btn-danger">Delete form friendlist</a></p>
	<?php endif; ?>
