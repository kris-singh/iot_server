<?php
/*
/*@filename:db_connection
/*@author:Kris Singh<cs15mtech11007@iith.ac.in>
/*@Date:13/05/2016
/*@package name :Iot Server
*/
/*
@conn MysqlConnect Class
*/
class MysqlConnect{
	public $server_name;
	public $user_name;
	public $password;
	public $dbname;
	public $conn;
	//function for connecting 
	private function connect(){
		try{
			print_r($this->server_name);
			$conn = new PDO("mysql:localhost;dbname = Bumpy", $this->user_name, $this->password);
	    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	print_r("Connection estb");
	    	return $conn;
	    }
	    catch(Exception $e){
	    	print_r("Connection Not possible");
	    	print_r($e);
	    }
	}
	//function for setting the values
	public function setter($user_name,$server_name,$password){
		//$this->$user_name = $user_name;
		//print_r($this);
		$this->user_name = $user_name;
		$this->server_name = $server_name;
		$this->password = $password;
		$conn = $this->connect();
		return $conn;

	}
	//constructor
	public function __construct(){
		$this->server_name  = "localhost";
		$this->user_name = "kris";
		$this->password = "awesome";
		$this->dbname = "Bumpy";
	}
}
$obj = new MysqlConnect();
//print_r($obj);
//$obj->setter("root","localhost","awesome");

?>
