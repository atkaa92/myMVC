<?php 
	namespace system;

	class Controller 
	{
		public $_View;
		function __construct()
		{
			$this->_View = new View;
		}
	}
?>