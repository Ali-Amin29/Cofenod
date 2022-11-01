<?php
session_start();

if (isset($_REQUEST['id_delete'])) {
    $id_delete = $_REQUEST['id_delete'];
    for ($i = 0; $i < count($_SESSION['id']); $i++) {
        if ($_SESSION['id'][$i] == $id_delete) {
            unset($_SESSION['id'][$i]);
        }
    }
}


if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}


if ($_SESSION['id'] == '') {
    unset($_SESSION['id']);
    $_SESSION['id'] =  array();
} 

$_SESSION['id'][] = $id;

header('location: create_order.php');
