<?php 
	namespace models;
	use system\Model;
	class Post extends Model
	{
		public $_table = 'posts';
		public function getAllPosts()
		{
	 		return $this->_Db->select("$this->_table.*,users.email, users.id as iid ")->join('INNER,users,user_id,id')->getAll($this->_table);
		}

		public function showCurrentPost($param)
		{
	 		return	$this->_Db->select("$this->_table.*,users.email, users.id as iid")->join('INNER,users,user_id,id')->where($this->_table.'.id ="'. $param.'"')->getAll($this->_table);
		}

		public function addNewPost($data)
		{
			$this->_Db->insert($this->_table,$data);
		}

		public function updateCurrentPost($param,$data)
		{
	 		$this->_Db->select($this->_table)->where("id = $param")->update($data);
		}

		public function deleteCurrentPost($param)
		{
	 		$this->_Db->select($this->_table)->where("id = $param")->delete();
		}
	}

 ?>

