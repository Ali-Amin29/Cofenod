<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_node', 'root', '');
$users = DB::getAll('users');
$products = DB::getAll('products');
session_start();
$orders = DB::getAll('orders');

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
    <style>
        body {
            font-family: Arail, sans-serif;
        }

        /* Formatting search box */
        .search-box {
            width: 300px;
            position: relative;
            display: inline-block;
            font-size: 14px;
        }

        .search-box input[type="text"] {
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }

        .result {
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
            background: white;
        }

        .search-box input[type="text"],
        .result {
            width: 100%;
            box-sizing: border-box;
        }

        /* Formatting result items */
        .result p {
            margin: 0;
            padding: 7px 10px;
            border-top: none;
        }

        .result p:hover {
            /* background: #f2f2f2; */
        }
    </style>
</head>


<body onload="load()">

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
                <div class="d-flex search-box" role="search">
                    <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search">
                    <div class="result border shadow"></div>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-3">
            <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
                <form action="add_product.php" method="post">
                    <?php if ($_SESSION) { ?>
                        <?php foreach ($products as $product) { ?>
                            <?php foreach ($_SESSION["id"] as $id) { ?>
                                <?php if ($product['ID'] == $id) {  ?>
                                    <div class="m-2 p-2 text-center">
                                        <h2><?php echo $product['name_prod'] ?></h2>
                                        <h2><?php echo $product['type'] ?></h2>
                                        <p>Price: <?php echo $product['price'] ?>L.E</p>
                                        <input type="text" hidden value="<?php echo $product['price'] ?>" id="price">
                                        <input class="form-control w-50 totalquantity" value="1" id="<?php echo $product['price'] ?>" name="quantity_<?php echo $id ?>" type="number">
                                        <!-- <a href="add_product.php?id=<?php echo $id ?>"> -->
                                        <a href="session.php?id_delete=<?php echo $product['ID'] ?>"><img id="img" src="images/delete.png" alt="">
                                        </a>
                                    </div>
                        <?php
                                }
                            }
                        }
                    } else { ?>
                        <div class="m-2 p-2 text-center">
                            <h2>No Orders Yet :(</h2>
                        </div>
                    <?php } ?>

                    <h2 id="totalprice"></h2>
                    <div class="text-center">
                        <button class="btn btn-success" id="butt"> Submit Order</button>
                    </div>
                </form>
            </nav>
        </div>


        <div class="col-9">
            <div class="dropdown m-3">
                <h2>Choose User</h2>
                <input class="dropdown-toggle" type="text" hidden data-bs-toggle="dropdown" id="input" placeholder="Choose User">
                <select class="dropdown-menu d-block" id="users">
                    <option value="">Choose User</option>
                    <?php foreach ($users as $user) { ?>
                        <option class="dropdown-item" value="<?php echo $user['ID']; ?>"><?php echo $user['name']; ?></option>
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
                                if ($product['type'] == 'drinks') { ?>
                                    <div class="col-3 m-2 p-2 border shadow text-center">
                                        <img src="images/<?php echo $product['image']; ?>" width="200px" alt="">
                                        <h2><?php echo $product['name_prod'] ?></h2>
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
                                        <h2><?php echo $product['name_prod'] ?></h2>
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
                                        <h2><?php echo $product['name_prod'] ?></h2>
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
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.search-box input[type="search"]').on("keyup input", function() {
                /* Get input value on change */
                var inputVal = $(this).val();

                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("search.php", {
                        term: inputVal
                    }).done(function(data) {
                        resultDropdown.html(data);
                        console.log(resultDropdown);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function() {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
    <script>
        var images = document.getElementById('img');
        var input = document.getElementById('input');
        var select = document.getElementById('users');
        var butt = document.getElementById('butt');
        var totalprice = document.getElementById('totalprice');
        var totalquantity = document.querySelectorAll('.totalquantity');
        var price = document.querySelectorAll('#price');


        const load = function() {
            let sum = 0;
            for (let i = 0; i < totalquantity.length; i++) {
                const arr = [];
                totalprice1 = Number(totalquantity[i].value) * Number(price[i].value)
                arr.push(totalprice1)
                for (let index = 0; index < arr.length; index++) {
                    sum += arr[index];
                }
            }
            if (sum == 0) {} else {
                totalprice.innerHTML = sum;
            }
        }

        for (let j = 0; j < totalquantity.length; j++) {
            totalquantity[j].oninput = function() {
                let sum = 0;
                for (let i = 0; i < totalquantity.length; i++) {
                    const arr = [];
                    totalprice1 = Number(totalquantity[i].value) * Number(price[i].value)
                    arr.push(totalprice1)
                    for (let index = 0; index < arr.length; index++) {
                        sum += arr[index];
                    }
                }
                totalprice.innerHTML = sum;
            }
        }

        select.onchange = function() {
            input.value = select.value
            document.cookie = "user_id=" + input.value
        }
    </script>
</body>

</html>