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
   <title>Total Payment</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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

<?php 

if(!isset($customer_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){


   $method = $_POST['method'];
   $purok = $_POST['purok'];
   $barangay = $_POST['barangay'];
   $municipality = $_POST['municipality'];
   $province = $_POST['province'];
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

  $cart_query = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['product_name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;

      }
   }
   else
   {

   }
$sql="UPDATE tbl_cart SET status=1";
$res=mysqli_query($conn, $sql);
$cart_query1 = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id'") or die('query failed');
while($rows=mysqli_fetch_assoc($cart_query1))
{
 $name=$rows['product_name'];
 $qnty=$rows['quantity'];

}
$sql1="UPDATE tbl_product SET stocks= stocks - '$qnty' WHERE product_name='$name'";
$res2=mysqli_query($conn, $sql1);
  
      mysqli_query($conn, "INSERT INTO `tbl_order`(customer_id, method, purok, barangay, municipality, province, total_price) VALUES('$customer_id', '$method', '$purok', '$barangay', '$municipality', '$province',  '$cart_total')") or die('query failed');
      echo '<script>
      Swal.fire({
         title: "order placed successfully!",
         icon: "success",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./orders.php";
         }
      })
   </script>';
   
}

?>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Total Payment</h3>
   <p> <a href="index.php">home</a> / total payment</p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id' and status=0") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['product_name']; ?> <span>(<?php echo '₱'.$fetch_cart['price'].' '.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>₱<?php echo number_format ($grand_total, 2); ?></span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Payment</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Order method :</span>
            <select name="method" required>
               <option value="cash on delivery">Cash on delivery</option>
               <option value="Pick up">Pick up</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Purok :</span>
            <input type="number" min="0" name="purok" required placeholder="e.g. purok no.">
         </div>
         <div class="inputBox" required>
            <span>Municipality :</span>
            <input type="text" name="municipality"  placeholder="enter your municipality" required>
         </div>
         <div class="inputBox" required>
            <span>Barangay :</span>
            <input type="barangay" name="barangay"  placeholder="enter your barangay" required>
            </div>
         <div class="inputBox">
            <span>Province :</span>
            <input type="text" name="province" required placeholder="Antique">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>