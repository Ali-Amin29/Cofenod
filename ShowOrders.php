<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$users=DB::join('orders.ID_order,users.ID,users.name',['orders','users'],['users.ID'=>'orders.user_ID']);      
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

$products=DB::join('orders.ID_order,products.name_prod,orders.user_ID,order_products.amount,products.price',['orders','products','order_products'],['orders.ID_order'=>'order_products.order_ID','products.ID'=>'order_products.product_ID','order_products.order_ID'=>$order]); 

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

</head>

<body>
    <div class="container">
        <div class="row">
            <?php foreach ($users as  $value): ?>
            <div class="col-md-6">
                <ul>
                    <li><?php echo $value['ID_order']?></li>
                    <li><?php echo $value['name']?></li>
                </ul>
                <form method="get" action="<?php $_SERVER['PHP_SELF']?>">
                    <input type="hidden" name="user_id" value="<?php echo $value['ID']?>">
                    <input type="hidden" name="order_id" value="<?php echo $value['ID_order']?>">
                    <button class='selectProducts' name="submit" data-product-id="<?php echo $value['ID_order']?>">Show
                        more</button>
                </form>
            </div>

            <?php endforeach; ?>
        </div>

        <?php foreach ($products as  $value): ?>
        <div id=" content" style='background-color:aqua;'>


            <ul>
                <li><?php echo $value['name_prod']."/";echo $value['amount']."/"; echo $value['price']."/"; echo $value['amount']*$value['price']?>
                </li>
            </ul>

        </div>
        <?php endforeach; ?>
        <?php if ($quantity[0]['quantity'] != "") {
            ?>
        <li style='background-color:aqua;'><?php echo $quantity[0]['quantity']."/".$totalPrice[0]['totalPrice']?></li>
        <?php
        }
           ?>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="./add_prod.js"></script>
</body>

</html>