	<div class="row">
		<div class="col-sm-2">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><a href="/users/user">My page</a></li>
						<li><a href="/friends">Friends</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="col-sm-10">
  			<?php  if($extraData): ?>
  				<div class="well">
	  				<h3>You have <?= count($extraData); ?> requests</h3><hr>
		  			<?php foreach($extraData as $key => $req): ?>
		  				<div class="row">
			  				<div class="col-sm-4">
								<p><a href="/users/profile/<?= $req['iid']; ?>"><img src="../../public/uploads/avatar/<?= $req['avatar']; ?>" class="img-responsive" width="100px"><?= $req['email']  ?></a></p>
							</div>
							<div class="col-sm-8">
								<p><a href="/friends/accept/<?= $req['id']; ?>" class="btn btn-primary">Accept friend request</a></p>
								<p><a href="/friends/unfriend/<?= $req['id']; ?>" class="btn btn-danger">Decline friend request</a></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<div class="well">
	  			<?php  if($data): ?>
	  				<h3>Your friendlist</h3>
		  			<?php foreach($data as $key => $friend): ?>
						  	<div>
								<img src="../../public/uploads/avatar/<?= $friend['avatar']; ?>" class="img-responsive" width="100px">
							</div>
		  					<h4><a href="/users/profile/<?= $friend['id']; ?>"><?= $friend['email']  ?></a></h4>
		  					<p><?= $friend['f_name'] ." ". $friend['l_name']; ?></p>
		  					<small>Friend science : <?= $friend['created_at']  ?></small><hr>
					<?php endforeach; ?>
				<?php else: ?>
					<h3>No friend found</h3>
				<?php endif; ?>
			</div>
		</div>
	</div>
