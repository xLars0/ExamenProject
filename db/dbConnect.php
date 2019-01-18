<?php
$host='localhost'; // Host Name.
$db_user= 'root'; // User Name
$db_password= ''; // Password
$db= 'projectlist'; // Database Name.

$dbh = new PDO("mysql:host={$host};dbname={$db};charset=utf8", $db_user, $db_password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	//In functie
?>
