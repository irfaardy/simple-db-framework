<?php
/* DB Operation Framework
	Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
*/
 namespace Irfa;
 use Irfa\DBConnection as Conn;
 use PDO;

class DBOperation extends DBConnection {
 	 private static $table;
 	 private static $colval;
 	 private static $colvalOr;
 	 private static $colvalLike;
 	 private static $colvalOrLike;
 	 private static $colvalNot;
 	 private static $select=null;
 	 private static $mergeCol=[];
 	 private static $mergeInsCol;
 	 private static $InsColVal;
 	 private static $InnerJoin=[];
 	 private static $leftJoin=[];
 	 private static $rightJoin=[];
 	 private static $crossJoin=[];
 	 private static $grpBy=[];
 	 private static $limit;
 	 private static $orderBy;
 	 private static $rawQuery;
	///Definisi tabel table(nama tabel)
	public static function table($table){
	 	self::$table = $table;
	 	return new static();
	}
	///Definisi tabel join(nama tabel,kuncinya)
	public static function join($table,$on){
		self::$InnerJoin[$table] = $on;
		return new static();
	}
	///Definisi tabel leftjoin(nama tabel,kuncinya)
	public static function leftJoin($table,$on){
		self::$leftJoin[$table] = $on;
		return new static();
	}
	///Definisi tabel rightjoin(nama tabel,kuncinya)
	public static function rightJoin($table,$on){
		self::$rightJoin[$table] = $on;
		return new static();
	}
	///Definisi tabel crossjoin(nama tabel,kuncinya)
	public static function crossJoin($table,$on){
		self::$crossJoin[$table] = $on;
		return new static();
	}
	///Definisi tabel limit(batas maksimal yang ditampilkan)
	public static function limit($lim){
		self::$limit = " LIMIT ".$lim;
		return new static();
	}
	public static function groupBy($group){
		self::$grpBy = $group;
		return new static();
	}
	public static function query($query){
		self::$rawQuery= $query;
		return new static();
	}
	///Definisi orderBy(nama kolom, urutkan menaik atau menurun)
	public static function orderBy($orderBy,$sort = "DESC"){
		self::$orderBy=' ORDER BY '.$orderBy.' '.$sort;
		return new static();
	}
	///Definisi tabel select(pilih kolom contoh: ['nama','username'])
	public static function select($arrwhere){
	 
			$params = $arrwhere;
			$col_lst="";
			foreach ($params as $i )
			{
				$col_lst .= $i .",";
			}
			$col = rtrim($col_lst,",");
			self::$select = $col;

			return new static();
	 }
	public static function where($arrwhere){
	 
			$params = $arrwhere;
			$in = "";
			$col_lst="";
			$d=0;
			foreach ($params as $i => $item)
			{
				$d++;
			    $col = $i;
			    $key = ":id_".str_replace(".", "_", $i)."_".$d."_".time();
			    $in .= $key.",";
			    $col_lst .= $col."=".$key." AND ";
			   self::$mergeCol[$key] = $item; 
			   // var_dump(self::$mergeCol);exit();
			 }
			$in = rtrim($in,","); 
			$col = rtrim($col_lst," AND ");
			self::$colval = $col;
			return new static();
	 }

