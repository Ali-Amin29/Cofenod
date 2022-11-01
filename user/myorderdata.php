<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
session_start();


if (isset($_REQUEST['id'])) {
    $cancel = $_REQUEST['id'];
    DB::delete('orders', $cancel);
    $userid = $_SESSION['login'];
    $query = "SELECT * FROM `orders` WHERE  `ID_USER` = $userid ";
    $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
    $sql = $connect->prepare($query);
    $sql->execute();
    $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['orders'] = $file_content;
    header('location: myorders.php'); 
}


if (isset($_REQUEST['from'])) {
    $from = $_REQUEST['from'];
    $to = $_REQUEST['to'];
    $userid = $_SESSION['login'];
    $query = "SELECT * FROM `orders` WHERE created_at BETWEEN '$from' AND '$to' AND `ID_USER` = $userid ";
    $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
    $sql = $connect->prepare($query);
    $sql->execute();
    $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['orders'] = $file_content;
    //user name
    $query =  "SELECT users.name,users.id from orders,users where users.ID=orders.ID_USER and orders.created_at BETWEEN '$from' and  '$to'";
    $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
    $sql = $connect->prepare($query);
    $sql->execute();
    $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    $usersss = $file_content;
    //total price
    $totalPrice = DB::join(
        'sum(products.price*order_products.amount) as totalPrice',
        ['products', 'order_products'],
        ['products.ID' => 'order_products.product_ID']
    );
    header('location: myorders.php');
}