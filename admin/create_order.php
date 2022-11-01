<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$users = DB::getAll('users');
// var_dump($users);
$products = DB::getAll('products');
session_start();
$orders = DB::getAll('orders');

$user= DB::getReq(['users'=>'role'],'users','users.ID',$_SESSION['login']);
if($user[0]['role'] != 'admin'){
    header('location: ../user/index.php');  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/621136387c.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./create.css">
    <style>
    .list-group-item.active {

        color: black !important;
        background-color: #198754 !important;
        border-color: #198754 !important;
    }

    .list-group-item+.list-group-item.active {
        margin-top: calc(20 * var(--bs-list-group-border-width)) !important;

    }
    </style>
</head>


<body onload="load()">

    <nav class="navbar navbar-expand-lg " style="background-color: rgb(230, 230, 230)">
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
                        <a class="nav-link" href="./create_order.php">Create Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Cofenod-aliGamal/AddUser.php">Add product</a>
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
                            <li><a class="dropdown-item" href="./checks.php">Checks</a></li>
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

    <div class="row">
        <div class="col-3">
            <div id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
                <form action="add_product.php" method="post">
                    <?php if ($_SESSION) { ?>
                    <?php foreach ($products as $product) { ?>
                    <?php if(isset($_SESSION['id'])){ ?>
                    <?php foreach ($_SESSION["id"] as $id) { ?>
                    <?php if ($product['ID'] == $id) {  ?>
                    <div class="m-2 p-2 text-center">
                        <h2><?php echo $product['name_prod'] ?></h2>
                        <h2><?php echo $product['type'] ?></h2>
                        <p>Price: <?php echo $product['price'] ?>L.E</p>
                        <input type="text" hidden value="<?php echo $product['price'] ?>" id="price">
                        <input class="form-control w-50 totalquantity" value="1" id="<?php echo $product['price'] ?>"
                            name="quantity_<?php echo $id ?>" type="number">
                        <a href="session.php?id_delete=<?php echo $product['ID'] ?>"><img src="images/delete.png"
                                id="delete" width="80px" alt="">
                        </a>
                    </div>
                    <?php
                                }}
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
            </div>
        </div>


        <div class="col-9">
            <div class="dropdown m-3">
                <h2>Choose User</h2>
                <input class="dropdown-toggle" type="text" hidden data-bs-toggle="dropdown" id="input"
                    placeholder="Choose User">
                <select class="dropdown-menu d-block" id="users">
                    <option value="">Choose User</option>
                    <?php foreach ($users as $user) { ?>
                    <option class="dropdown-item" value="<?php echo $user['ID']; ?>"><?php echo $user['name']; ?>
                    </option>
                    <?php  } ?>
                </select>
            </div>

            <br>
            <br>

            <h1 style="color:black;display: inline-block; ">Our Products</h1>
            <div class="list-group d-flex flex-row mb-3" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active " id="list-drinks-list" data-bs-toggle="list"
                    href="#drinks">Drinks</a>
                <a class="list-group-item list-group-item-action " id="list-profile-list" data-bs-toggle="list"
                    href="#Dessert">Dessert</a>
                <a class="list-group-item list-group-item-action " id="list-messages-list" data-bs-toggle="list"
                    href="#Snacks">Snacks</a>
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
                                <a href="session.php?id=<?php echo $product['ID'] ?>"><button class="btn btn-success">
                                        Add</button></a>
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
                                <a href="session.php?id=<?php echo $product['ID'] ?>"><button class="btn btn-success">
                                        Add</button></a>
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
                                <a href="session.php?id=<?php echo $product['ID'] ?>"><button class="btn btn-primary">
                                        Add</button></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
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