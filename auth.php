<?php
/*
/*@filename:auth.php
/*@author:Kris Singh<cs15mtech11007@iith.ac.in>
/*@Date:13/05/2016
/*@package name :Iot Server
*/
/*@Auth:Main class for authenticating the user
*/
require 'db_connection.php';
class Auth{
	private $user_name;
	private $pass;
	function authenticate($conn,$obj){
		if(isset($_POST['user_name']) and isset($_POST['password'])){
			$this->user_name = $_POST['username'];
			$this->pass = $_POST['password'];
		}
		//$str = $conn->query('select database()')->fetchColumn();
		$str = "select user_name,password from Bumpy.user_info where (user_name = '$this->user_name ' and password = '$this->pass')";
		//print_r($str);
		try{
			$result = $conn->query($str);
			print_r($result);
		}
		catch(Exception $e){
			print_r($e);
		}
		if(empty($result)){
			print_r("Wrong username or password");
			return "Wrong username or password";
		}
		else{
			print_r("Successful");
			return "Successful";
		}
	}
	function __construct(){
		$obj = new MysqlConnect();
		$this->user_name = "root";
		$this->pass = "awesome";
		$conn = $obj->setter($this->user_name,"localhost",$this->pass);
		//print_r("hew");
		$this->authenticate($conn,$obj);
	}


}
$obj1 = new Auth();
?>