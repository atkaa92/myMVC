<?php if(count($this->_profileData) < 1){{header('Location: /users');}} ?>
<div class="container">
	<div class="col-sm-3" >
		<?php if ($this->_getUsersWithMessages): ?>
			<ul class="list-group">
				<?php foreach($this->_getUsersWithMessages as $user): ?>
					<li class="list-group-item" <?php if($this->_profileData[0]['id'] == $user['id']){ echo 'style="background:#000"'; } ?> > 
						<a href="/users/messages/<?= $user['id'];?>" <?php if($this->_profileData[0]['id'] == $user['id']){ echo 'style="color:gray"'; } ?>> 
							<?= $user['f_name']; ?> : <?= $user['email']; ?> 
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<div class="col-sm-9 messageList">
	<?php 
	if ($this->_messages): ?>
		<?php foreach($this->_messages as $message): ?>
			<div class="row messageListItem" data-message-id="<?= $message['id']; ?>">
				<div class="col-sm-1 <?php if($message['from_id'] == $_SESSION['id']) { echo 'pull-right';} ?>">
					<!-- <a><?= $message['f_name']; ?></a><br><br> -->
					<img src="../../public/uploads/avatar/<?= $message['avatar']; ?>" width="45px" style="border: 1px solid #000; border-radius:100%;">
				</div>
				<div class="col-sm-11 <?php if($message['from_id'] == $_SESSION['id']) { echo 'pull-right text-right';} ?>">
						<small><i><?= $message['created_at']; ?></i></small>
					<b><p class="well" style="padding: 3px 10px; margin-bottom: 3px;"><?= $message['body']; ?></p></b>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<h2>No message found</h2>
	<?php endif; ?>
	</div>
	<br><br>	
	<div class="row pull-right" style="margin-top: 20px;">
			<div class="col-sm-4"></div>
			<div class="col-sm-6">
				<textarea class="form-control" cols="120" id="messsage" placeholder="Type message ... "></textarea>
			</div>
			<div class="col-sm-2">
				<input type="hidden" id="mes_to_id" value="<?= $this->_profileData[0]['id']; ?>">
				<button class="btn btn-info btn-md" id="messsageBTN">Sent Message</button>
			</div>
		</div>
	</div>
</div>


