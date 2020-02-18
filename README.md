# Simple DB Operation


Usage

    <?php
    use  Classes\Irfa\DBOperation as DB;
    
    $res = DB::table('book')->get();
     foreach ($res as $r):
        echo $r->title."<br>";
      endforeach;
	
Fetch Single row

 

      $data= DB::table('book')
        	->where(['book_id' => ABC123])
        	->first();
        	
        	echo $data['title'];
Select Field

      $data= DB::table('book')
	        ->select(['book_id','title','synopsis'])
        	->where(['book_id' => ABC123])
        	->first();
        	
        	echo $data['title'];
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
    DB::table('book')
	->where(['book_id' => ABC123])
	->update($params);
	
Delete data

    DB::table('book')
    	->where(['book_id' => ABC123])
    	->delete();

