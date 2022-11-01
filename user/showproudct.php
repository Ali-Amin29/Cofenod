<?php
require ('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$products = DB::getAll('products');


session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>seek coding</title>
    <link rel="stylesheet" href="css/showproudct.css">
    <link rel="stylesheet" href="./css/myorders.css">
    <link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/621136387c.js" crossorigin="anonymous"></script>
</head>

<body>



    <!-- <div class="m-2 p-2 text-center">
        <h2><?php echo $product['type'] ?></h2>
        <input type="text" hidden value="<?php echo $product['price'] ?>" id="price">
        <input class="form-control w-50 totalquantity" value="1" id="<?php echo $product['price'] ?>" name="quantity_<?php echo $id ?>" type="number">
        <a href="session.php?id_delete=<?php echo $product['ID'] ?>"><img id="img" src="../admin/images/delete.png" alt="">
        </a>
    </div> -->
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid" style="width: 77%;margin:auto;">
            <h1 class="logo"><a href="index.php" style="color:white ;"><i class="fas fa-mug-hot"></i></a></h1>

        </div>
    </nav>


    <section class="container content-section">
        <h2 class="section-header">CART</h2>
        <div class="cart-row">
            <span class="cart-item cart-header cart-column">ITEM</span>
            <!-- <span class="cart-price cart-header cart-column">PRICE</span> -->
            <!-- <span class="cart-quantity cart-header cart-column">QUANTITY</span> -->
        </div>

        <?php $res=[];   $res2=[];?>
        <form action="add_product.php" method="post">
            <?php foreach ($products as $product) { ?>
            <?php foreach ($_SESSION['id'] as $id) { ?>
            <?php if ($product['ID'] == $id) {  ?>
            <div class="cart-items">
                <h2><?php echo $product['name_prod'] ?></h2>

            </div>
            <div class="cart-quantitys">
                <p>Price: <?php echo $product['price'] ?>L.E</p>
                <p>Amount: <?php echo $_REQUEST['quantity_'.$product['ID']] ?></p>
            </div>
            <?php
            array_push($res,$product['price']*$_REQUEST['quantity_'.$product['ID']]);
            array_push($res2,$_REQUEST['quantity_'.$product['ID']]); 
          for($i=0 ; $i < count($res2) ;$i++)
          {
           ?>
            <input type="hidden" value="<?php echo $res2[$i] ?>" name="quantity_<?php echo $product['ID'] ?>"
                type="number">
            <?php
          }
            }
            }
            }
            ?>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">
                    <?php 
                    $result=0;
                    for($i=0 ; $i < count($res) ;$i++)
                    {
                        $result += $res[$i];
                    }
                    echo $result."LE";
                    ?>
                </span>
            </div>

            <button class="btn btn-primary btn-dark"
                style="color:black;margin-left:45%;padding:15px;background-color: #56CCF2;" type="submit">Pay
                now</button>
        </form>
    </section>
    <script src='js/store.js'></script>
</body>