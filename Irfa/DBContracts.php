<?php
namespace Classes\Irfa;

interface DBContracts{
	public static function table($table);
	public static function select($arrwhere);
	public static function where($arrwhere);
	public static function get();
	public static function delete();
	public static function insert($params);
	public static function update($arrwhere);



}