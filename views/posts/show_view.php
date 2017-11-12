	<?php if(isset($this->_curPost)): ?>
		<div class="well">
  			<h3>Post name: <?= $this->_curPost[0]['title']; ?></h3>
				<div class="well">
  			<p><b>Post body: <?=$this->_curPost[0]['body'];  ?></b></p>
  			</div>
  			<small>Created at : <?=$this->_curPost[0]['created_at'];  ?></small><br>
  			<small>Created by : <a href="/users/profile/<?= $this->_curPost[0]['iid']; ?>"> <?=$this->_curPost[0]['email'];  ?> </a></small><hr>
  			<?php if(isset($_SESSION['id']) && $_SESSION['id'] === $this->_curPost[0]['user_id']): ?>
  				<a href="/posts/edit/<?= $this->_curPost[0]['id']; ?>" class="btn btn-primary">Edit</a>
  				<a href="/posts/delete/<?= $this->_curPost[0]['id']; ?>" class="btn btn-danger">Delete</a>
  			<?php endif; ?>
			</div>
	<?php endif; ?>
