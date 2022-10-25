<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$users=DB::getAll('users');
// var_dump($users);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
    a {
        text-decoration: none;
        color: white;
    }
    </style>
</head>

<body>
    <div class="alert alert-primary text-center mt-5" role="alert">
        <h1> All Having Users </h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">UserID</th>
                        <th scope="col">UserName</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user) :?>
                    <tr>
                        <td scope="col"><?php echo $key+1 ?></td>
                        <td scope="col" id="ID32"><?php echo $user['ID'] ?></td>
                        <td scope="col" id="nameProd32"><?php echo $user['name'] ?></td>
                        <td scope="col" id="priceProd32"><?php echo $user['email'] ?></td>
                        <td scope="col">
                            <button type="button" class="btn btn-success" onClick="Edit(<?php echo $user['ID'] ?>)"
                                name="edit">
                                <a href="./ShowUsers.php?id=32">Edit</a></button>
                            <button type="button" class="btn btn-danger">
                                <a href="./DeleteUser.php?id=32">Delete</a>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if(!empty($_REQUEST['id'])) {
        $id=$_REQUEST['id'];
        $user=DB::getOne('users','ID',$id);
        // var_dump($user);
   ?>
    <div class="container text-center">
        <form method="post" action="./EditUser.php" id='EditProduct'>
            <input name='id' type='hidden' value='<?php echo $user['ID']?>'>
            <input type='text' name='name' value='<?php echo $user['name']?>'>
            <input name='email' type='email' value='<?php echo $user['email']?>' required>
            <button type="submit" class="btn btn-success" name="submit" onclick="insert()">
                Submit
            </button>
        </form>
    </div>
    <?php
     }
    ?>
    <script>
    var EditProduct = document.getElementById('EditProduct');

    function Edit() {
        EditProduct.style.display = 'block';
    }

    function insert() {
        EditProduct.style.display = 'none';
    }
    </script>
</body>

</html>