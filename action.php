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

if(isser($_POST["edit"])){
	$myArray = array(
		"m_name" => $_POST["name"],
		"qty" => $_POST["qty"],
	);
}



 ?>