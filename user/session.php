<?php
session_start();

if ($_REQUEST['id_delete'] != null) {
$id_delete = $_REQUEST['id_delete'];
}

if ($_REQUEST['id'] != null) {
    $id = $_REQUEST['id'];
}


if ($_SESSION['id'] == null) {
    $_SESSION['id'] =  array();
} else {
    for ($i = 0; $i < count($_SESSION['id']); $i++) {
        if ($_SESSION['id'][$i] == $id_delete) {
            unset($_SESSION['id'][$i]);
        }
    }
}

$_SESSION['id'][] = $id;
// array_push($_SESSION['id'], $id);

// session_unset(); 
header('location: index.php');