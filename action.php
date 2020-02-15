<?php 

include 'db.php';

/**
 * 
 */
class DataOperation extends Database
{
	
	public function insert_record($table,$fields)
	{
		$sql = "";
		$sql .= "insert into ".$table;
		$sql .= " (".implode(",",array_keys($fields)).") values";
		$sql .= "('".implode("','",array_values($fields))."')";
		echo $sql;
		$query = mysqli_query($this->con,$sql);
		if($query){
			return true;
		}
	}

	public function fetch_record($table)
	{
		$sql = "select * from ".$table;
		$array = array();
		$query = mysqli_query($this->con,$sql);
		
		while($row = mysqli_fetch_assoc($query)){
			$array[] = $row;
		}

		return $array;
		echo $sql;
	}

	public function select_record($table,$where)
	{
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			# code...
			$condition .= $key . "='" . $value . "' and ";
		}

		$condition = substr($condition,0,-5);
		$sql .="select * from ".$table." where ".$condition;
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}

	public function update_record($table,$where,$fields)
	{
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value . "' and ";
		}

		$condition = substr($condition,0,-5);

		foreach ($fields as $key => $value) {
			$sql .= $key . "='".$value."', ";
		}
		$sql = substr($sql ,0,-2);
		$sql = "update ".$table." set ".$sql." where ".$condition;
		$query = mysqli_query($this->con,$sql);
		echo $sql;
		if($query){
			return true;
		}
	}

	public function delete_record($table,$where)
	{
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='". $value . "' and ";
		}

		$condition = substr($condition,0,-5);
		$sql = "delete from ".$table." where ".$condition;
		$query = mysqli_query($this->con,$sql);
		echo $sql;
		if($query){
			return true;
		}
		
	}
}

$obj = new DataOperation;
if(isset($_POST["submit"])){
	$myArray = array(
		"m_name" => $_POST["name"],
		"qty" => $_POST["qty"],
	);
	if($obj->insert_record("medicines",$myArray)){
		header("location:index.php?msg=Record Inserted");
	}
	else{
		echo"error";
	}
}

if(isset($_POST["edit"])){
	$id = $_POST["id"];
	$where = array("id"=>$id);
	$myArray = array(
		"m_name" => $_POST["name"],
		"qty" => $_POST["qty"],
	);
	if ($obj->update_record("medicines",$where,$myArray)) {
		header("location:index.php?msg=Record Updated");
	}else{
	}
}

if(isset($_GET["delete"])){
	$id = $_GET["id"] ?? null;
	$where = array('id'=>$id);
	if ($obj->delete_record("medicines",$where)) {
		header("location:index.php?msg=Record Deleted");
	}
}



 ?>