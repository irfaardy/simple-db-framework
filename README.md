
# Simple DB Operation


Basic Usage

    <?php
    use  Classes\Irfa\DBOperation as DB;
    
    $res = DB::table('book')->get();
     foreach ($res as $r):
        echo $r->title."<br>";
      endforeach;

Order by

 

    $res = DB::table('book')->orderBy('author','DESC')->get();
             foreach ($res as $r):
                echo $r->title."<br>";
              endforeach;

  Insert Data
  

      $params = ['title'=>'Lorem', 'author' => 'Ipsum'];
      DB::table('book')->insert($params);
 Update data
 

    $params = ['title'=>'Ipsum', 'author' => 'Lorem'];
    DB::table('tb_stok')
	->where(['book_id' => ABC123])
	->update($params);
<?php
use  Classes\Irfa\DBOperation as DB;

$res = DB::table('book')->get();

 foreach ($res as $r):
    echo $r->title."<br>";
  endforeach;
  
