<?php

include_once "../administrator/config/dbconnect.php";

session_start();

$customer_id = $_SESSION['customer_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wishlist</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
<style>
   /* sweetalert 2 */
.swal2-modal {
  width: 600px; /* Set the width of the modal box */
  max-height: 200vh; /* Set the maximum height of the modal box */
}
.swal2-title,
.swal2-content {
  font-size: 50px; /* Set the font size of title and content */
}
.swal2-icon svg {
  font-size: 300px; /* Set the font size of the icon */
}
.swal2-popup .swal2-title,
.swal2-popup .swal2-content,
.swal2-popup .swal2-html-container {
  font-size: 30px; /* Set the font size of the text */
}
.confirm-button,
.cancel-button {
  font-size: 50px; /* Set the font size of the button text */
  padding: 10px 24px;
  border-radius: 5px;
}

.confirm-button {
  background-color: #3085d6;
  color: #fff;
  margin-right: 10px;
}

.cancel-button {
  background-color: #d33;
  color: #fff;
}
.button-text {
   font-size: 100px;
}
    </style>

</head>

<body>

    <?php include 'header.php'; ?>
    <?php 
    
    if(!isset($customer_id)){
        header('location:login.php');
     }
     
     if(isset($_POST['add_to_cart'])){
     
        $product_name = $_POST['product_name'];
        $stocks = $_POST['stocks'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $quantity = $_POST['quantity'];
     
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE product_name = '$product_name' AND customer_id = '$customer_id'") or die('query failed');
     
        if(mysqli_num_rows($check_cart_numbers) > 0){
            echo '<script>
            Swal.fire({
               title: "already added to cart!",
               icon: "error",
               showConfirmButton: false,
               timer: 2000,
            }).then((result) => {
               if (result) {
                  window.location.href = "./wishlist.php";
               }
            })
         </script>';
        }else{
           mysqli_query($conn, "INSERT INTO `tbl_cart`(customer_id, product_name, stocks, price, quantity, image) VALUES('$customer_id', '$product_name', '$stocks', '$price', '$quantity', '$image')") or die('query failed');
           
      echo '<script>
      Swal.fire({
         title: "Successfully",
         text: "Product Added to Cart!",
         icon: "success",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./wishlist.php";
         }
      })
   </script>';
        }
     
     }
     
     if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `tbl_wishlist` WHERE id = '$delete_id'") or die('query failed');
       
     }
     
    // Check if the "delete" parameter is present
if (isset($_GET['delete'])) {
    // Delete all wishlist items for the current customer
    $customer_id = $_SESSION['customer_id'];
    mysqli_query($conn, "DELETE FROM `tbl_wishlist` WHERE customer_id = '$customer_id'") or die('query failed');
    
    // Redirect back to the wishlist page
  
}
    ?>

    <div class="heading">
        <h3>wishlist</h3>
        <p> <a href="index.php">home</a> / wishlist </p>
    </div>

    <section class="shopping-cart">

        <h1 class="title">products added</h1>

        <div class="box-container">
            <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `tbl_wishlist` WHERE customer_id = '$customer_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
                <div class="box">
      <a href="wishlist.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return item_delete()"></a>

<script>
function item_delete() {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action will delete the item from your wishlist.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonClass: 'cancel-button',
    confirmButtonText: 'Yes, delete it!',
    confirmButtonClass: 'confirm-button',
    buttonText: 'button-text'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'wishlist.php?delete=<?php echo $fetch_cart['id']; ?>';
    }
  })
  return false; // added to prevent the default action of the button
}
</script>


                <img src="../administrator/<?php echo $fetch_cart['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_cart['product_name']; ?></div>
                <div class="stocks">Stocks: <?php echo $fetch_cart['stocks']; ?></div>
                <div class="price">₱ <?php echo (number_format($fetch_cart['price'], 2)) ?></div>
                <form action="" method="post">
                    <input type="hidden" name="wishlist_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" min="1" name="quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="hidden" name="stocks" value="<?php echo $fetch_cart['stocks']; ?>">
                    <input type="hidden" name="price" value="<?php echo $fetch_cart['price']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_cart['product_name']; ?>">
                    <input type="hidden" name="image" value="<?php echo $fetch_cart['image']; ?>">
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                </form>
            </div>
            <?php
         }
      }else{
         echo '<p class="empty">your wishlist is empty</p>';
      }
      ?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
  <!-- Remove the href attribute from the <a> tag -->
  <a><button class="delete-btn" onclick="return delete_all()">delete all</button></a>
</div>

<script>
function delete_all() {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action will delete all items from your wishlist.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonClass: 'cancel-button',
    confirmButtonText: 'Yes, delete all!',
    confirmButtonClass: 'confirm-button',
    buttonText: 'button-text'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'wishlist.php?delete';
    }
  })
  return false; // added to prevent the default action of the button
}
</script>

        <div class="flex">
            <a href="shop.php" class="option-btn">Continue shopping</a>
        </div>

    </section>


    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>