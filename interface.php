<?php
/*
/*@filename:interface.php
/*@author:Kris Singh<cs15mtech11007@iith.ac.in>
/*@Date:13/05/2016
/*@package name :Iot Server
*/
/*@Action:Perform gven action on given item
/*@AddSensor:Add Sensor information to database
*/
require 'db_connection.php';
require 'remote_exec.php';
class Action{
	/*@get_status:get the status of the given item
	/*@take_action:take action of the given item
	/*@check_input:(item_id ,action) pair exists
	*/
	public $item_code;
	public $item_staus;
	public $action;
	public $conn;
	function get_status(){
		$str = "select status from Bumpy.item_status where (item_id = '$this->item_code')";
		try{
			$result = $this->conn->query($str);
			print_r($result);
		}
		catch(Exception $e){
			print_r($e);
		}
		if(empty($result)){
			print_r("status not exist");

			echo "status not available";
		}
		else{
			$ids = $result->fetchAll(\PDO::FETCH_COLUMN);
			print_r($ids[0]);
			echo $ids[0];
		}
	}
	public function take_action(){
		if($this->action == "get"){
			$this->get_status();
		}
		else{
			remote_exec($this->action);
		}
	}
	function check_input(){
		$str = "select * from Bumpy.item_info where (itemid = '$this->item_code' and Action = '$this->action')";
		try{
			$result = $this->conn->query($str);
			print_r($result);
		}
		catch(Exception $e){
			print_r($e);
		}
		if(empty($result->fetchAll(\PDO::FETCH_COLUMN))){
			print_r("Item or action is invalid");
			echo "Item or action is invalid";
		}
		else{
			print_r("Successful");
			$this->take_action();
		}
	}
	
	function __construct(){
		$obj = new MysqlConnect();
		$this->user_name = "root";
		$this->pass = "awesome";
		$this->conn = $obj->setter($this->user_name,"localhost",$this->pass);
		if(isset($_POST['item_code']) and isset($_POST['action'])){
			print_r("here");
			$this->item_code = $_POST['item_code'];
			$this->action = $_POST['action'];
			$this->check_input();
		}
	}
}
$obj = new Action();
?>