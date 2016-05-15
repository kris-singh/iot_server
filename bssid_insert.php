<?php
/*
/*@filename:bssid_insert.php
/*@author:Kris Singh<cs15mtech11007@iith.ac.in>
/*@Date:13/05/2016
/*@package name :Iot Server
*/
class BssidInsert{
	/*@insert:create json file with bssid number and save the items associated with it
	/*@get:Download the json file with bssid number
	*/
	function get(){
		/*@http://stackoverflow.com/questions/19758954/get-data-from-json-file-with-php
		*/
		if(isset($_POST['req']) and  isset($_POST['bssid'])){
			try{
				$str = file_get_contents('./static/json/'.$_POST['bssid'].'.json');
				$json = json_decode($str, true); // decode the JSON into an associative array
				echo json_encode($json[0]);
			}
			catch(Exception $e){
				print_r($e);
				echo "file does not exist";
			}
		}
	}
	function insert(){
		if(isset($_POST['bssid']) and !isset($_POST['req'])){
			$json[] = array('bssid' => $_POST['bssid'],'item' => $_POST['item']);
			try{
				$fp = fopen('./static/json/'.$_POST["bssid"].".json", "w+");
				print_r($fp);
				fwrite($fp, json_encode($json));
			}
			catch(Exception $e){
				print_r($e);
			}
			finally{
				fclose($fp);
			}
		}
		else{
			$this->get();
		}
	}
	function __construct(){
		//DO nothing
		echo "here";
	}
	
}
$obj = new BssidInsert();
$obj->insert();
?>
