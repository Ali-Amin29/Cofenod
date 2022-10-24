<?php

require_once './connection.php';

// $db ='mysql:host=localhost;dbname=cafe_nod';
// $con=new PDO($db,'root','');
$query='SELECT * FROM products';
$sql=$con->prepare($query);
$result =$sql->execute();
$products =$sql->fetchAll(PDO::FETCH_ASSOC);
// var_dump($con);
// var_dump( $products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table>
        <thead>
            <tr>
                <td>Product ID</td>
                <td>Product Name</td>
                <td>Product Price</td>
                <td>Product Image</td>
                <td>Product Action</td>
                <td>Type</td>
            </tr>
        </thead>
        <tbody>
            
            <!-- DELETE FROM table_name WHERE condition; -->

            <?php foreach ($products as $product) :?>
                <?php
            
            ?>
        <tr>
                <td><?php echo $product['ID']?></td>
                <td><?php echo $product['name_prod']?></td>
                <td><?php echo $product['price']?></td>
                <td><?php echo $product['image']?></td>
                <td><?php echo $product['action']?></td>
                <td><?php echo $product['type']?></td> 
                <td><a href="./delete.php?id=<?php echo $product['ID']?>">Delete</a></td> 
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
</body>
</html>