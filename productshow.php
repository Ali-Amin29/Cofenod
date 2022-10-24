<?php

require_once './connection.php';

$pname=$_REQUEST['pname'];
$pprice=$_REQUEST['pprice'];
$pimage=$_REQUEST['pimage'];
$pquantity=$_REQUEST['pquantity'];
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
            <td>Product Name</td>
            <td>Product Price</td>
            <td>Product image</td>
            <td>Product Quantity</td>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td><?php echo "$pname"?></td>
            <td><?php echo "$pprice"?></td>
            <td><?php echo "$pimage"?></td>
            <td><?php echo "$pquantity"?></td>
        </tr>
    </tbody>
</table>


</body>
</html>

