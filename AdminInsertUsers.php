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

<body>

    <form class="row g-3 needs-validation text-center" enctype="multipart/form-data" method="post" name='AddUser'
        id='addUserForm' action="adduser.php">
        <div class="mb-3 ">
            <label for="validationCustom01" class="form-label">Username</label>
            <input type="text" class="form-control" id="validationCustom01" onkeyup="UserAdd()" name="Username"
                required>
            <div class="valid-feedback">
                Right Name!
            </div>
            <div class="invalid-feedback">
                Please provide a valid Name.
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="Emailaddress" required>
            <div class="valid-feedback">
                Right Email!
            </div>
            <div class="invalid-feedback">
                Please provide a valid Email.
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword0" class="form-label">Password</label>
            <input type="password" class="form-control" name="Password" id="exampleInputPassword0" required>
            <div class="valid-feedback">
                Accepted!
            </div>
            <div class="invalid-feedback">
                please at least password contain 8 characters.
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="ConfirmPassword" id="exampleInputPassword1" required>
            <div class="valid-feedback">
                Accepted!
            </div>
            <div class="invalid-feedback">
                Password Not Matching .
            </div>
        </div>

        <div class="col-md-6">
            <label for="validationCustom04" class="form-label">Floor</label>
            <select class="form-select" id="validationCustom04" name="Floor">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                <option value="4">four</option>
            </select>
            <div class="valid-feedback" id="FloorDetails">
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationCustom05" class="form-label">room</label>
            <input type="number" class="form-control" name="Room" id="validationCustom05">
            <div class="invalid-feedback">
                please Enter your Room Number.
            </div>
            <div class="valid-feedback" id="RoomDetails">
            </div>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Profile Picture</label>
            <input class="form-control" type="file" name="Image" id="formFile">
            <div class="invalid-feedback">
                Please Enter User Image.
            </div>
            <div class="valid-feedback">
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
        </div>
    </form>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>