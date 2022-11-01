<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
var_dump($_REQUEST);

$id=$_REQUEST['id'];
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
DB::update('users',['ID'=>$id],['name'=>$name,'email'=>$email]);

header('location:ShowUsers.php');


?>