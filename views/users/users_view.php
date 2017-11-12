	<?php if(isset($this->_allUsers) && count($this->_allUsers) > 0): ?>
		<h2>All users</h2>
		<div class="well">
			<?php foreach($this->_allUsers as $user): ?>
				<p><a href="/users/profile/<?= $user['id']; ?>"> Email: <?=$user['email'];?></a></p>
		<?php endforeach; ?>
	<?php else: ?>
		<h2>No user found</h2>
	<?php endif; ?>
