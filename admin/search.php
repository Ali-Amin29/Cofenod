<?php
require('DB.php');
DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
try {
    $pdo = DB::connect('mysql', 'localhost', 'cafe_nod', 'root', '');
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
try {
    if (isset($_REQUEST['term'])) {
        $sql = "SELECT * FROM products WHERE name_prod LIKE :term";
        $stmt = $pdo->prepare($sql);
        $term = $_REQUEST['term'] . '%';
        $stmt->bindParam(':term', $term);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                echo
                "<div style=text-align:center;margin:25px>" .
                    "<img src=../admin/images/" . $row['image'] . " width=100px style=border-radius:100% ></img>" .
                    "<h4> Name: " . $row['name_prod'] . "</h4>" .
                    "<p> Price: " . $row['price'] . "</p>" .
                    "<a href=session.php?id=". $row['ID'] ."><button class=btn btn-primary> Add</button></a>" .
                    "<hr>" .
                    "</div>";
            }
        } else {
            echo "<p>No results found</p>";
        }
    }
} catch (PDOException $e) {
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

// Close statement
unset($stmt);

// Close connection
unset($pdo);