<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$products=DB::getAll('products');
session_start();
$user= DB::getReq(['users'=>'role'],'users','users.ID',$_SESSION['login']);
if($user[0]['role'] != 'admin'){
    header('location: ../../user/index.php'); 
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/621136387c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
    a {
        text-decoration: none;
        color: white;
    }

    body {
        background-image: url("../../user/img/Annotation 2022-10-30 010946.png");
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <h1 class="logo"><a href="system_login.php" style="color:black ;"><i class="fas fa-mug-hot"></i></a></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../user/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../create_order.php">Create Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./AddProduct.php">Add product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./AddUser.php">Add user</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Show
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Cofenod-aliGamal/ShowOrders.php">Show Order</a></li>
                            <li><a class="dropdown-item" href="../Cofenod-aliGamal/ShowProduct.php"> Show Product</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../Cofenod-aliGamal/ShowUsers.php">Show Users</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex search-box" role="search">
                    <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search">
                    <div class="result border shadow"></div>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </div>
    </nav>
    <div class=" text-center mt-5" role="alert">
        <h1> All Having Products </h1>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-light table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ProductID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $key => $product) :?>
                        <tr>
                            <td scope="col"><?php echo $key+1 ?></td>
                            <td scope="col"><?php echo $product['ID'] ?></td>
                            <td scope="col"><?php echo $product['name_prod'] ?></td>
                            <td scope="col"><?php echo $product['price'] ?></td>
                            <td scope="col"><?php echo $product['type'] ?></td>
                            <td scope="col">
                                <button type="button" class="btn btn-success"
                                    onClick="Edit(<?php echo $product['ID'] ?>)">
                                    <a href="./ShowProduct.php?id=<?php echo $product['ID'] ?>">Edit</a></button>
                                <button type="button" class="btn btn-danger">
                                    <a href="./DeleteProduct.php?id=<?php echo $product['ID'] ?>">Delete</a>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>

            </div>

        </div>
        <div class="row text-center">
            <?php
            if(!empty($_REQUEST['id'])) {
                $id=$_REQUEST['id'];
                $product=DB::getOne('products','ID',$id);
                // var_dump($user);
        ?>

            <form method="post" class="mb-3" action="./EditProduct.php" id='EditProduct'>
                <input name='pid' type='hidden' value='<?php echo $product['ID']?>'>
                <input type='text' name='pname' value='<?php echo $product['name_prod']?>'>
                <input name='pprice' type='number' value='<?php echo $product['price']?>'>
                <input name='ptype' type='text' value='<?php echo $product['type']?>'>

                <button type="submit" class="btn btn-success" name="submit" onclick="insert()">
                    Submit
                </button>
            </form>

            <?php
            }
            ?>
        </div>
    </div>

    <script>
    var EditProduct = document.getElementById('EditProduct');

    function Edit() {
        EditProduct.style.display = 'block';
    }

    function insert() {
        EditProduct.style.display = 'none';
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

</body>

</html>