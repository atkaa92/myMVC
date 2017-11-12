<?php if(isset($this->_serachedUsers) && count($this->_serachedUsers) > 0): ?>
	<h2>All users</h2>
	<div class="well">
		<?php foreach($this->_serachedUsers as $user): ?>
			<p><a href="/users/profile/<?= $user['id']; ?>"> Name: <?=$user['f_name'];?></a></p>
	<?php endforeach; ?>
<?php else: ?>
	<h2>No user found</h2>
<?php endif; ?>