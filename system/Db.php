<?php 
namespace system;
class Db 
{
	private $_con;
	private $_filds;
	private $_where = true;
	private $_order = false;
	private $_like = false;
	private $_join = false;
	function __construct()
	{	
		$this->_con = new \Mysqli ('localhost', 'root', '', 'atkaa');
		if ($this->_con->connect_errno) {
			echo $con->connect_error;exit;
		}
	}

	public function checkValuesSafety($value){
		$value = htmlspecialchars(stripslashes(trim($value)));
		return mysqli_real_escape_string($this->_con, $value);
	}

	public function multiInsert($table_name, $data)
	{
		$data_key=[]; $data_value = []; $insert_row = "";$insert_row_key = "";
		foreach ($data as $_key => $_value) {
			$insert_row = '(';
			$insert_row_key = '(';
			foreach ($_value as $key => $value) {
				$insert_row .= "'".$this->checkValuesSafety($value)."',";
				$insert_row_key .= $this->checkValuesSafety($key).",";
			}
			$insert_row = substr($insert_row,0,-1);
			$insert_row_key = substr($insert_row_key,0,-1);
			$insert_row .= ')';
			$insert_row_key .= ')';
			$data_value[] = $insert_row;
		}
		$data_key[] = $insert_row_key;
		$keys = implode(",",$data_key);
		$values = implode(",",$data_value);
		$table_name = $this->checkValuesSafety($table_name);
		$sql = "INSERT INTO $table_name $keys VALUES $values";
		return $this->_con->query($sql);
	}

	public function insert($table_name, $data)
	{
		$data_key=[]; $data_value = [];
		foreach ($data as $key => $value) {
			$data_key[] = $this->checkValuesSafety($key);
			$data_value[] = "'".$this->checkValuesSafety($value)."'";
		}
		$keys = implode(",",$data_key);
		$values = implode(",",$data_value);
		$table_name = $this->checkValuesSafety($table_name);
		$sql = "INSERT INTO $table_name ($keys) VALUES ($values)";
		return $this->_con->query($sql);
	}

	public function select($filds = '*')
	{
		$this->_filds =  $this->checkValuesSafety($filds);
		return $this;
	}

	public function where($where)
	{
		$this->_where = $where;
		return $this;
	}

	public function order($order)
	{
		$order = $this->checkValuesSafety($order);
		$this->_order = explode(",",$order);
		return $this;
	}

	public function like($like = '%')
	{
		$this->_like =  $this->checkValuesSafety($like);
		return $this;
	}

	public function join($join)
	{
		$join =  $this->checkValuesSafety($join);
		$this->_join = explode(",",$join);
		return $this;
	}

	public function getAll($table_name)
	{
		$rows = [];
		if (!$this->_order) {$this->_order[0] = 'ID';$this->_order[1] = 'DESC';}
		$table_name =  $this->checkValuesSafety($table_name);
		$sql = "SELECT $this->_filds FROM $table_name WHERE $this->_where ORDER BY {$this->_order[0]} {$this->_order[1]}";
		if ($this->_like && $this->_filds != '*') {
			$sql = "SELECT $this->_filds FROM $table_name WHERE $this->_filds LIKE '%$this->_like%'";
		}
		if ($this->_join) {
			$sql = "SELECT $this->_filds FROM $table_name {$this->_join[0]} JOIN {$this->_join[1]} ON ($table_name.{$this->_join[2]} = {$this->_join[1]}.{$this->_join[3]}) WHERE $this->_where ORDER BY {$this->_order[0]} {$this->_order[1]}";
		}
		$q = $this->_con->query($sql);
		if(!$q){return mysqli_error($this->_con);}
		while ($row = $q->fetch_assoc()) {$rows[] = $row;}
		$this->_where = true;$this->_like = false;$this->_join = false;$this->_order = false;
		return $rows;
	}

	public function getFirst($table_name)
	{
		$table_name =  $this->checkValuesSafety($table_name);
		$sql = "SELECT $this->_filds FROM $table_name WHERE $this->_where";
		$result = $this->_con->query($sql);
		if(!$result){return mysqli_error($this->_con);}
		$row = $result->fetch_assoc();
		$this->_where = true;$this->_like = false;
		return $row;
		
	}

	public function getByQuery($sql)
	{
		$result = $this->_con->query($sql);
		if(!$result){return mysqli_error($this->_con);}
		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {$rows[] = $row;}
			return $rows;
		}else{
			return false;
		}
	}

	public function update($data)
	{
		$update_row = '';
		foreach ($data as $key => $value) {
			$update_row .= $this->checkValuesSafety($key)."='".$this->checkValuesSafety($value)."',";
		}
		$update_row = substr($update_row,0,-1);
		$sql = "UPDATE $this->_filds SET $update_row WHERE $this->_where";
		if ($this->_like && $this->_filds != '*') {
			$sql = "UPDATE $this->_filds SET $update_row WHERE $this->_where LIKE '%$this->_like%'";
		}
		$result = $this->_con->query($sql);
		$this->_where = true;$this->_like = false;
		if(!$result){return mysqli_error($this->_con);}
	}

	public function delete()
	{
		$sql = "DELETE FROM $this->_filds WHERE $this->_where";
		return $this->_con->query($sql);
	}
}
 ?>