<?php
require_once './connection.php';
require_once './database.php';
$id=$_REQUEST['id'];
echo($id);
$query1="DELETE FROM products WHERE ID = $id";

$sql = $con->prepare($query1);
$sql->execute();
header('Location:database.php');
var_dump($sql);

// var_dump($con);


?>