	public static function delete(){
	 	if(self::$table != null){
	 		// $select = self::$select==null?" * ":self::$select;
	 		$sql = "DELETE FROM ".self::$table." WHERE ".self::$colval;
	 		// echo $sql;
			$stm = Conn::connect()->prepare($sql);
			$stm->execute(self::$mergeCol); 
			self::resetVar();

			return new static();
		} else {
			echo "Tabel belum di definisikan";
		}
	 }
	 public static function or_whereLike($arrwhere,$wildcard="after"){//Pilihannya after,before,dan both
	 	
			$params = $arrwhere;
			$in = "";
			$col_lst="";
			$d=0;
			foreach ($params as $i => $item)
			{
				$d++;
			    $col = $i;
			    $key = ":id_".str_replace(".", "_", $i)."_".$d."_".time();
			    $in .= $key.",";
			    if($wildcard=="after"){
			    	$col_lst .= $col."like ".$key."% OR ";
				} else if($wildcard == "before"){
					$col_lst .= $col."like %".$key." OR ";
				} else if($wildcard == "both"){
					$col_lst .= $col."like %".$key."% OR ";
				} 
			    self::$mergeCol[$key] = $item; 
			}
			$in = rtrim($in,","); 
			$col = rtrim($col_lst," OR ");
			// self::$mergeCol = $values;
			self::$colvalOrLike = $col;

			return new static();
	 }
	  public static function whereLike($arrwhere,$wildcard="after"){//Pilihannya after,before,dan both
	 	
			$params = $arrwhere;
			$in = "";
			$col_lst="";
			$d=0;
			foreach ($params as $i => $item)
			{
				$d++;
			    $col = $i;
			    $key = ":id_".str_replace(".", "_", $i)."_".$d."_".time();
			    $in .= $key.",";
			    if($wildcard=="after"){
			    	$col_lst .= $col."like ".$key."% AND ";
				} else if($wildcard == "before"){
					$col_lst .= $col."like %".$key." AND ";
				} else if($wildcard == "both"){
					$col_lst .= $col."like %".$key."% AND ";
				} 
			    self::$mergeCol[$key] = $item; 
			}
			$in = rtrim($in,","); 
			$col = rtrim($col_lst," OR ");
			// self::$mergeCol = $values;
			self::$colvalLike = $col;

			return new static();
	 }
	public static function or_where($arrwhere){
	 	
			$params = $arrwhere;
			$in = "";
			$col_lst="";
			$d=0;
			foreach ($params as $i => $item)
			{
				$d++;
			    $col = $i;
			    $key = ":id_".str_replace(".", "_", $i)."_".$d."_".time();
			    $in .= $key.",";
			    $col_lst .= $col."=".$key." OR ";
			    self::$mergeCol[$key] = $item; 
			}
			$in = rtrim($in,","); 
			$col = rtrim($col_lst," OR ");
			// self::$mergeCol = $values;
			self::$colvalOr = $col;

			return new static();
	 }

	public static function get(){

	 	if(self::$rawQuery == null){///Jika query custom tidak diisi
		 	if(self::$table != null){///cek tabel udah di definisikan atau belum

			 	$sql=self::sql();///Fungsi untuk menggabungkan Script Sqlnya
			 	// echo $sql;
			 	// var_dump(self::$mergeCol);
				$stm = Conn::connect()->prepare($sql);//
				$stm->execute(self::$mergeCol); //Eksekusi SQLnya
				$data = $stm->fetchAll();//Ambil semua data

				self::resetVar();
				return $data;
			} else {
				echo "Tabel belum di definisikan";
			}
		} else{
				$sql = self::$rawQuery;
				$stm = Conn::connect()->prepare($sql);
				$stm->execute(self::$mergeCol); 
				$data = $stm->fetchAll();
				self::resetVar();
				return $data;
			}
	 }

	 public static function first(){

	 	if(self::$rawQuery == null){
		 	if(self::$table != null){
			 	$sql=self::sql();
				$stm = Conn::connect()->prepare($sql);
				$stm->execute(self::$mergeCol); 
				$data = $stm->fetch();//Ambil cuma satu data
				self::resetVar();
				return $data;
			} else {
				echo "Tabel belum di definisikan";
			}
		} else{
				$sql = self::$rawQuery;
				$stm = Conn::connect()->prepare($sql);
				$stm->execute(self::$mergeCol); 
				$data = $stm->fetch();
				self::resetVar();
				
				return $data;
			}
	 }

	public static  function insert($params){
	 	if(self::$table != null){
		 		$p = $params;
				$in = "";
				$col_lst="";

				foreach ($p as $i => $item)
				{

				    $col = $i;
				    $key = ":id_".$i;
				    $in .= $key.",";
				    $col_lst .= $col.",";
				    $values[$key] = $item; 
				}
				$in = rtrim($in,","); 
				$col = rtrim($col_lst,",");
				$InsCol = $col;
				$InsColVal = $in;
				$mergeCol = $values;
				try{
				///////////////////////
		 		$sql = "INSERT INTO ".self::$table."(".$InsCol.") VALUES (".$InsColVal.")";
				$stm = Conn::connect()->prepare($sql);
				$stm->execute($mergeCol); 
				self::resetVar();
				return true;}
			catch(Exception $e){
				echo $e;
				return false;
			}
		} else {
			echo "Tabel belum di definisikan";
			return false;
		}

	 }

