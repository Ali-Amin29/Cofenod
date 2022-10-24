<?php
require('DB.php');
DB::connect('mysql','localhost','cafe_nod','root','');
$files = $_FILES['Image'];
$imgname = $files['name'];
move_uploaded_file($files['tmp_name'],"imgs/$imgname");
if(!empty($_POST['Username']) && preg_match("/^[a-zA-Z ]*$/",$_POST['Username'])){
    if(filter_var($_POST['Emailaddress'], FILTER_VALIDATE_EMAIL)){
        if(!empty($_POST['Password'])){
            if(!empty($_POST['ConfirmPassword']) && $_POST['ConfirmPassword']==$_POST['Password']){
                if(!empty($_FILES['Image'])){
                    DB::create('users',['name' => htmlspecialchars($_POST['Username']),'email' => htmlspecialchars($_POST['Emailaddress']),'room' => htmlspecialchars($_POST['Room']),'floor' => htmlspecialchars($_POST['Floor']),'password' => htmlspecialchars(md5($_POST['Password'])),'image' => $imgname]);
                }
                else{
                     echo "Pics";
                    header('location:AdminInsertUsers.php');


                }
            }
            else{
                echo "password not equiv";
                header('location:AdminInsertUsers.php');

            }
        }
        else{
            echo "enter password";
            header('location:AdminInsertUsers.php');

        }
    }
    else{
        echo "enter email";
        header('location:AdminInsertUsers.php');
    }
}
else{
    echo "enter name";
    header('location:AdminInsertUsers.php');
}
// header('location:AdminInsertUsers.php');
?>