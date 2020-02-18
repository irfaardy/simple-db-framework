<?php
/* DB Connection
Author:Irfa Ardiansyah <irfaardiansyah95@gmail.com>
*/
 namespace Irfa;
 use PDO;
 class DBConnection {
 
	protected static $conn;

 	protected function connect(){
 		try {
 			include "config/database.php";
		    if($config['DB_driver'] == 'mysql'){
		    	$conn = new PDO("mysql:".$config['DB_host']."=;dbname=".$config['DB_name'], $config['DB_username'], $config['DB_password']);
		    } elseif($config['DB_driver'] == 'pgsql'){
			$conn = new PDO("pgsql:dbname=".$config['DB_name'].";host=".$config['DB_host'], $config['DB_username'],  $config['DB_password']); 
			} else{
				echo "<title>Driver not Supported</title>
		    	<b>not support driver ".$config['DB_host']." </b>";
		    	exit();
			}

		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    self::$conn = $conn;
		    return $conn;
		    }
		catch(PDOException $e)
		    {

		    	echo "<title>Exception</title>
		    	<b>Connection failed:</b> " . $e->getMessage();
		    	exit();
		    }

 	}

 }