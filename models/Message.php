<?php 
	namespace models;
	use system\Model;

	class Message extends Model
	{
		public $_table = 'messages';
		
		public function getMessages($userId, $friendId)
		{
			return $this->_Db->select("$this->_table.*,users.id as iid,f_name,avatar")
							->join('LEFT,users,from_id,id')
							->where("(from_id = '".$userId."' AND to_id = '".$friendId."') OR (from_id = '".$friendId."' AND to_id = '".$userId."')") 
							->order('id,ASC')
							->getAll($this->_table);
		}

		public function insertNewMessag($data)
		{
			$insertNewMessag = $this->_Db->insert("messages",$data);
			if ($insertNewMessag) {
				return true;
			}else{
				return false;
			}
		}

		public function getAllMessages($userId, $friendId, $lastId)
		{
			return $this->_Db->select("$this->_table.*,users.id as iid,f_name,avatar")
								->join('LEFT,users,from_id,id')
								->where("messages.id > '".$lastId."- 2' AND ((from_id = '".$userId."' AND to_id = '".$friendId."') OR (from_id = '".$friendId."' AND to_id = '".$userId."'))") 
								->order('id,ASC')
								->getAll($this->_table);
		}

		public function getUsersWithMessages($sql)
		{
			return $this->_Db->getByQuery($sql);
		}
	}
