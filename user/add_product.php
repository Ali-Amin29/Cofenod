<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');


session_start();
var_dump($_REQUEST['quantity_'.'16']);
if ($_SESSION['login'] != null) {

    $user_id = $_SESSION['login'];

    $count = count($_SESSION["id"]);
  
    
    $var = FLOOR(RAND() * 401);
    DB::create('orders', ['ID_ORDER' => $var, 'ID_USER' => $user_id]);
    foreach ($_SESSION["id"] as $id) {
        
        DB::create('order_products', ['order_ID' => $var, 'product_ID' => $id, 'amount' => $_REQUEST['quantity_'. $id]]);
        
        unset($_SESSION["id"]);
        header('location: index.php');
    }
}