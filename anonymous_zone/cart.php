<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include('../config/common.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
    <?php
    if(!isset($_SESSION['loggedin'])) {
        echo '
            <h3>
                <a href="login.php">Login</a>
            </h3>
        ';
    }

    ?>

    <div>
    <?php 
            if(!$_SESSION["shopping_cart"]) {
                echo '<h2>No product added, please an product.</h2>';
            }
        ?>
    <?php   
        if(!empty($_SESSION["shopping_cart"])) {  
            $total = 0;  
            foreach($_SESSION["shopping_cart"] as $keys => $values) {  
    ?>  
        <img src="<?php echo '../assets/img/' . str_replace(' ', '_', strtolower($values['item_name'])) . '.jpg'; ?>" alt="<?php echo '../assets/img/' . str_replace(' ', '_', strtolower($values['item_name'])); ?>">
        <div class="text">

            
            <p><?php echo $values["item_name"]; ?></p>
            <p><?php echo $values['item_description']; ?></p>
            <p>$ <?php echo $values["item_price"]; ?></p>
            <a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Remove</span></a>
            <?php  
                }  
            }
            ?>
            <form action="cart.php" method="post" syle="display: block;">
                <input type="text" name="username" placeholder="Name"><br>
                <input type="text" name="contact_details" placeholder="Contact Details"><br>
                <textarea type="text" name="comments" placeholder="Comments"></textarea><br>
                <div style="margin-top: 10px;">
                    <a href="../index.php">Go to index</a>
                    <button type="submit" name="submit">Checkout</button>
                </div>
            </form>
        </div>
    </div>
 

    <?php

if(isset($_POST['submit'])) {
    $name = $_POST['username'];
    $contact = $_POST['contact_details'];
    $comments = $_POST['comments'];
    
    $mailTo = admin_email;
    $headers = 'From: ' . $mailFrom;
    $txt = 'You have recieved an e-mail from ' . $name . " . \n\n" . $contact . " . \n\n" . $comments;

    mail($mailTo, $txt, $headers);
    header("Location: cart.php?mailsend");
}
?>

 
</body>
</html>