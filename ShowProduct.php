<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
$products=DB::getAll('products');
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
    <style>
    a {
        text-decoration: none;
        color: white;
    }
    </style>
</head>

<body>
    <div class="alert alert-primary text-center mt-5" role="alert">
        <h1> All Having Products </h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ProductID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $key => $product) :?>
                    <tr>
                        <td scope="col"><?php echo $key+1 ?></td>
                        <td scope="col"><?php echo $product['ID'] ?></td>
                        <td scope="col"><?php echo $product['name_prod'] ?></td>
                        <td scope="col"><?php echo $product['price'] ?></td>
                        <td scope="col"><?php echo $product['type'] ?></td>
                        <td scope="col">
                            <button type="button" class="btn btn-success" onClick="Edit(<?php echo $product['ID'] ?>)">
                                <a href="./ShowProduct.php?id=<?php echo $product['ID'] ?>">Edit</a></button>
                            <button type="button" class="btn btn-danger">
                                <a href="./DeleteUser.php?id=<?php echo $product['ID'] ?>">Delete</a>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if(!empty($_REQUEST['id'])) {
        $id=$_REQUEST['id'];
        $product=DB::getOne('products','ID',$id);
        // var_dump($user);
   ?>
    <div class="container text-center">
        <form method="post" action="./EditProduct.php" id='EditProduct'>
            <input name='pid' type='hidden' value='<?php echo $product['ID']?>'>
            <input type='text' name='pname' value='<?php echo $product['name_prod']?>'>
            <input name='pprice' type='number' value='<?php echo $product['price']?>'>
            <input name='ptype' type='text' value='<?php echo $product['type']?>'>

            <button type="submit" class="btn btn-success" name="submit" onclick="insert()">
                Submit
            </button>
        </form>
    </div>
    <?php
     }
    ?>
    <script>
    var EditProduct = document.getElementById('EditProduct');

    function Edit() {
        EditProduct.style.display = 'block';
    }

    function insert() {
        EditProduct.style.display = 'none';
    }
    </script>
</body>

</html>