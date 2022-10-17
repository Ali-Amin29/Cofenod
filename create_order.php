<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_node', 'root', '');
$users = DB::getAll('users');
$products = DB::getAll('product');
session_start();


// session_unset(); 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
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
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-3">
            <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
                <?php if ($_SESSION) { ?>
                    <?php foreach ($products as $order) { ?>
                        <?php foreach ($_SESSION["id"] as $id) { ?>
                            <?php if ($order['ID'] == $id) {  ?>
                                <div class="m-2 p-2 text-center">
                                    <h2><?php echo $order['name'] ?></h2>
                                    <h2><?php echo $order['type'] ?></h2>
                                    <p>Price: <?php echo $order['price'] ?>L.E</p>
                                    <input class="form-control w-50" id="<?php echo $id ?>" value="0" name="quantity" type="number">
                                </div>
                <?php }
                        }
                    }
                } ?>
                <div class="text-center">
                    <button class="btn btn-success" id="butt"> Submit Order</button>
                </div>
            </nav>
        </div>


        <div class="col-9">
            <div class="dropdown m-3">
                <h2>Choose User</h2>
                <input class="dropdown-toggle" type="text" data-bs-toggle="dropdown" value="Choose User" id="input">
                <select class="dropdown-menu" id="users">
                    <?php foreach ($users as $user) { ?>
                        <option class="dropdown-item" value="<?php echo $user['name']; ?>"><?php echo $user['name']; ?></option>
                    <?php  } ?>
                </select>
            </div>

            <br>
            <br>

            <h1 style="color:#003f63;display: inline-block; ">Our Products</h1>
            <div class="list-group d-flex flex-row mb-3" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active w-25" id="list-drinks-list" data-bs-toggle="list" href="#drinks">Drinks</a>
                <a class="list-group-item list-group-item-action w-25" id="list-profile-list" data-bs-toggle="list" href="#Dessert">Dessert</a>
                <a class="list-group-item list-group-item-action w-25" id="list-messages-list" data-bs-toggle="list" href="#Snacks">Snacks</a>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="drinks" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="container">
                        <div class="row ">
                            <?php foreach ($products as $product) {
                                if ($product['type'] == 'drink') { ?>
                                    <div class="col-3 m-2 p-2 border shadow text-center">
                                        <img src="images/<?php echo $product['image']; ?>" width="200px" alt="">
                                        <h2><?php echo $product['name'] ?></h2>
                                        <h2><?php echo $product['type'] ?></h2>
                                        <p>Price: <?php echo $product['price'] ?>L.E</p>
                                        <a href="session.php?id=<?php echo $product['ID'] ?>"><button class="btn btn-primary"> Add</button></a>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Dessert" role="tabpanel" aria-labelledby="list-profile-list">
                    <div class="container">
                        <div class="row ">
                            <?php foreach ($products as $product) {
                                if ($product['type'] == 'dessert') { ?>
                                    <div class="col-3 m-2 p-2 border shadow text-center">
                                        <img src="images/<?php echo $product['image']; ?>" width="200px" alt="">
                                        <h2><?php echo $product['name'] ?></h2>
                                        <h2><?php echo $product['type'] ?></h2>
                                        <p>Price: <?php echo $product['price'] ?>L.E</p>
                                        <a href="session.php?id=<?php echo $product['ID'] ?>"><button class="btn btn-primary"> Add</button></a>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Snacks" role="tabpanel" aria-labelledby="list-messages-list">
                    <div class="container">
                        <div class="row ">
                            <?php foreach ($products as $product) {
                                if ($product['type'] == 'snacks') { ?>
                                    <div class="col-3 m-2 p-2 border shadow text-center">
                                        <img src="images/<?php echo $product['image']; ?>" width="200px" alt="">
                                        <h2><?php echo $product['name'] ?></h2>
                                        <h2><?php echo $product['type'] ?></h2>
                                        <p>Price: <?php echo $product['price'] ?>L.E</p>
                                        <a href="session.php?id=<?php echo $product['ID'] ?>"><button class="btn btn-primary"> Add</button></a>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        var input = document.getElementById('input');
        var select = document.getElementById('users');
        var butt = document.getElementById('butt');

        select.onchange = function() {
            input.value = select.value;
        }


        <?php foreach ($_SESSION["id"] as $id) { ?>
            var a<?php echo $id ?> = document.getElementById(<?php echo $id ?>);
            console.log(a<?php echo $id ?>.value)

        <?php } ?>
        butt.onclick = function() {
            <?php foreach ($_SESSION["id"] as $id) { ?>
                console.log(a<?php echo $id ?>.value)
            <?php } ?>
        }
    </script>
</body>

</html>