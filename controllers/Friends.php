<?php 
	namespace controllers;
	use system\Controller;
	use models\Friend;

	class Friends extends Controller
	 {
	 	public $_Friends;

	 	function __construct(){
	 		if(!isset($_SESSION['id'])){{header('Location: /users/login');die;}}
	 		parent::__construct();
	 		$this->_Friends = new Friend;
	 	}

	 	public function index()
	 	{
	 		$sql = "select u.* from users as u INNER join friends as f on (u.id = req_from or u.id = req_to) 
	 				where u.id != {$_SESSION['id']} and (req_from = {$_SESSION['id']} or req_to = {$_SESSION['id']}) and STATUS = 1";
	 		$allFriends = $this->_Friends->getAllFriends($sql);
	 		$allRequests = $this->_Friends->getFriendRequests();
	 		$this->_View->rander('friends/friends', true, $allFriends, $allRequests );
	 	}

	 	public function friend($param)
	 	{
	 		$data['req_from'] = $_SESSION['id'];
	 		$data['req_to'] = $param;
	 		$this->_Friends->sendFriendRequest($data);
	 		header('Location: ' . $_SERVER['HTTP_REFERER']);
	 	}

	 	public function unfriend($param)
	 	{
	 		$this->_Friends->deletefromFriendList($param);
	 		header('Location: ' . $_SERVER['HTTP_REFERER']);
	 	}

	 	public function accept($param)
	 	{	
	 		$data['status'] = 1;
	 		$this->_Friends->acceptFriendRequest($param,$data);
	 		header('Location: ' . $_SERVER['HTTP_REFERER']);
	 	}
	 } 
 ?>
