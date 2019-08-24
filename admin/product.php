<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include('../config/common.php');


    if(!isset($_SESSION['loggedin'])) {
        echo '
            <h3>
                <a href="../anonymous_zone/login.php">Login</a>
            </h3>
        ';
    } else {
        echo "<h1>Welcome back," . $_SESSION['name'] . "</h1>";
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
        <title>Product - Admin Zone</title>
    </head>
 
<body>
    
    <form name="editProduct" method="post" action="../config/common.php">
        <input type="text" name="title" placeholder="Title"><br>
        <input type="text" name="description" placeholder="Description"><br>
        <input type="text" name="price" placeholder="Price"><br>
        <!-- <input type="text" name="image"> -->
        <a href="products.php">Products</a>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>