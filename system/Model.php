<?php 
	namespace system;

	class Model
	{
		public $_Db;
		function __construct()
		{
			$this->_Db = new Db;
		}
	}
?>