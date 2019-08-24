<?php 
require('config.php');

// Create connection
$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

   
   function check_login() {
       $user_check = isset($_SESSION['username']);
       
       $ses_sql = mysqli_query($conn,"select username from users where username = '$user_check' ");
       
       $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
       
       $login_session = $row['username'];
       
       if(!isset($_SESSION['username'])){
          header('Location: anonymous_zone/login.php');
          die();
       } else {
           echo 'user is logged in!';
       }
   } 

//    add to cart items
   if(isset($_POST["add_to_cart"])) {  
      if(isset($_SESSION["shopping_cart"])) {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id)) {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],
                     'item_description'               =>     $_POST["hidden_description"],
                     'item_price'          =>     $_POST["hidden_price"],  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           } else {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="index.php"</script>';  
           }  
      }  
      else {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_description'               =>     $_POST["hidden_description"],
                'item_price'          =>     $_POST["hidden_price"],  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 
//  delete item from shopping cart 
 if(isset($_GET["action"])) {  
      if($_GET["action"] == "delete") {  
           foreach($_SESSION["shopping_cart"] as $keys => $values) {  
                if($values["item_id"] == $_GET["id"]) {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location.reload();</script>';  
                }  
           }  
      }  
 }

// edit function
 if(isset($_POST['update'])) {    
     $id = isset($_POST['id']) ? $_POST['id'] : '';
    
    $title= $_POST['title']; // name
    $description= $_POST['description']; // age
    $price= $_POST['price'];   // email
    
    // checking empty fields
    if(empty($title) || empty($description) || empty($price)) {            
        if(empty($title)) {
            echo "<font color='red'>Title field is empty.</font><br/>";
        }
        
        if(empty($description)) {
            echo "<font color='red'>Description field is empty.</font><br/>";
        }
        
        if(empty($price)) {
            echo "<font color='red'>Price field is empty.</font><br/>";
        }        
    } else {    
        //updating the table
        $result = mysqli_query($conn, "UPDATE products SET title='$title', description='$description', description='$description' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: ../index.php");
    }
}

//getting id from url
$id = isset($_GET['id']) ? $_GET['id'] : '';
 
//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
 
while($res = mysqli_fetch_array($result)) {
    $title = $res['title'];
    $description = $res['description'];
    $price = $res['price'];
}
 

?>