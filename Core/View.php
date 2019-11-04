<?php
/* View Loader
Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
Kelas : TIF CID RP 17 B
NPM : 17 111 057
*/
 namespace Classes\Core;

 Class View {

 	public static function load($file,$var = null){///Nama file, dan Variabelnya
 		if($var != null){
	 		foreach($var as $key => $val){

	 			${$key} = $val;

	 		}
	 	}
	 	if(file_exists("view/".$file.".php")){///Cek File tersebut ada atau tidak
	 		include 'view/master/header.php';//Memuat Header
	 		include 'view/'.$file.".php";//Memuat body
	 		include 'view/master/footer.php';//Memuat Footer
 		} else{//Jika File tidak ditemukan
 			echo"Kesalahan: <b>File ".$file.".php tidak ditemukan di direktori view</b>";
 		}
 	}	
 	
 	public static function LayoutLogin($file,$var = null){///Nama file, dan Variabelnya
 		if($var != null){
	 		foreach($var as $key => $val){

	 			${$key} = $val;

	 		}
	 	}
	 	if(file_exists("view/".$file.".php")){///Cek File tersebut ada atau tidak
	 		include 'view/master/login_head.php';//Memuat Header
	 		include 'view/'.$file.".php";//Memuat body
	 		include 'view/master/login_footer.php';//Memuat Footer
 		} else{//Jika File tidak ditemukan
 			echo"Kesalahan: <b>File ".$file.".php tidak ditemukan di direktori view</b>";
 		}
 	}
 	public static function LayoutAdmin($file,$var = null){///Nama file, dan Variabelnya
 		if($var != null){
	 		foreach($var as $key => $val){

	 			${$key} = $val;

	 		}
	 	}
	 	if(file_exists("view/dashboard/".$file.".php")){///Cek File tersebut ada atau tidak
	 		include 'view/master/admin_head.php';//Memuat Header
	 		include 'view/dashboard/'.$file.".php";//Memuat body
	 		include 'view/master/admin_footer.php';//Memuat Footer
 		} else{//Jika File tidak ditemukan
 			echo"Kesalahan: <b>File ".$file.".php tidak ditemukan di direktori view</b>";
 		}
 	}
 }