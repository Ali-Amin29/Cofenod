<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_node', 'root', '');
$users = DB::getAll('users');
$products = DB::getAll('product');
// var_dump($products[0]['type'])

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


    <div>
        <h2>Choose User</h2>
        <div class="dropdown m-3">
            <input class="dropdown-toggle" type="text" data-bs-toggle="dropdown" value="Choose User" id="input">
            <!-- <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
            <select class="dropdown-menu" id="users">
                <?php foreach ($users as $user) { ?>
                    <option class="dropdown-item" value="<?php echo $user['name']; ?>"><?php echo $user['name']; ?></option>
                <?php  } ?>
            </select>
            <!-- </button> -->
        </div>
    </div>
    <br>
    <br>

    <h1 style="color:#003f63;display: inline-block; ">Our Products</h1>

    <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-drinks-list" data-bs-toggle="list" href="#drinks">Drinks</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#Dessert">Dessert</a>
        <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#Snacks">Snacks</a>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="drinks" role="tabpanel" aria-labelledby="list-home-list">
            <div class="container">
                <div class="row ">
                    <?php foreach ($products as $product) {
                        if ($product['type'] == 'drink') { ?>
                            <div class="col-3 border shadow text-center">
                                <img src="<?php echo $product['image']; ?>" alt="">
                                <h2><?php echo $product['name'] ?></h2>
                                <h2><?php echo $product['type'] ?></h2>
                                <p>Price: <?php echo $product['price'] ?>L.E</p>
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
                            <div class="col-3 border shadow text-center">
                                <img src="<?php echo $product['image']; ?>" alt="">
                                <h2><?php echo $product['name'] ?></h2>
                                <h2><?php echo $product['type'] ?></h2>
                                <p>Price: <?php echo $product['price'] ?>L.E</p>
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
                            <div class="col-3 border shadow text-center">
                                <img src="<?php echo $product['image']; ?>" alt="">
                                <h2><?php echo $product['name'] ?></h2>
                                <h2><?php echo $product['type'] ?></h2>
                                <p>Price: <?php echo $product['price'] ?>L.E</p>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>









    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        var input = document.getElementById('input');
        var select = document.getElementById('users');
        console.log(input.value)
        console.log(select.value)
        select.onchange = function() {
            input.value = select.value
            console.log(input.value)
            console.log(select.value)
        }
    </script>
</body>

</html>