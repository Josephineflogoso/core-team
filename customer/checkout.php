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
   <title>checkout</title>

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

if(isset($_POST['order_now'])){
   
}
?>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Checkout</h3>
   <p> <a href="index.php">home</a> / checkout </p>
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
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Order method :</span>
            <select name="method" required>
               <option value="cash on delivery">Cash on delivery</option>
               <option value="Pick up">Pick up</option>
            </select>
         </div>
         <?php
            $getLocation=mysqli_query($conn, "SELECT * FROM tbl_order WHERE customer_id = $customer_id limit 1");
            if(mysqli_num_rows($getLocation) > 0)
            {
               $row=mysqli_fetch_assoc($getLocation);
               $purok1=$row['purok'];
               $barangay1=$row['barangay'];
               $municipality1 = $row['municipality'];
            }
            else
            {
               $purok1;
               $barangay1="";
               $municipality1 ="";
            }
         ?>
         <div class="inputBox">
            <span>Purok :</span>
            <input type="number" min="1" name="purok" required placeholder="e.g. purok no." value="<?php if(isset($_POST['purok']))
            {
               echo $_POST['purok'];
            } else{ echo $purok1;}?>">
         </div>
         <div class="inputBox" required>
            <span>Municipality :</span>
            <input type="text" name="municipality"  placeholder="enter your municipality" required value="<?php if(isset($_POST['municipality']))
            {
               echo $_POST['municipality'];
            }else{echo $municipality1;} ?>">
         </div>
         <div class="inputBox" required>
            <span>Barangay :</span>
            <input type="barangay" name="barangay"  placeholder="enter your barangay" value="<?php if(isset($_POST['barangay']))
            {
               echo $_POST['barangay'];
            }else{echo $barangay1; } ?>" required>
            </div>
      </div>
       <p>If you choose cash on delivery (COD) as your payment method, you must first pay <span>30%</span> of your total payment through Gcash or Palawan. 
       After making the payment, you may send us proof (pictures) through our Facebook page. 
       We will deliver your order as soon as we receive the payment. If you fail to pay the <span>30%</span> of your total order within 3 days, 
       your order will be automatically cancelled.
       </p>
      <!--<input type="submit" value="order now" class="btn" name="order_btn">-->
      <input type="submit" value="Proceed to Shipping Calculation" class="btn" name="order_btn">
   </form>
   <?php 
   if(isset($_POST['order_btn']))
   {

      $method = $_POST['method'];
   $purok = $_POST['purok'];
   $barangay = $_POST['barangay'];
   $municipality = $_POST['municipality'];
   $placed_on = date('d-M-Y');


// Query to retrieve the shipping fee based on the user's location
$select_shipping = mysqli_query($conn, "SELECT shipping_cost FROM `tbl_shipping_fees` WHERE barangay = '$barangay' AND municipality = '$municipality'") or die('Query failed');

if (mysqli_num_rows($select_shipping) > 0) {
   if($method == 'Pick up')
   {
      $shipping_fee = 0;
   }
   else
   {
      $fetch_shipping = mysqli_fetch_assoc($select_shipping);
      $shipping_fee = $fetch_shipping['shipping_cost'];
  
   }
}
else
{
   $shipping_fee = 0;
}

$grand = $grand_total + $shipping_fee;
$thirtyPercent = $grand * .30;
$remaining = $grand - $thirtyPercent;

?>
<form action="" method = "POST">
<div class="results">
<p class="result1">Sub Total: ₱<?php echo $grand_total; ?></p>
                <p class="result1">Shipping Fee: ₱<?php echo number_format($shipping_fee,2); ?></p>
                <p class="result1">Total Payment: ₱<?php echo number_format($grand,2); ?></p>
                <br>
                <p class="result1">30% of Total Payment: ₱<?php echo number_format($thirtyPercent,2); ?></p>
                <p class="result1">Remaining Total: ₱<?php echo number_format($remaining,2); ?></p>
          <br>
          <br>

          <input type="hidden" name="payment_30_percent" value="<?php echo $thirtyPercent; ?>">
                <input type="hidden" name="remaining_payment" value="<?php echo $remaining ;?>">
                <input type="hidden" name="total_payment" value="<?php echo $grand; ?>">
                <input type="hidden" name="method" value="<?php echo $method; ?>">
                <input type="hidden" name="purok" value="<?php echo $purok; ?>">
                <input type="hidden" name="barangay" value="<?php echo $barangay; ?>">
                <input type="hidden" name="municipality" value="<?php echo $municipality; ?>">
          <input type="submit" value="Order Now" class="btn" name="order_now">
      </div>
  </form>

<?php

}
if(isset($_POST['order_now']))
{
   $method = $_POST['method'];
   $purok = $_POST['purok'];
   $barangay = $_POST['barangay'];
   $municipality = $_POST['municipality'];
   $placed_on = date('d-M-Y');
   $payment_30_percent = $_POST['payment_30_percent'];
   $remaining_payment = $_POST['remaining_payment'];
   $total_payment = $_POST['total_payment'];
   
   $cart_total = 0;
   $cart_products = array();

  $cart_query = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id' AND status = 0") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      $getTransac_code = mysqli_fetch_assoc($cart_query);
      $transac_code = $getTransac_code['transac_code'];
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['product_name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;

      }
   }
   else
   {

   }
   
$cart_query1 = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id'") or die('query failed');
while($rows=mysqli_fetch_assoc($cart_query1))
{
 $name=$rows['product_name'];
 $qnty=$rows['quantity'];

 $sql1="UPDATE tbl_product SET stocks= stocks - '$qnty' WHERE product_name='$name'";
 $res2=mysqli_query($conn, $sql1);

}

  
      $sql= "INSERT INTO `tbl_order`(customer_id, method, purok, barangay, municipality, total_price, product_name,`30%`, remaining,total_amount,transac_code) VALUES('$customer_id', '$method', '$purok', '$barangay', '$municipality', '$cart_total', '" . implode(', ', $cart_products) . "','$payment_30_percent','$remaining_payment','$total_payment','$transac_code')";
      $query=mysqli_query($conn, $sql);
      if ($query) {
        
         echo "<script>
         Swal.fire({
            icon: 'success',
            title: 'Order Placed',
            text: 'Your order has been placed successfully.',
            showConfirmButton: false,
            timer: 3000
        }).then(function() {
            window.location.href = 'order.php';
        });
      </script>";
      $updateCart=mysqli_query($conn, "UPDATE tbl_cart SET status = 1 WHERE customer_id = $customer_id");
      }
     
}

   //ersd

   ?>


</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>