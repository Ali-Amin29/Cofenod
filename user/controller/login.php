<?php
require ('../DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$x = $_REQUEST;

$email = $x['email'];
$password = md5($x['password']);

class loginSystem
{

    public function login($email, $password)
    {
        $query = "SELECT * from users where email='$email' AND password='$password'";
        $connect =DB::connect('mysql', 'localhost', 'cafe_node', 'root', '');
        $sql = $connect->prepare($query);
        $sql->execute();
        $dla = $sql->fetchAll(PDO::FETCH_ASSOC);
        $num_row = count($dla);
        $user_id = $dla[0]['ID'];

        session_start();
        if ($num_row > 0) {
            $_SESSION['login'] = $user_id;
           
            header("Location:../index.php");
        } else {
            header("Location:../system_login.php");
        }
    }
}



$login = new loginSystem();
$login->login($email, $password);