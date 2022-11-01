<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
// var_dump($_REQUEST);

$pid=$_REQUEST['pid'];
$pname=$_REQUEST['pname'];
$pprice=$_REQUEST['pprice'];
$ptype=$_REQUEST['ptype'];
DB::update('products',['ID'=>$pid],['name_prod'=>$pname,'price'=>$pprice,'type'=>$ptype]);

header('location:ShowProduct.php');


?>