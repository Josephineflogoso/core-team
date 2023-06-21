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
   <title>cart</title>

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
   <?php 
   
   if(!isset($customer_id)){
      header('location:login.php');
   }
   
   if(isset($_POST['update_cart'])){
      $cart_id = $_POST['cart_id'];
      $cart_quantity = $_POST['cart_quantity'];
      if($cart_quantity > $_POST['stocks'])
      {
         echo '<script>
         Swal.fire({
            title: "Not enough stocks!",
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "./cart.php";
            }
         })
      </script>';
      }
      else
      {
         mysqli_query($conn, "UPDATE `tbl_cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
         echo '<script>
         Swal.fire({
            title: "Success!",
            text: "Cart updated successfully",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
         }).then((result) => {
            if (result) {
               window.location.href = "cart.php";
            }
         })
      </script>';
      }
     
}

   
   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE id = '$delete_id'") or die('query failed');
   }
   
   if(isset($_GET['delete_all'])){
      mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE customer_id = '$customer_id' and status=0") or die('query failed');
   }

   ?>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>shopping cart</h3>
   <p> <a href="index.php">home</a> / cart </p>
</div>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id' and status=0") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
      <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return delete_item()"></a>

<script>
function delete_item() {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action will delete the item from your cart.',
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
      window.location.href = 'cart.php?delete=<?php echo $fetch_cart['id']; ?>';
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
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="hidden" name="stocks" value="<?php echo $fetch_cart['stocks']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>₱ <?php echo $sub_total = ($fetch_cart['quantity'] * (number_format($fetch_cart['price'], 2))) ?></span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
  <a href="#"><button class="delete-btn" <?php echo ($grand_total > 1)?'':'disabled'; ?> onclick="deleteAll()">delete all</button></a>
</div>
   <script>
function deleteAll() {
  Swal.fire({
    title: 'Are you sure?',
    text: 'This action will delete all items from your cart.',
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
      window.location.href = 'cart.php?delete_all';
    }
  })
}
</script>

   <div class="cart-total">

      <div class="flex">
         <a href="shop.php" class="option-btn">Continue shopping</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed To Checkout</a>
      
      </div>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="./js/sweetalert.min.js"></script>

</body>
</html>