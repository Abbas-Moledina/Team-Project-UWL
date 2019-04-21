<?php
  $dsn='mysql:host=localhost;dbname=21358000';
  $user='21358000';
  $passwd='21358000';

try{

  $db = new PDO($dsn, $user, $passwd);
}catch (PDOException $e){

$err= $e->getMessage();
include('database_error.php');
exit();
}

?>