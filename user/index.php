<?php
session_start();

if ($_SESSION['login']== null){
    header('location: system_login.php'); 
}
error_reporting(E_ALL);
require ('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$users = DB::getAll('users');
$products = DB::getAll('products');
$user= DB::getReq(['users'=>'role'],'users','users.ID',$_SESSION['login']);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="css/ahmed.css">

    <title>Document</title>
    <style>
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
        top: 50px;
        right: 55px;
        width: 400px;
        display: flex;
        flex-wrap: wrap;


    }

    .result img {
        width: 50px;
        height: 50px;
    }

    .result div {
        display: flex;

    }

    .result div h4 {
        padding: 10px
    }

    .result div p {
        padding-top: 15px;
    }

    .result div:hover {
        background: #DDD
    }

    .result div a {
        display: inline-block;
        color: #FFF;
        padding-top: 8px;

    }

    .result div button {
        margin-left: 12px;
        background: green
    }

    /* 
    .result {
        position: absolute;
        z-index: 999;
        top: 100%;
        left: 0;
        
    }

    .search-box input[type="text"],
    .result {
        width: 100%;
        height:150px;
        box-sizing: border-box;
        display:flex;
     }
    /* Formatting result items */
    .result p {



        border-top: none;
    }



    */
    </style>
</head>

