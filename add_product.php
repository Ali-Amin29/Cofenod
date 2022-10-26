<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_node', 'root', '');

session_start();

if ($_COOKIE != null) {
    $user_id = $_COOKIE['user_id'];
    $count = count($_SESSION["id"]);

    $var = FLOOR(RAND() * 401);
    DB::create('orders', ['ID_ORDER' => $var, 'user_ID' => $user_id]);
    foreach ($_SESSION["id"] as $id) {
        DB::create('order_products', ['order_ID' => $var, 'product_ID' => $id, 'amount' => $_REQUEST['quantity_' . $id]]);
        session_unset();
        header('location: create_order.php');
    }
}
