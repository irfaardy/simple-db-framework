<?php 
/* Messages dan Flash message
Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
Kelas : TIF CID RP 17 B
NPM : 17 111 057
*/
namespace Classes\Core;
use stdClass;
class Messages {
	
	private static $msg;
	private static $type;
	private static $params = [];
	function __construct(){
	
	}
	public static function set($msg,$type){
		$_SESSION['message'] = $msg;
		$_SESSION['type'] = $type;
		return true;
	}

	public static function get(){
		$obj = new stdClass();

		$obj->message = isset($_SESSION['message']) ? $_SESSION['message']:null ;
		$obj->type = isset($_SESSION['type']) ? $_SESSION['type']:null ;
		
		return $obj;
	}

	public static function flashSet($arr){
		$_SESSION['arr'] = $arr;
		foreach($arr as $ar => $val){
			$_SESSION[$ar] =  $val;

		}
			
		return true;

	}
	public static function flashGet($str){
		
			$str = isset($_SESSION[$str])?$_SESSION[$str]:"";

			unset($_SESSION[$str]);
		return $str;

	}

	function __destruct(){

		unset($_SESSION['message']);
		unset($_SESSION['type']);
		if(isset($_SESSION['arr'])){
		foreach($_SESSION['arr'] as $ar => $val){
			unset($_SESSION[$ar]);

		}}
	}





	
}