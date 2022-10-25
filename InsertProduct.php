<?php
require('DB.php');
DB::connect('mysql','localhost','cafe_nod','root','');
if(!empty( $_FILES['pimage'])){
$files = $_FILES['pimage'];
$imgname = $files['name'];
move_uploaded_file($files['tmp_name'],"imgs/$imgname");
var_dump($imgname);
var_dump($_REQUEST);

DB::create('products',['name_prod' => htmlspecialchars($_REQUEST['pname']),'price' => htmlspecialchars($_REQUEST['pprice']),'type' => htmlspecialchars($_REQUEST['ptype']),'image' => $imgname]);
}
header('location:ShowProduct.php');

?>