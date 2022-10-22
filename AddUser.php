<?php
require('DB.php');
DB::connect('mysql','localhost','cafe_nod','root','');
$files = $_FILES['Image'];
$imgname = $files['name'];
move_uploaded_file($files['tmp_name'] , "imgs/$imgname");
DB::create('users',['name' => $_POST['Username'],'email' => $_POST['Emailaddress'],'room' => $_POST['Room'],'floor' => $_POST['Floor'],'password' => $_POST['Password'],'image' => $imgname]);
header('location:AdminInsertUsers.php');
?>