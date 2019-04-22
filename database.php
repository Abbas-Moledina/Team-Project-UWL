<?php
  $dsn='mysql:host=localhost;dbname=21358000';
  $user='root';
  $passwd='';

try{

  $db = new PDO($dsn, $user, $passwd);
}catch (PDOException $e){

$err= $e->getMessage();
include('database_error.php');
exit();
}

?>