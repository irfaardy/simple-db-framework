<?php 
/* Password
Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
Kelas : TIF CID RP 17 B
NPM : 17 111 057
*/
namespace Classes\Core;

 Class Password {

 	public  static function generate($string,$salt=12){
 		$option = ['cost' => $salt];
 	 	$gen = password_hash($string,PASSWORD_BCRYPT,$option);

 	 	return $gen;
 	}
 	public  static function cek($string_plain,$hashed_pwd){
 		if(password_verify($string_plain,$hashed_pwd)){
 			return true;//Jika password benar
 		} else{
 			return false;//Jika password salah
 		}
 	}
 }