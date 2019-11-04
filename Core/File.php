<?php
/* File
Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
Kelas : TIF CID RP 17 B
NPM : 17 111 057
*/
namespace Classes\Core;
use stdClass;
class File {
	private static $error;
	public static function upload($konfigurasi){
		
	$mimetype = mime_content_type($konfigurasi['file']);
	if(in_array($mimetype, $konfigurasi['mime_type'])) {
		$path = $konfigurasi['upload_path'];
		if(file_exists($path)){
			if(is_writable($path)){
		   		move_uploaded_file($konfigurasi['file'], $path.$konfigurasi['nama_file']);

			   return true;
			}	else{
			self::$error['message'] = "Lokasi Upload hanya dapat dibaca saja";
	    	return false;
			}
		} else{
			self::$error['message'] = "Lokasi Upload tidak ditemukan";
	    	return false;
		}
	} else {
		self::$error['message'] = "Tipe File tidak sesuai";
	    return false;
	}
	}
	public static function errors(){
		$obj = new stdClass();
		foreach (self::$error as $key => $value) {
			$obj->$key = $value;
		}

		return $obj;
	
	}

	public static function delete($path){
		$file = $path;
		if(file_exists($file)){
			if(is_writable($file)){
				if (!unlink($file)){
				  	self::$error['message'] = "Kesalahan saat menghapus file";
				  	return false;
				  } else {
				  	return true;
				  }
				} else{
					self::$error['message'] = "Tidak dapat menghapus File, karena hanya bisa dibaca saja";
					return false;
				}
			} else{
					self::$error['message'] = "File tidak ditemukan";
					return false;
				}
	}
}