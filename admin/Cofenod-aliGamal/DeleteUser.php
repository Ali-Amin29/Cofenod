<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
var_dump($_REQUEST);

$id=$_REQUEST['id'];
echo $id;

DB::delete('users',['users.ID'=>$id]);

header('location:ShowUsers.php');


?>