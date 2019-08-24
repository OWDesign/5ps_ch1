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
    
    $query = "SELECT * FROM products ORDER BY id ASC";  
    $result = mysqli_query($conn, $query);  
    if(mysqli_num_rows($result) > 0) {  
            while($row = mysqli_fetch_array($result)) {  
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
        <title>Products - Admin Zone</title>
    </head>
    <body>
        <div class="products">
        <img src="<?php echo '../assets/img/' . str_replace(' ', '_', strtolower($row['title'])) . '.jpg'; ?>" alt="<?php echo '../assets/img/' . str_replace(' ', '_', strtolower($row['title'])); ?>"><br>
            <div class="text">
                <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">  
                    <h4><?php echo $row["title"]; ?></h4>
                    <input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>" />  
                    <p><?php echo $row['description']; ?></p>
                    <input type="hidden" name="hidden_description" value="<?php echo $row["description"]; ?>" />  
                    <p>$ <?php echo $row["price"]; ?></p> 
                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                    <div style="display: flex;">
                        <a href="product.php?action=edit&id=<?php echo $row["id"]; ?>">Edit</a>
                        <!-- <input type="submit" name="delete" style="margin-top:5px;" value="Delete" />  -->
                    </div>
                </form>
            </div>
        </div>
        <?php  
            }  
        }  
        ?> 
        <div style="display: flex;">
            <a href="#" style="margin-right: 5px;">Add</a>
            <a href="#">Logout</a>
        </div>
    </body>
    </html>