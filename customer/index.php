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
   <title>A&R</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.0/css/bootstrap.min.css">


    <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
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

   
<?php include 'header.php';

?>

<?php  



if(!isset($customer_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $stocks = $_POST['stocks'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   if($product_quantity > $_POST['stocks'])
   {
      echo '<script>
      Swal.fire({
         title: "Not enough stocks!",
         icon: "error",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./index.php";
         }
      })
   </script>';
   }
   else
   {
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
               window.location.href = "./index.php";
            }
         })
      </script>';
      }else{
         $check_cart_numbers1 = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id' AND status=0") or die('query failed');
        
         if(mysqli_num_rows($check_cart_numbers1) > 0 )
         {
            $existing_cart_item = mysqli_fetch_assoc($check_cart_numbers1);
            $transaction_code = $existing_cart_item['transac_code'];
         }
         else
         {
            $transaction_code = generateTransactionCode();
         }
       
    
         mysqli_query($conn, "INSERT INTO `tbl_cart`(customer_id, product_name, stocks, price, quantity, image, transac_code) VALUES('$customer_id', '$product_name', '$stocks', '$product_price', '$product_quantity', '$product_image', '$transaction_code')") or die('query failed');
        
         echo '<script>
         Swal.fire({
            title: "Successfully",
            text: "Product Added to Cart!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "./index.php";
            }
         })
      </script>';
   
      }
   }

   

}
function generateTransactionCode(){
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $code_length = 8;
      $transaction_code = '';
      for ($i = 0; $i < $code_length; $i++) {
         $index = rand(0, strlen($characters) - 1);
         $transaction_code .= $characters[$index];
      }
   return $transaction_code;
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
            window.location.href = "./index.php";
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
               window.location.href = "./index.php";
            }
         })         
      </script>';
      }
       
   }

}

if(isset($_POST['avail'])){

   $product_name = $_POST['name'];
$image=$_POST['image'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_inquiry` WHERE services_name = '$product_name' AND customer_id = '$customer_id' AND status=0") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      echo '<script>
      Swal.fire({
         title: "already availed services",
         icon: "error",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./index.php";
         }
      })
   </script>';
   }else{

      $check_cart_numbers1 = mysqli_query($conn, "SELECT * FROM `tbl_inquiry` WHERE customer_id = '$customer_id' AND status=0") or die('query failed');
     
      if(mysqli_num_rows($check_cart_numbers1) > 0 )
      {
         $existing_cart_item = mysqli_fetch_assoc($check_cart_numbers1);
         $transaction_code = $existing_cart_item['transac_code'];
      }
      else
      {
         $transaction_code = generateTransactionCode();
      }
    
      mysqli_query($conn, "INSERT INTO `tbl_inquiry`(customer_id, services_name, services_image, transac_code) VALUES('$customer_id', '$product_name', '$image','$transaction_code')") or die('query failed');
      
      echo '<script>
      Swal.fire({
         title: "Successfully",
         text: "Services added to services lists",
         icon: "success",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./index.php";
         }
      })
   </script>';
            }
      }

?>

<section class="home">

   <div class="content">
      <h3>A&R IT Services and A&R Office and School Supplies </h3>
      <p>We offered different types of IT related services <br> and all kinds of office and school supplies. <br> Located at Barangbang, San Remigio, Antique.</p>
      <a href="shop.php" class="white-btn">Shop now</a>
   </div>

</section>

<!-- services-->

<section class="services">
   <h2>Explore the IT Services and <span>Office and School Supplies</span></h2>
   <br>
<h1 class="title">Services</h1>

<div class="box-container">

      <?php  
         $select_services = mysqli_query($conn, "SELECT * FROM `tbl_services` WHERE status = 'Available' LIMIT 50") or die('query failed');
         if(mysqli_num_rows($select_services) > 0){
            while($fetch_services = mysqli_fetch_assoc($select_services)){
               $ID = $fetch_services ['services_id'];
      ?>

    <div class="box">
      <form action="" method="POST">
    <img class="image" src="../administrator/<?php echo $fetch_services['image']; ?>" alt="">
        <h3><?php echo $fetch_services['services_name']; ?></h3>
        <p><?php echo $fetch_services['services_desc']; ?></p>   
     
     <input type="hidden" name="name" value=" <?php echo $fetch_services['services_name']; ?>">
     <input type="hidden" name="image" value=" <?php  echo $fetch_services['image']; ?>">
     <input type="submit" value="avail" name="avail" class="btn">

     </form>
   </div>
    <?php
         }
      }else{
         echo '<p class="empty">no services added yet!</p>';
      }
      ?>
</div>

</section>


<!-- products-->

<section class="products">

   <h1 class="title">School Supplies</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE stocks > 0  LIMIT 50") or die('query failed');
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
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
</section>

<section class="category">

   <div class="flex">

      <div class="image">
         <img src="image/img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Categories</h3>
         <p>Explore the different kinds of categories.</p>
         <a href="category.php" class="btn">explore</a>
      </div>

   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>