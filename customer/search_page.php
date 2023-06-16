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
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

    <!--  sweetalert 2 link  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
  max-height: 100vh; /* Set the maximum height of the modal box */
}
.swal2-title,
.swal2-content {
  font-size: 50px; /* Set the font size of title and content */
}
.swal2-icon svg {
  font-size: 250px; /* Set the font size of the icon */
}
.swal2-popup .swal2-title,
.swal2-popup .swal2-content,
.swal2-popup .swal2-html-container {
  font-size: 30px; /* Set the font size of the text */
}
.swal2-confirm {
  font-size: 10rem;
}

.swal2-cancel {
   font-size: 10rem;
}
</style>

</head>
<body>
   
<?php include 'header.php'; ?>
<?php 
if(!isset($customer_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $stocks = $_POST['stocks'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE product_name = '$product_name' AND customer_id = '$customer_id' AND status=0") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      echo '<script>
      Swal.fire({
         title: "already added to cart!",
         icon: "error",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./search_page.php";
         }
      })
   </script>';
   }else{
      mysqli_query($conn, "INSERT INTO `tbl_cart`(customer_id, product_name, stocks, price, quantity, image) VALUES('$customer_id', '$product_name', '$stocks', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
     
      echo '<script>
      Swal.fire({
         title: "Successfully",
         text: "Product Added to Cart!",
         icon: "success",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./search_page.php";
         }
      })
   </script>';

   }

}

if(isset($_POST['add_to_wishlist'])){

   $product_name = $_POST['product_name'];
   $stocks = $_POST['stocks'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
  
   $check_cart_numbers1 = mysqli_query($conn, "SELECT * FROM `tbl_wishlist` WHERE product_name = '$product_name' AND customer_id = '$customer_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers1) > 0){
      echo '<script>
      Swal.fire({
         title: "already added to wishlist!",
         icon: "error",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./search_page.php";
         }
      })
   </script>';
   }else{
      $sql="INSERT INTO tbl_wishlist SET customer_id='$customer_id', product_name ='$product_name', stocks = '$stocks', price='$product_price', image='$product_image'";
      $res=mysqli_query($conn, $sql);
      if($res==TRUE)
      {
         echo '<script>
         Swal.fire({
            title: "Successfully",
            text: "Product Added to Wishlist!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "./search_page.php";
            }
         })
      </script>';
      }
       
   }

}
?>

<div class="heading">
   <h3>search page</h3>
   <p> <a href="index.php">home</a> / search </p>
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="search products..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE product_name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_products = mysqli_fetch_assoc($select_products)){
   ?>
   <form action="" method="post" class="box">
      <img class="image" src="../administrator/<?php echo $fetch_products['product_image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['product_name']; ?></div>
      <div class="desc"><?php echo $fetch_products['product_desc']; ?></div>
      <div class="stocks">Stocks: <?php echo $fetch_products['stocks']; ?></div>
      <div class="price">₱ <?php echo (number_format($fetch_products['price'], 2)) ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['product_name']; ?>">
      <input type="hidden" name="stocks" value="<?php echo $fetch_products['stocks']; ?>">
      <input type="hidden" name="product_desc" value="<?php echo $fetch_products['product_desc']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['product_image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      <input type="submit" value="add to wishlist" name="add_to_wishlist" class="btn">
     </form>
   <?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }else{
         echo '<p class="empty">search something!</p>';
      }
   ?>
   </div>
  

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>