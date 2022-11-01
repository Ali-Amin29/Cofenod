<?php
require ('../DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');


class loginSystem 
{
    public function logout()
    {
        session_start();
        session_unset();
        header("Location:../index.php");
    }
}
$c = new loginSystem();
$c->logout();