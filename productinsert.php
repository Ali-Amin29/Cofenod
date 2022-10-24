
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>hi from html</h2>
    <form action="productshow.php" method="post">
        <table>
            <tr>
                <td><label for="pname">Product Name</label></td>
                <td><input type="text" name="pname"></td><br></tr>
            <tr>    <td><label for="pprice">Product Price</label></td>
                <td><input type="text" name="pprice"></td><br></tr>
            <tr>    <td><label for="pimage">Product Image</label></td>
                <td><input type="file" name="pimage"></td><br></tr>
            <tr>    <td><label for="pquantity">Product Quantity</label></td>
                <td><input type="number" name="pquantity"></td><br></tr>
            <tr>    <td><input type="submit"></td></tr>

            
        </table>
    </form>
    
</body>
</html>