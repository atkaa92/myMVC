	<?php if(count($this->_allPosts) > 0): ?>
  		<?php foreach($this->_allPosts as $post): ?>
  			<div class="well">
  				<h3><a href="posts/show/<?= $post['id']; ?>">Post name: <?= $post['title']; ?></a></h3>
  				<small>Created at : <?=$post['created_at'];  ?> </small><br>
  				<small>Created by : <a href="/users/profile/<?= $post['iid']; ?>"><?=$post['email'];  ?></a></small>
  			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<h2>No post found</h2>
	<?php endif; ?>
