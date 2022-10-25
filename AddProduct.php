<?php
require('DB.php');
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
<!--  Product Name Product Price  Product Image Product Quantity Product Category-->
<!-- pname  pprice pimage ptype-->

<body>
    <div class="alert alert-primary text-center mt-5" role="alert">
        <h1> Add Products </h1>
    </div>
    <div class="container mt-5">
        <form class="row g-3 needs-validation text-center" enctype="multipart/form-data" method="post"
            action="InsertProduct.php">
            <div class="mb-3 ">
                <label for="validationCustom01" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="validationCustom01" name="pname" required>
            </div>
            <div class="mb-3 ">
                <label for="validationCustom01" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="validationCustom01" name="pprice" required>
            </div>
            <div class="mb-3 ">
                <label for="validationCustom01" class="form-label">Product Category</label>
                <input type="text" class="form-control" id="validationCustom01" name="ptype" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Product Picture</label>
                <input class="form-control" type="file" name="pimage" id="formFile">
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
            </div>
        </form>
    </div>

</body>

</html>