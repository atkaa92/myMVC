<?php 
	namespace controllers;
	use system\Controller;

	class Pages extends Controller
	 {
	 	public function index()
	 	{
	 		$this->_View->rander('pages/home');
	 	}

	 	public function about()
	 	{
	 		$this->_View->rander('pages/about');
	 	}
	 } 


 ?>