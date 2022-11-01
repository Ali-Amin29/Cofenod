<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
var_dump($_REQUEST);

$id=$_REQUEST['id'];
echo $id;

DB::delete('products',['products.ID'=>$id]);

header('location:ShowProduct.php');


?>