<?php
require('DB.php');
DB::connect('mysql','localhost','cafe_nod','root','');
$files = $_FILES['pimage'];
$imgname = $files['name'];
move_uploaded_file($files['tmp_name'],"imgs/$imgname");
var_dump($imgname);
var_dump($_REQUEST);