	public static function update($params){
	 	if(self::$table != null){
	 		if(self::$colval != null){
		 		$p = $params;
				$in = "";
				$col_lst="";
				$d=0;
				foreach ($p as $i => $item)
				{
					$d++;
				    $col = $i;
				    $key = ":upd_".str_replace(".", "_", $i)."_".$d."_".time();
				    $in .= $col."=".$key.",";
				    $col_lst .= $col.",";
				    self::$mergeCol[$key] = $item; 
				}
				$in = rtrim($in,",");
				$UpdCol = $in;
				
				try{
				///////////////////////
		 		$sql = "UPDATE ".self::$table." SET ".$UpdCol."  WHERE ".self::$colval;

		 		// echo "$sql";
		 		var_dump(self::$mergeCol);
				$stm = Conn::connect()->prepare($sql);
				$stm->execute(self::$mergeCol);
				self::resetVar(); 
				return true;}
				catch(Exception $e){
					echo $e;
					return false;
				}
			} else { echo "WHERE Belum di isi";
					return false;
			}
	 } else{
	 	echo"Tabel belum di definisikan";
	 	return false;
	 }
	}

/////////////PRIVATE METHOD////////////////	

	private static function GabungkanJoin(){
		$InnerJ="";
		$RightJ="";
		$LeftJ="";
		$CrossJ="";
		$final ="";
		foreach (self::$InnerJoin as $key => $val)
			{
				 $InnerJ .= " INNER JOIN ".$key." on ".$val." ";
			}
		foreach (self::$rightJoin as $key => $val)
			{
				 $RightJ .= " RIGHT JOIN ".$key." on ".$val." ";
			}
		foreach (self::$leftJoin as $key => $val)
			{
				 $LeftJ .= " LEFT JOIN ".$key." on ".$val." ";
			}
		foreach (self::$crossJoin as $key => $val)
			{
				 $CrossJ .= " CROSS JOIN ".$key." on ".$val." ";
			}

			$final =  $InnerJ.$RightJ.$LeftJ.$CrossJ;///gabungkan semuanya

			return $final;
	}

	private static function GabungkanGroup(){
		$final="";
		$col_lst="";
		$col="";
		foreach (self::$grpBy as $key)
			{
				$col_lst .= $key.",";
			}
			
			if($col_lst != null || count(self::$grpBy) > 0){
				$col = " GROUP BY ".rtrim($col_lst,",");
			}
			

		return $col;
	}

	private static function sql(){
		$sql="";
		if(self::$colval != null){
			 		$select = self::$select==null?" * ":self::$select;
			 		$sql = "SELECT ".$select." FROM ".self::$table." ".self::GabungkanJoin()." WHERE ".self::$colval." ".self::$orderBy.self::GabungkanGroup().self::$limit;
				} else{
					$select = self::$select==null?" * ":self::$select;
			 		$sql = "SELECT ".$select." FROM ".self::$table." ".self::GabungkanJoin().self::$orderBy.self::GabungkanGroup().self::$limit;

				
			 	}

		return $sql;
	}

	private static function resetVar(){
	///Untuk reset variabel supaya gak bentrok
		self::$orderBy = null;
		self::$grpBy = [];
		self::$table=null;
		self::$colval=null;
		self::$colvalOr=null;
		self::$colvalLike=null;
		self::$colvalOrLike=null;
		self::$colvalNot=null;
		self::$select=null;
		self::$mergeCol=[];
		self::$mergeInsCol=null;
		self::$InsColVal=null;
		self::$InnerJoin=[];
		self::$leftJoin=[];
		self::$rightJoin=[];
		self::$crossJoin=[];
		self::$grpBy=[];
		self::$limit=null;
		self::$orderBy=null;
		self::$rawQuery=null;
	}

 }