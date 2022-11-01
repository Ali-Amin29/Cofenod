<?php

session_start();


require ('../DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');


$x = $_REQUEST;
var_dump($_REQUEST);
$name = $x['name'];
$email = $x['email'];
$password = md5($x['password']);
// var_dump( $password);

$floor = (int)$x['floor'];
$room = (int)$x['room'];
// var_dump( $room);

if (isset($_FILES['photo']))
{
$c = $_FILES['photo'];
$name_img = $c['name'];
$name_img = time() . $name_img;
$tmp = $c['tmp_name'];
move_uploaded_file($tmp, "../img/$name_img");
}
else
{
  $name_img= 'user.png';
}
class systemLogin
{

  public function Register($name, $email, $password, $floor, $room, $name_img)
  {

    $query = "INSERT INTO users (name,email,room,floor,password,image)VALUES('$name','$email',$room,$floor,'$password','$name_img')";
    $connect=DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
    $sql = $connect->prepare($query);
    $sql->execute();
    // $dla = $sql->fetchAll(PDO::FETCH_ASSOC);

    header("Location: ../system_login.php");
  }
}

$x = new systemLogin();
$x->Register($name, $email, $password, $floor, $room, $name_img);