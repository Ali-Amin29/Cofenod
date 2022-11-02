<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
session_start();
$user= DB::getReq(['users'=>'role'],'users','users.ID',$_SESSION['login']);
if($user[0]['role'] != 'admin'){
    header('location: ../../user/index.php'); 
}
$users=DB::join2('orders.ID_order,users.ID,users.name',['orders','users'],['users.ID'=>'orders.ID_user']);  
if(isset($_REQUEST['submit']))
{
    $id=$_REQUEST['user_id'];
    $order=$_REQUEST['order_id'];
    // echo $order;
    // echo $id;
}
else{
    $order=0;
}


$quantity=DB::getReq(['SUM(order_products.amount) as quantity'],'order_products','order_products.order_ID',$order);
// echo $quantity[0]['quantity'];
$totalPrice=DB::join('sum(products.price*order_products.amount) as totalPrice',['products','order_products'],['products.ID'=>'order_products.product_ID','order_products.order_ID'=>$order]); 
// echo $totalPrice[0]['totalPrice'];

$products=DB::join('orders.ID_order,products.name_prod,orders.ID_user,order_products.amount,products.price,products.image',['orders','products','order_products'],['orders.ID_order'=>'order_products.order_ID','products.ID'=>'order_products.product_ID','order_products.order_ID'=>$order]); 

// var_dump($products);     

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/621136387c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
    body {
        background-image: url("../../user/img/Annotation 2022-10-30 010946.png");
        background-repeat: no-repeat;
        background-size: cover;
    }

    .cart {
        width: 100%;
        border: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .cart img {
        width: 100%;
        height: 220px;
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
        <h1> All Having Orders </h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <table class="table table-light table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">OrderID</th>
                        <th scope="col">Name</th>
                        <th scope="col">MoreDetails</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $value): ?>
                    <tr>
                        <th scope="row"><?php echo $key+1?></th>
                        <td><?php echo $value['ID_order']?></td>
                        <td><?php echo $value['name']?></td>
                        <td>
                            <form method="get" action="<?php $_SERVER['PHP_SELF']?>">
                                <input type="hidden" name="user_id" value="<?php echo $value['ID']?>">
                                <input type="hidden" name="order_id" value="<?php echo $value['ID_order']?>">
                                <button class='selectProducts btn btn-success' name="submit"
                                    data-product-id="<?php echo $value['ID_order']?>">Show
                                    more</button>
                            </form>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- show details of orders -->



    <div class="container text-center">
        <div class="row ">
            <?php foreach ($products as  $value): ?>

            <div class="card me-2 cart" style="width: 18rem;">
                <img src="./../images/<?php echo $value['image'];?>" class="card-img-top xx" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $value['name_prod'];?></h5>
                    <p class="card-text"><?php echo "Quantity: ".$value['amount']; echo "</br>".$value['price']."LE";?>
                    </p>
                    <a href="#" class="btn btn-success"><?php echo $value['amount']*$value['price']?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- show details of order  -->
    <?php if ($quantity[0]['quantity'] != "") {
            ?>
    <div class="alert alert-success text-center" role="alert">
        <?php echo "TotalQuantity: ".$quantity[0]['quantity']."</br>"."TotalPrice: ".$totalPrice[0]['totalPrice']." LE"?>
    </div>
    <?php
        }
           ?>



    <script src="./add_prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

</body>

</html>