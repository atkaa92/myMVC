<?php 
	namespace models;
	use system\Model;

	class Friend extends Model
	{
		public $_table = 'friends';
		public function getAllFriends($sql)
		{
			return $this->_Db->getByQuery($sql);
		}

		public function getFriendRequests()
		{
			return $this->_Db->select("users.email, users.id as iid, users.avatar, friends.*")->join('INNER,users,req_from,id')->where('req_to ="'. $_SESSION['id'].'" and status = 0')->getAll($this->_table);
		}

		public function sendFriendRequest($data)
		{
			$this->_Db->insert($this->_table,$data);
		}

		public function deletefromFriendList($param)
		{
	 		$this->_Db->select($this->_table)->where("id = $param")->delete();
		}
	
		public function acceptFriendRequest($param,$data)
		{
	 		$this->_Db->select($this->_table)->where("id = $param")->update($data);
		}
	}

 ?>

