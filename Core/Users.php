<?php
/* User
Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
Kelas : TIF CID RP 17 B
NPM : 17 111 057
*/
 namespace Classes\Core;
use Classes\Irfa\DBOperation as DB;
 Class Users {
 	public static function get($username){
 		DB::table('users');
 		DB::where(['username' => $username]);
 		$get = DB::first();
 		return $get;
 	}
 }