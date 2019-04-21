<?php
include('database.php');
function add_user($uname, $passwd) {
    global $db;
    $password = sha1($uname . $passwd);
    $query = 'INSERT INTO Users (username,
    password)
              VALUES (:uname, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':uname', $uname);
    $statement->bindValue(':password', $password);
    $outcome = $statement->execute();
    $statement->closeCursor();
	return $outcome;
}
$uname = filter_input(INPUT_POST, 'uname');
$password = filter_input(INPUT_POST, 'passwd');
if ((add_user($uname, $password)) == TRUE)
	{
	header('Location: ../index.php');
	//exit();
	}
?>

