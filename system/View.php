<?php 
	namespace system;

	class View
	{
		public function rander($filename, $inc = true, $data = false, $extraData = false)
		{
			if (file_exists('views/'.$filename.'_view.php')) {
				if ($inc) {
					include 'views/inc/header.php';
					include 'views/'.$filename.'_view.php';
					include 'views/inc/footer.php';
				}else{
					include 'views/'.$filename.'_view.php';
				}
			}else{
				echo "Error: View not found";
			}
		}
	}
?>