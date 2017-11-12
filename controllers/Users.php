<?php 
	namespace controllers;
	use system\Controller;
	use models\User;
	use models\Friend;
	use models\Message;

	class Users extends Controller
	 {
	 	public $_Users;
	 	public $_Friends;
	 	public $_Messages;

	 	function __construct(){
	 		parent::__construct();
			 $this->_Users = new User;
			 $this->_Friends = new Friend;
			 $this->_Messages = new Message;
	 	}

	 	public function index()
	 	{
	 		$this->_View->_allUsers = $this->_Users->getAllUsers();
	 		$this->_View->rander('users/users');
	 	}

	 	public function register()
	 	{
	 		$this->_View->rander('users/register');
	 	}

	 	public function create()
	 	{
	 		$data = $_POST;
	 		array_pop($data);
	 		if (!empty($data['f_name']) && !empty($data['l_name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['conf_password'])) {
	 			if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
	 				if ($data['password'] === $data['conf_password']) {
	 					$uniqueEmail = $this->_Users->isEmailUnique($data['email']);
	 					if (count($uniqueEmail) == 0) {
	 						array_pop($data);
		 					$data['password'] = md5($data['password']);
	 						$data['avatar'] = 'avatar.png';
	 						$this->_Users->createNewUser($data);
		 					$_SESSION['success'] = 'Welcome '. $data['f_name']." ". $data['l_name'];
		 					header('Location: /users/login');
	 					}else{
	 						$_SESSION['error'] = "Email  already exists.";
							$this->_View->rander('users/register');
	 					}
	 				}else{
	 					$_SESSION['error'] = "Password doesn`t match.";
						$this->_View->rander('users/register');
	 				}
				}else{
					$_SESSION['error'] = "Email is not valid.";
					$this->_View->rander('users/register');
				}
	 		}else{
	 			$_SESSION['error'] = "Fill up all columns.";
				$this->_View->rander('users/register');
	 		}
	 	}

	 	public function avatarCtrl()
	 	{
	 		if(!isset($_SESSION['id']) || (!isset($_POST['editAvatar']) && !isset($_POST['addAvatar']) && !isset($_POST['deleteAvatar']))){
	 			header('Location: /users/user');die;}
	 		if (isset($_POST['deleteAvatar']) && $_POST['deleteAvatar'] == 'Delete Image') {
	 			$userData = $this->_Users->getUserData();
	 			$delImg = $userData[0]['avatar'];
	 			unlink("public/uploads/avatar/$delImg");
	 			$data['avatar'] = 'avatar.png';
	 			$this->_Users->controlUserAvatar($_SESSION['id'], $data);
	 			header('Location: /users/user');
	 		}else if ( $_POST['addAvatar'] == 'Add Image' || $_POST['editAvatar'] == 'Edit Image') {
	 			$folder = "public/uploads/avatar";
				$file = $_FILES['avatar'];
				$fileActualExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
				$valid_formats = ["jpg", "png", "jpeg"];
				if (in_array($fileActualExt, $valid_formats)) {
					$image = md5(date('y/m/d/h/m/s').$file['name']).'.'.$fileActualExt;	
					if ($file['error'] === 0) {
						if ($file['size'] < 10240000) {
							$upload = move_uploaded_file($file['tmp_name'], $folder.'/'.$image);
							if ($upload && $_POST['editAvatar'] == 'Edit Image') {
								$userData = $this->_Users->getUserData();
					 			$delImg = $userData[0]['avatar'];
					 			unlink("public/uploads/avatar/$delImg");
								$data['avatar'] = $image;
							}else{
								$data['avatar'] = 'avatar.png';
							}
							$data['avatar'] =  ($upload) ? $image : 'avatar.jpg';
							$this->_Users->controlUserAvatar($_SESSION['id'],$data);
							header('Location: /users/user');
						} else {
							 $_SESSION['error'] = "Your file is too big!!!";
							 header('Location: /users/user');
						}
					} else {
						$_SESSION['error'] = "There was an error uploading your file!!!";
						header('Location: /users/user');
					}
				} else {
					$_SESSION['error'] =  " You cannot upload files of this type!!!";
					header('Location: /users/user');
				}
	 		}
	 	}

	 	public function login()
	 	{
	 		$this->_View->rander('users/login');
	 	}

	 	public function doLogin()
	 	{
	 		$data = $_POST;
	 		array_pop($data);
	 		if (!empty($data['email']) && !empty($data['password'])) {
 				$data['password'] = md5($data['password']);
 				$curUser = $this->_Users->isRegisteredUser($data['email'],$data['password']);
 				if (count($curUser) == 1) {
					 $_SESSION['id'] = $curUser[0]['id'];
	 				header('Location: /users/user');
 				}else{
 					 $_SESSION['error'] = "Incorrect email or password.";
					$this->_View->rander('users/login');
 				}
	 		}else{
 				 $_SESSION['error'] = "Fill up all columns.";
 				$this->_View->rander('users/login');
	 		}
	 	}
	 	public function user()
	 	{
	 		if(!isset($_SESSION['id'])){{header('Location: /users/login');die;}}
	 		$this->_View->_userData = $this->_Users->getUserData();
	 		$this->_View->_userRequestcount = count($this->_Friends->getFriendRequests());
	 		$this->_View->rander('users/user');
	 	}

	 	public function profile($param)
	 	{
	 		$this->_View->_profileData = $this->_Users->getProfileData($param);
	 		if (isset($_SESSION['id'])) {
	 			$this->_View->_sentFriendStatus = $this->_Users->friendStatuse($param, 'sent');
	 			$this->_View->_getFriendStatus = $this->_Users->friendStatuse($param, 'get');
	 		}
	 		$this->_View->rander('users/profile');
	 	}

	 	public function logout()
	 	{
	 		unset($_SESSION['id']);
	 		header('Location: ' . $_SERVER['HTTP_REFERER']);
	 	}

	 	public function search($param = false)
	 	{
	 		$serachedText = explode("&",$param);
	 		if (isset($serachedText['1'])) {
	 			$this->_View->_serachedUsers = $this->_Users->getSearchedUsers($serachedText['0'], $serachedText['1']);
	 		}else{
	 			$this->_View->_serachedUsers = $this->_Users->getSearchedUsers($serachedText['0']);
	 		}
	 		$this->_View->rander('users/search');
	 	}

	 	public function messages($param)
	 	{
			if(!isset($_SESSION['id']) || !isset($param)){{header('Location: /users');die;}}
			$friendId = $param;
			$userId = $_SESSION['id'];
			$this->_View->_messages = $this->_Messages->getMessages($userId, $friendId);
			$this->_View->_profileData = $this->_Users->getProfileData($param);
			$sql = "select u.id, f_name, email from users as u RIGHT join messages as m on (u.id = from_id or u.id = to_id) 
			where u.id != {$_SESSION['id']} and (from_id = {$_SESSION['id']} or to_id = {$_SESSION['id']}) GROUP BY u.id";
			$this->_View->_getUsersWithMessages = $this->_Messages->getUsersWithMessages($sql);
	 		$this->_View->rander('users/messages');
		 }
		 
		 public function addMessage()
		 {
			$messsage = $_POST['messsage'];
			$friendId = $_POST['mes_to_id'];
			$userId = $_SESSION['id'];
			$data = [
				'from_id' => $userId,
				'to_id' => $friendId,
				'body' => $messsage 
			];
			$addedMessage = $this->_Messages->insertNewMessag($data);
			$myJSON = json_encode('1');
			echo $myJSON;
		 }

		 public function newMessages()
		 {
			$lastId = (isset($_POST['lastId'])) ? $_POST['lastId'] : '0';
			$friendId = $_POST['mes_to_id'];
			$userId = $_SESSION['id'];
			$myJSON = $this->_Messages->getAllMessages($userId, $friendId, $lastId);
			if (!empty($myJSON )) {
				echo json_encode($myJSON);;
			}else{
				echo json_encode('1');
			}
		 }
	 } 
 ?>