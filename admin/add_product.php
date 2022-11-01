<?php

require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');

session_start();

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    if($_SESSION["id"] !=null){
    $count = count($_SESSION["id"]);
    }
    $var = FLOOR(RAND() * 401);
    DB::create('orders', ['ID_ORDER' => $var, 'ID_user' => $user_id]);
    foreach ($_SESSION["id"] as $id) {
        if($_REQUEST['quantity_' . $id] !=null){
        DB::create('order_products', ['order_ID' => $var, 'product_ID' => $id, 'amount' => $_REQUEST['quantity_' . $id]]);
        }
        session_unset();
        header('location: create_order.php');
    }
}