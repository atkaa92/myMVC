<?php 
	namespace controllers;
	use system\Controller;
	use models\Post;
	
	class Posts extends Controller
	 {
	 	public $_Posts;

	 	function __construct(){
	 		parent::__construct();
	 		$this->_Posts = new Post;
	 	}

	 	public function index()
	 	{
	 		$this->_View->_allPosts = $this->_Posts->getAllPosts();
	 		$this->_View->rander('posts/posts');
	 	}

	 	public function show($param = '')
	 	{
	 		if ($param != '') {
	 			$this->_View->_curPost = $this->_Posts->showCurrentPost($param);
	 			if (count($this->_View->_curPost) == 0 ) {
	 				header('Location: /posts');
	 			}
	 			$this->_View->rander('posts/show');
	 		}else{
	 			header('Location: /posts');
	 		}
	 	}

	 	public function add()
	 	{
	 		$this->_View->rander('posts/add');
	 	}

	 	public function create()
	 	{
	 		$data = $_POST;
	 		if ($data['title'] == '' || $data['body'] == '') {
	 			$_SESSION['error'] = "Fill up all columns.";
				$this->_View->rander('posts/add');
	 		}else{
	 			array_pop($data);
	 			$data['user_id'] = $_SESSION['id'];
	 			$this->_Posts->addNewPost($data);
	 			$_SESSION['success'] = "New post added.";
				$this->_View->rander('users/register');
	 			header('Location: /users/user');
	 		}
	 		
	 	}

	 	public function edit($param)
	 	{
	 		$this->_View->_editPost = $this->_Posts->showCurrentPost($param);
	 		$this->_View->rander('posts/edit');
	 	}

	 	public function update($param)
	 	{
	 		$data = $_POST;
	 		if ($data['title'] == '' || $data['body'] == '') {
	 			$this->_View->_editPost = $this->_Posts->showCurrentPost($param);
	 			$_SESSION['error'] = "Fill up all columns.";
				$this->_View->rander('posts/edit');
	 		}else{
	 			array_pop($data);
	 			$this->_Posts->updateCurrentPost($param,$data);
	 			header("Location: /posts/show/$param");
	 		}
	 	}

	 	public function delete($param)
	 	{
	 		$this->_Posts->deleteCurrentPost($param);
	 		header('Location: /posts');
	 	}
	 } 
 ?>