<?php
session_start();

if ($_SESSION['id'] == null) {
    $_SESSION['id'] = array();
}

$id = $_REQUEST['id'];
// array_push($_SESSION['id'], $id);
$_SESSION['id'][] = $id;

// session_unset(); 
header('location: create_order.php');


