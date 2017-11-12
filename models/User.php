<?php 
	namespace models;
	use system\Model;

	class User extends Model
	{
		public $_table = 'users';
		public function getAllUsers()
		{
			$param = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0 ;
			 return $this->_Db->select()
								 ->where('id !="'. $param.'"')
								 ->getAll($this->_table);
		}

		public function isEmailUnique($email)
		{
			return $this->_Db->select()
								->where('email ="'. $email.'"')
								->getAll($this->_table);
		}

		public function isRegisteredUser($email, $password)
		{
			return $curUser = $this->_Db->select()
										->where('email ="'. $email.'" AND password ="'. $password.'"')
										->getAll($this->_table);
		}

		public function createNewUser($data)
	 	{
	 		$this->_Db->insert($this->_table,$data);
	 	}

	 	public function getUserData()
	 	{
	 		return $this->_Db->select("$this->_table.*,posts.id as iid, title, body, posts.created_at as created_aat, user_id")->join('LEFT,posts,id,user_id')->where($this->_table.'.id ="'. $_SESSION['id'].'"')->order('iid,DESC')->getAll($this->_table);
	 	}

	 	public function controlUserAvatar($param,$data)
	 	{
			 $this->_Db->select($this->_table)
						 ->where("id = $param")
						 ->update($data);
	 	}
	 	
	 	public function getProfileData($param)
	 	{
			 return $this->_Db->select("$this->_table.*,posts.id as iid, title, body, posts.created_at as created_aat, user_id")->join('LEFT,posts,id,user_id')
								->where($this->_table.'.id ="'.$param.'"')
								->order('iid,DESC')
								->getAll($this->_table);
	 	}

	 	public function friendStatuse($param, $getOrSent)
	 	{
	 		if ($getOrSent == 'sent') {	
				 return $this->_Db->select()
									 ->where('req_from ="'.$_SESSION['id'].'" AND req_to ="'.$param.'"')
									 ->getAll('friends');
	 		}else{
				 return $this->_Db->select()
									 ->where('req_from ="'.$param.'" AND req_to ="'.$_SESSION['id'].'"')
									 ->getAll('friends');
	 		}
	 	}

	 	public function getSearchedUsers($param1, $param2 = false)
	 	{
	 		if ($param2) {
				return $this->_Db->select("id, f_name, l_name, avatar")
									 ->where("(f_name LIKE '%".$param1."%' AND l_name LIKE '%".$param2."%') OR (f_name LIKE '%".$param2."%' AND l_name LIKE '%".$param1."%')")
									 ->getAll($this->_table);
	 		}
			 return $this->_Db->select("id, f_name, l_name, avatar")
								 ->where("((f_name LIKE '%".$param1."%') OR (l_name LIKE '%".$param1."%')) and id <> '".$_SESSION['id']."'")
								 ->getAll($this->_table);
		}
	}
 ?>