<body onload="load()">
    <nav>
        <ul class="logo mt-2 ms-5">
            <li><img src="img/logo-dark.webp" alt=""></li>
        </ul>
        <ul class="nav">
            <li><a href="#Home" id="" class="active">Home </a></li>
            <li><a href="#serv"> serveice </a></li>
            <li><a href="#team"> team </a></li>
            <?php if ($user[0]['role']=='admin'){?>
            <li><a href="../admin/checks.php"> admin </a></li>
            <?php }?>
            <li><a href="myorders.php"> My Orders </a></li>

            <div class="d-flex search-box" id="search_box" role="search">
                <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search"
                    style="height:40px">
                <div class="result border shadow"></div>

                <!-- <button class="btn btn-outline-success" style="" type="submit">Search</button> -->
            </div>
        </ul>
        <ul class="login">

            <?php
            if ($_SESSION) {
                foreach ($users as $user) {
                    if ($_SESSION['login'] == $user['ID']) {
                        $img = $user['image'];

                        echo " 
                              <img src='img/$img'>
                              <a href=controller/logout.php>logout</a>";;
                    }
                }
            } else {
                echo "
                <a style='padding-top: 10px;' href='system_login.php'><i class='fa-solid fa-user'></i> Login</a>
                <a style='padding-top: 10px;'  href='system_login.php'><i class='fa-solid fa-right-to-bracket'></i> Register</a>";
            }

            ?>
        </ul>
    </nav>
    <!-- end nav -->

    <!-- ----------------------------- Start slider ------------------- -->
    <div class="slider" id="Home">
        <div class="active">
            <div class="body animate__animated animate__fadeInLeft">
                <h2>time to discover</h2>
                <h2>coffee house</h2>
                <P>I like my coffee with cream and my literature with optimism.</P>
                <p>Coffee, because adulting is hard..</p>
                <a class="read" href="">service</a>
                <a href="">read more</a>
            </div>
        </div>
    </div>

    <!-- ----------------------------- END slider ------------------- -->
    <!-- ----------------------------- Start SERVICE ------------------- -->

    <!-- categy -->
    <div class="container">
        <div class="row text-center" id="serv">
            <div class="col-9">

                <div class="animate__animated animate__fadeInRight ctegory" id="ctegory">
                    <div class="list-group d-flex flex-row mb-3" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active " id="list-drinks-list"
                            data-bs-toggle="list" href="#drinks" style="width: 14%;">Drinks</a>
                        <a class="list-group-item list-group-item-action " id="list-profile-list" data-bs-toggle="list"
                            href="#Dessert" style="width: 14%;">Dessert</a>
                        <a class="list-group-item list-group-item-action " id="list-messages-list" data-bs-toggle="list"
                            href="#Snacks" style="width: 14%;">Snacks</a>
                    </div>
                </div>
                <!-- finsh -->
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="drinks" role="tabpanel" aria-labelledby="list-home-list">
                        <div class="service" id="about">
                            <?php foreach ($products as $product) {
                            if ($product['type'] == 'drinks') { ?>
                            <div class="padd">
                                <div class="cart">
                                    <img src="../admin/images/<?php echo $product['image']; ?>" class="xx" width="200px"
                                        alt="">
                                    <div class="text">
                                        <h2><?php echo $product['name_prod'] ?></h2>
                                        <h2><i><?php echo $product['price'] ?> LE</i></h2>
                                        <a id="add_to_cart" href="session.php?id=<?php echo $product['ID'] ?>"> add</a>
                                    </div>
                                </div>
                            </div>
                            <?php }
                        } ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Dessert" role="tabpanel" aria-labelledby="list-profile-list">
                        <div class="service" id="about">
                            <?php foreach ($products as $product) {
                            if ($product['type'] == 'dessert') { ?>
                            <div class="padd">
                                <div class="cart">
                                    <div class="ali">
                                        <img src="../admin/images/<?php echo $product['image']; ?>" class="xx"
                                            width="200px" alt="">
                                    </div>
                                    <div class="text">
                                        <h2><?php echo $product['name_prod'] ?></h2>
                                        <h2><i><?php echo $product['price'] ?>LE</i></h2>
                                        <a id="add_to_cart" href="session.php?id=<?php echo $product['ID'] ?>"> add</a>
                                    </div>
                                </div>
                            </div>
                            <?php }
                        } ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Snacks" role="tabpanel" aria-labelledby="list-messages-list">
                        <div class="service" id="about">
                            <?php foreach ($products as $product) {
                            if ($product['type'] == 'snacks') { ?>
                            <div class="padd">
                                <div class="cart">
                                    <div class="ali">
                                        <img src="../admin/images/<?php echo $product['image']; ?>" class="xx"
                                            width="200px" alt="">
                                    </div>
                                    <div class="text">
                                        <h2><?php echo $product['name_prod'] ?></h2>
                                        <h2><i><?php echo $product['price'] ?>LE</i></h2>
                                        <a id="add_to_cart" href="session.php?id=<?php echo $product['ID'] ?>"> add</a>
                                    </div>
                                </div>
                            </div>
                            <?php }
                        } ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ----------------------finsh -->

            <div class="col-3 =" id="left">
                <div id="navbar-example3 " class="">
                    <form action="showproudct.php" method="post" class="text-center bg-light mt-3">
                        <input type="hidden" value="" <?php if (!isset($_SESSION['id'])) { ?>>
                        <div class="m-2 p-2 text-center">
                            <h2>No Orders Yet <i class="fa-solid fa-face-sad-tear"></i></h2>
                        </div>
                        <?php } else { ?>
                        <?php foreach ($products as $product) { ?>
                        <?php foreach ($_SESSION['id'] as $id) { ?>
                        <?php if ($product['ID'] == $id) {  ?>
                        <div class="m-2 p-2 text-center bg-light mt-3">
                            <h2><?php echo $product['name_prod'] ?></h2>
                            <h2><?php echo $product['type'] ?></h2>
                            <p>Price: <?php echo $product['price'] ?>L.E</p>
                            <input type="text" hidden value="<?php echo $product['price'] ?>" id="price">
                            <input class="form-control m-auto totalquantity" style="width:25%" value="1"
                                id="<?php echo $product['price'] ?>" name="quantity_<?php echo $id ?>" type="number">
                            <a href="session.php?id_delete=<?php echo $product['ID'] ?>"><img id="img"
                                    src="../admin/images/delete.png" alt="">
                            </a>
                        </div>

                        <?php
                                }
                            }
                        }
                    }
                    ?>

                        <h2 id="totalprice"></h2>
                        <div class="text-center">
                            <button class="btn btn-success mb-4" id="butt"> Submit Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="our_team text-center" id="team">
        <h2>Our Team</h2>
        <div class="team">
            <div class='team_space'>
                <div class='team_man'>
                    <img src='./img/1666891601our-team-2.jpg' alt=''>
                    <div class='text'>
                        <h2> Abdelrahman</h2>
                        <h4>Chief</h4>
                        <div class='icon'>
                            <i class='fa-brands fa-facebook'></i>
                            <i class='fa-brands fa-facebook-messenger'></i>
                            <i class='fa-brands fa-instagram'></i>
                            <i class='fa-brands fa-twitter'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class='team_space'>
                <div class='team_man'>
                    <img src='./img/our-team-6.jpg' alt=''>
                    <div class='text'>
                        <h2> Amr </h2>
                        <h4>Manager</h4>
                        <div class='icon'>
                            <i class='fa-brands fa-facebook'></i>
                            <i class='fa-brands fa-facebook-messenger'></i>
                            <i class='fa-brands fa-instagram'></i>
                            <i class='fa-brands fa-twitter'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class='team_space'>
                <div class='team_man'>
                    <img src='./img/our-team-4.jpg' alt=''>
                    <div class='text'>
                        <h2> Ali </h2>
                        <h4>Bar Man </h4>
                        <div class='icon'>
                            <i class='fa-brands fa-facebook'></i>
                            <i class='fa-brands fa-facebook-messenger'></i>
                            <i class='fa-brands fa-instagram'></i>
                            <i class='fa-brands fa-twitter'></i>
                        </div>
                    </div>
                </div>
            </div>


    </section>

























    <!-- ----------------------------- END SERVEICE ------------------- -->


    <!-- <div class="cookies2" id="cookies2">

        <div class="text">
            <h2>Cookies</h2>
            <p>By using this website, you automatically accept that we use cookies. What for?</p>
            <button onclick="end()" class="one">accept</button>
            <button onclick="end()"> close</button>
        </div>
    </div> -->
    <!-- ----------------------------- END slider ------------------- -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script>
    var bb = document.getElementById("cookies2");
    var bbv = document.getElementById("ggg");
    var next = document.getElementById("next");
    var back = document.getElementById("back");

    function ahmed() {
        bb.style.display = "block";
        document.body.style.overflow = "hidden";

    }
    setTimeout(ahmed, 5000);

    function end() {
        bb.style.display = "none";
        document.body.style.overflow = "scroll";
    }
    </script>
    <script src="js/jq.js"></script>
    <script src="js/index.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/search.js"></script>
    <script>
    new WOW().init();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"
        integrity="sha512-aUhL2xOCrpLEuGD5f6tgHbLYEXRpYZ8G5yD+WlFrXrPy2IrWBlu6bih5C9H6qGsgqnU6mgx6KtU8TreHpASprw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
    var images = document.getElementById('img');
    var input = document.getElementById('input');
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
    </script>
    <script src="js/jq.js"></script>
    <script src="js/index.js"></script>
</body>

</html>