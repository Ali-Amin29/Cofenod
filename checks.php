<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_node', 'root', '');
$users = DB::getAll('users');

//selected data
if ($_REQUEST) {
    $from = $_REQUEST['from'];
    $to = $_REQUEST['to'];
    $userid = $_REQUEST['userid'];

    if ($_REQUEST['userid'] != null) {
        $query = "SELECT * FROM `orders` WHERE created_at BETWEEN '$from' AND '$to' AND `user_ID` = $userid ";
        $db = 'mysql:host=localhost;dbname=cafe_node';
        $connect = new PDO($db, 'root', '');
        $sql = $connect->prepare($query);
        $sql->execute();
        $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $query = "SELECT * FROM `orders` WHERE created_at BETWEEN '$from' AND '$to'";
        $db = 'mysql:host=localhost;dbname=cafe_node';
        $connect = new PDO($db, 'root', '');
        $sql = $connect->prepare($query);
        $sql->execute();
        $file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
$orders = $file_content;

//user name
$query =  "SELECT users.name,users.id from orders,users where users.ID=orders.user_ID and orders.created_at BETWEEN '$from' and  '$to'";
$db = 'mysql:host=localhost;dbname=cafe_node';
$connect = new PDO($db, 'root', '');
$sql = $connect->prepare($query);
$sql->execute();
$file_content = $sql->fetchAll(PDO::FETCH_ASSOC);
$usersss = $file_content;

//total price
$totalPrice = DB::join(
    'sum(products.price*order_products.amount) as totalPrice',
    ['products', 'order_products'],
    ['products.ID' => 'order_products.product_ID']
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
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
                <?php if ($orders) { ?>
                    <?php foreach ($orders as $key => $order) { ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1 ?></th>
                            <td><?php echo $order['ID_order'] ?></td>
                            <td><?php echo $order['created_at'] ?></td>

                            <?php if ($usersss) { ?>
                                <?php for ($i = 0; $i < count($usersss); $i++) { ?>
                                    <?php if ($order['user_ID'] == $usersss[$i]['id']) { ?>
                                        <td><?php echo $usersss[$i]['name'] ?></td>
                            <?php break;
                                    }
                                }
                            } ?>

                            <?php
                            $quantity = DB::getReq(['SUM(order_products.amount) as quantity'], 'order_products', 'order_products.order_ID', $order['ID_order']);
                            ?>
                            <td><?php echo $quantity[0]['quantity'] ?></td>

                            <?php
                            $totalPrice = DB::join(
                                'sum(products.price*order_products.amount) as totalPrice',
                                ['products', 'order_products'],
                                ['products.ID' => 'order_products.product_ID', ' order_products.order_ID' => $order['ID_order']]
                            );
                            ?>
                            <td><?php echo $totalPrice[0]['totalPrice'] ?></td>

                        </tr>

                <?php }
                } ?>
            </tbody>
        </table>
    </div>

</body>

</html>