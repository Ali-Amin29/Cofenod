<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$users = DB::getAll('users');
//selected data
session_start();
$user= DB::getReq(['users'=>'role'],'users','users.ID',$_SESSION['login']);
if($user[0]['role'] != 'admin'){
    header('location: ../user/index.php'); 
}
if (isset($_REQUEST['from'])) {
    $from = $_REQUEST['from'];
    $to = $_REQUEST['to'];
    $userid = $_REQUEST['userid'];

    if ($_REQUEST['userid'] != null && $from !='' ) {
      
        $query = "SELECT * FROM `orders` WHERE created_at BETWEEN '$from' AND '$to' AND `ID_USER`= $userid ";
        $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
        $sql = $connect->prepare($query);
        $sql->execute();
        $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    } elseif($_REQUEST['userid'] == null){
      
        $query = "SELECT * FROM `orders` WHERE created_at BETWEEN '$from' AND '$to'";
        $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
        $sql = $connect->prepare($query);
        $sql->execute();
        $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif ($from==''&& $to=='')
    {
        $int = (int)$userid;
        $query = "SELECT * FROM `orders` WHERE `ID_USER`= $int";
        $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
        $sql = $connect->prepare($query);
        $sql->execute();
        $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    } 

    $orders = $file_content;

    //user name
    if ($from==''&& $to==''){
        $query =  "SELECT users.name,users.id from orders,users where users.ID=orders.ID_user";
        $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
        $sql = $connect->prepare($query);
        $sql->execute();
        $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
        $usersss = $file_content;
    }else{
        $query =  "SELECT users.name,users.id from orders,users where users.ID=orders.ID_user and orders.created_at BETWEEN '$from' and  '$to'";
    $connect = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
    $sql = $connect->prepare($query);
    $sql->execute();
    $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    $usersss = $file_content;
    }
    //total price
    $totalPrice = DB::join(
        'sum(products.price*order_products.amount) as totalPrice',
        ['products', 'order_products'],
        ['products.ID' => 'order_products.product_ID']
    );
}
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

    <!-- <link rel="stylesheet" href="../user/img/Annotation 2022-10-30 010946.png"> -->
    <style>
    body {

        background-image: url("../user/img/Annotation 2022-10-30 010946.png");
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
                        <a class="nav-link active" aria-current="page" href="../user/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Cofenod-aliGamal/AddProduct.php">Add product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Cofenod-aliGamal/AddUser.php">Add user</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Show
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./Cofenod-aliGamal/ShowOrders.php">Show Order</a></li>
                            <li><a class="dropdown-item" href="./Cofenod-aliGamal/ShowProduct.php"> Show Product</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./Cofenod-aliGamal/ShowUsers.php">Show Users</a></li>
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

    <form action="checks.php">
        <div class="mb-3 w-25 m-4">
            <label class="form-label" for="date">From:</label>
            <input type="date" class="form-control" id="date" name="from">

            <label class="form-label" for="date">To:</label>
            <input type="date" class="form-control" id="date" name="to">
        </div>
        <div class="dropdown m-3">
            <h2>Choose User</h2>
            <select name="userid" class="dropdown-menu d-block" id="users">
                <option value="">Choose User</option>
                <?php foreach ($users as $user) { ?>
                <option class="dropdown-item" value="<?php echo $user['ID']; ?>"><?php echo $user['name']; ?></option>
                <?php  } ?>
            </select>
        </div>


        <button type="submit" class="btn btn-primary m-5">Submit</button>
    </form>


    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>

                <?php if (isset($orders)) { ?>
                <?php foreach ($orders as $key => $order) { ?>
                <tr>
                    <th scope="row"><?php echo $key + 1 ?></th>
                    <td><?php echo $order['ID_ORDER'] ?></td>
                    <td><?php echo $order['created_at'] ?></td>

                    <?php if ($usersss) { ?>
                    <?php for ($i = 0; $i < count($usersss); $i++) { ?>
                    <?php if ($order['ID_USER'] == $usersss[$i]['id']) { ?>
                    <td><?php echo $usersss[$i]['name'] ?></td>
                    <?php break;
                                    }
                                }
                            } ?>

                    <?php
                            $quantity = DB::getReq(['SUM(order_products.amount) as quantity'], 'order_products', 'order_products.order_ID', $order['ID_ORDER']);
                            ?>
                    <td><?php echo $quantity[0]['quantity'] ?></td>

                    <?php
                            $totalPrice = DB::join(
                                'sum(products.price*order_products.amount) as totalPrice',
                                ['products', 'order_products'],
                                ['products.ID' => 'order_products.product_ID', ' order_products.order_ID' => $order['ID_ORDER']]
                            );
                            ?>
                    <td><?php echo $totalPrice[0]['totalPrice'] ?></td>

                </tr>

                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

</body>

</html>