# Simple DB Operation Framework with PHP

**Configuration**

Config file :  Irfa/config/database.php

```php
<?php
$config = [
    'DB_host' => 'localhost',
    'DB_name' => 'database_name',
    'DB_username' => 'yourusername',
    'DB_password' => 'yourpassword',
    'DB_port' => '3306',
    'DB_driver' => 'mysql',
   ];
```

**<h2>Basic Usage</h2>**
**Fetch all rows**


```php
  <?php
    require 'Autoloader.php';
    use Irfa\DBOperation as DB;
    
    $res = DB::table('book')->get();
     foreach ($res as $r):
        echo $r['title']."<br>";
      endforeach;
```

**Fetch Single row**

 

```php
  $data= DB::table('book')
    	->where(['book_id' => 'ABC123'])
    	->first();
    	
    	echo $data['title'];
```

**Select specific column**

```php
  $data= DB::table('book')
        ->select(['book_id','title','synopsis'])
    	->where(['book_id' => 'ABC123'])
    	->first();
    	
    	echo $r['book_id'].' '.$data['title'].' '.$r['author'];
```

**Order by**

 

```php
$res = DB::table('book')->orderBy('author','DESC')->get();
         foreach ($res as $r):
            echo $r['title']."<br>";
          endforeach;
```

  **Insert Data**


```php
  $params = ['title'=>'Lorem', 'author' => 'Ipsum'];
  DB::table('book')->insert($params);
```

 **Update data**


```php
$params = ['title'=>'Ipsum', 'author' => 'Lorem'];
DB::table('book')
->where(['book_id' => 'ABC123'])
->update($params);
```

**Delete data**

```php
DB::table('book')
	->where(['book_id' => 'ABC123'])
	->delete();
```

