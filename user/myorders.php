<?php
require('myorderdata.php');

//selected data
if (isset($_SESSION['orders'])) {
    $orders = $_SESSION['orders'];
}
date_default_timezone_set("Egypt");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="../user/css/myorders.css">
    <script src="https://kit.fontawesome.com/621136387c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<!-- <nav class="navbar">
    <div class="container">
    <h1 class="logo"><a href="system_login.php" style="color:white ;"><i class="fas fa-mug-hot"></i></a></h1>
      <div class="navbar-menu">
        <a class="small" href="#">home</a>
        <a class="small" href="#">about</a>
        <a class="small" href="#">menu</a>
        <a href="#">sign in</a>
        <a href="#">Login</a>
      </div>
    </div>
  </nav> -->

<body>

    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <h1 class="logo"><a href="index.php" style="color:white ;"><i class="fas fa-mug-hot"></i></a></h1>
            <div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a style="color:wheat;width:100%" class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                </div>
            </div>
        </div>
    </nav>

    <form action="myorderdata.php">
        <div class="container">
            <div class="mb-3 w-25 m-4">
                <label class="form-label" for="date">From:</label>
                <input type="date" class="form-control" style="width: 77%;" id="date" name="from">

                <label class="form-label" for="date">To:</label>
                <input type="date" class="form-control" style="width: 77%;" id="date" name="to">
            </div>
            <button type="submit" class="btn btn-primary m-5">Submit</button>
        </div>
    </form>


    <div class="container" style="width: 77%;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php if (isset($orders)) { ?>
                    <?php foreach ($orders as $key => $order) { ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1 ?></th>
                            <td><?php echo $order['created_at'] ?></td>

                            <?php
                            // كومنت يا عبده
                            $date1 =  explode(" ", $order['created_at']);
                            $date =  explode("pm",  date("H:i:s"));
                            $current_time = new DateTime();
                            $order_date = $date1[0];
                            $time = new DateTime($date1[1]);
                            $interval = $current_time->diff($time);
                            ?><td>
                                <?php
                                if (date("Y-m-d") == $order_date) {
                                    if ($interval->format("%h") <= 2 && $interval->format("%i") < 20) {
                                        $new_time = strtotime("$date1[1], +20 minute");
                                        $new_time = date('H:i:s', $new_time);
                                        echo 'out for deliver';
                                    } else {
                                        echo 'Done';
                                    }
                                }
                                ?>
                            </td>
                            <?php
                            if (date("Y-m-d") == $order_date) {
                                if ($interval->format("%h") <= 2 && $interval->format("%i") < 20) {
                            ?>
                                    <td>
                                        <h5>Expected Arrival Time <?php echo $new_time ?> </h5>
                                    </td>
                            <?php }else{
                                
                            }
                            } ?>
                            <?php
                            $totalPrice = DB::join(
                                'sum(products.price*order_products.amount) as totalPrice',
                                ['products', 'order_products'],
                                ['products.ID' => 'order_products.product_ID', ' order_products.order_ID' => $order['ID_ORDER']]
                            );
                            ?>
                            <td><?php echo $totalPrice[0]['totalPrice'] ?></td>
                            <td> <?php
                                    if (date("Y-m-d") == $order_date) {
                                        if ($interval->format("%h") <= 2 && $interval->format("%i") < 20) {
                                    ?>
                                        <a href="myorderdata.php?id=<?php echo $order['ID_ORDER'] ?>"><button>Cancel</button></a>
                                <?php
                                        }
                                    }
                                ?>
                            </td>

                        </tr>

                    <?php }
                } else {
                    ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>No Orders Available</td>
                    <td></td>



                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>