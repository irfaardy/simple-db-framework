<?php 
require 'Autoloader.php';
use Irfa\DBOperation as DB;

 $res = DB::table('book')->get();
     foreach ($res as $r):
        echo $r['title']."<br>";
      endforeach;