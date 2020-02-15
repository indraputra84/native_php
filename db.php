<?php 

/**
 * 
 */
class Database
{
	
	public $con;
	public function __construct()
	{
		$this->con = mysqli_connect("localhost","root","","db_medicine");
	}
}

$obj = new Database;

 ?>