<?php 
/* Input
Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
Kelas : TIF CID RP 17 B
NPM : 17 111 057
*/
namespace Classes\Core;
use stdClass;

class Input {
	public static function get($str){
		$get=null;
		if(isset($_GET[$str])){
			$get = $_GET[$str];
		} else{
			$get = "";
		}
		return $get;
	}

	public static function post($str){

		$post=null;
		if(isset($_POST[$str])){
			$post = $_POST[$str];
		} else{
			$post = "";
		}
		return $post;
	
	}
	public static function file($str){

		$file=null;
		$obj=new stdClass();
		if(isset($_FILES[$str])){
			$file = $_FILES[$str];
			foreach ($file as $key => $value) {
				$obj->$key = $value;
			}
			return $obj;
		} else{
			$file = "";

			return $file;
		}

	
	}
}