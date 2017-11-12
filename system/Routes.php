<?php 
	namespace system;
	session_start();

	class Routes  
	{
		function __construct()
		{
			$url = explode('/',substr($_SERVER['REQUEST_URI'], 1));

			if (isset($url[0]) && !empty($url[0])) {
				$ctrl = ucfirst($url[0]);
				if (file_exists('controllers/'.$ctrl.'.php')) {
					$ctrl_class = 'controllers\\'.$ctrl;
					if (class_exists($ctrl_class, true)) {
						$ctrl_obj = new $ctrl_class;
						if (isset($url[1]) && !empty($url[1])) {
							$method = $url[1];
							if (method_exists($ctrl_obj, $method)) {
								$params = array_slice($url, 2);
								call_user_func_array([$ctrl_obj, $method], $params);
							}else{
								header("HTTP/1.0 404 Not Found");
								$message404 = "Method Not Found";
								include '404missing.php';
								die();
							}
						}else{
							if (method_exists($ctrl_obj, 'index')) {
								$ctrl_obj->index();
							}else{
								echo "Error:INDEX not found";
							}
						}
					}else{
						header("HTTP/1.0 404 Not Found");
						$message404 = "Object Not Found";
						include '404missing.php';
						die();
					}
				}else{
					header("HTTP/1.0 404 Not Found");
					$message404 = "Page Not Found";
					include '404missing.php';
					die();
				}
			}else{
				$df_obj = new \controllers\Pages;
				$df_obj->index();
			}
		}
	}
 ?>

<?php 
	// namespace system;
	// use controllers\Home;
	// use controllers\About;

	// class Routes  
	// {
	// 	protected $controller	 = 'home';
	// 	protected $method		 = 'index';
	// 	protected $params		 = [];

	// 	function __construct()
	// 	{
	// 		$url = explode('/',substr($_SERVER['REQUEST_URI'], 1));
	// 		if (isset($url[0]) && !empty($url[0]) && file_exists('controllers/'.$url[0].'.php') && class_exists('controllers\\'.$url[0], true)) 
	// 		{
	// 			$this->controller = $url[0];
	// 			// $this->controller = new Home;
	// 			$this->controller = 'controllers\\'.$this->controller;
	// 			$this->controller = new $this->controller;
	// 			unset($url[0]);
				
	// 			if (isset($url[1]) && !empty($url[1]) && method_exists($this->controller, $url[1])) {
	// 				$this->method = $url[1];
	// 				unset($url[1]);
	// 			}
				
	// 			$this->params = $url ? array_values($url) : [] ;
	// 			call_user_func_array([$this->controller, $this->method], $this->params);
	// 		}
	// 		elseif(empty($url[0]))
	// 		{
	// 			$this->controller = new Home;
	// 			call_user_func([$this->controller, $this->method], $this->params);
	// 		}
	// 		else
	// 		{
	// 			header("HTTP/1.0 404 Not Found");
	// 			include '404missing.php';
	// 			die();
	// 		}
	// 	}
	// }
 ?>
