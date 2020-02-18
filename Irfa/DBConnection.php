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
		    $conn = new PDO("mysql:".$config['DB_host']."=;dbname=".$config['DB_name'], $config['DB_username'], $config['DB_password']);
		    
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