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
   <title>Confirm services</title>

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
   header('location: login.php');
   exit;
}


?>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>Confirm Services</h3>
   <p> <a href="index.php">home</a> / confirm services </p>
</div>

<section class="display-order">
   <?php  
   $select_services = mysqli_query($conn, "SELECT * FROM `tbl_inquiry` WHERE customer_id = '$customer_id' AND status = 0") or die('query failed');
   if(mysqli_num_rows($select_services) > 0) {
      while($fetch_services = mysqli_fetch_assoc($select_services)) {
         $services_name = $fetch_services['services_name'];
         ?>
         <p><?php echo $fetch_services['services_name']; ?></p>
         <?php
      }
   } else {
      echo '<p class="empty">Your list of services is empty.</p>';
   }
   ?>
</section>

<section class="checkout">
   <form action="" method="post">
      <h3>Confirm Your Services</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Purok:</span>
            <input type="number" min="1" name="purok" required placeholder="e.g. Purok No." value="<?php if(isset($_POST['purok'])) { echo $_POST['purok']; } ?>">
         </div>
         <div class="inputBox" required>
            <span>Municipality:</span>
            <input type="text" name="municipality" placeholder="Enter your municipality" required value="<?php if(isset($_POST['municipality'])) { echo $_POST['municipality']; } ?>">
         </div>
         <div class="inputBox" required>
            <span>Barangay:</span>
            <input type="text" name="barangay" placeholder="Enter your barangay" value="<?php if(isset($_POST['barangay'])) { echo $_POST['barangay']; } ?>" required>
         </div>
      </div>
      <input type="hidden" name="services_name" value="<?php echo $fetch_services['services_name']; ?>">
      <input type="submit" value="Confirm Now" class="btn" name="confirm_now">
   </form>
</section>
<?php

if(isset($_POST['confirm_now'])){
   $services_name = $_POST['services_name'];
   $purok = $_POST['purok'];
   $barangay = $_POST['barangay'];
   $municipality = $_POST['municipality'];

   $updateInquiryStatus = mysqli_query($conn, "UPDATE tbl_inquiry SET status = 1 where customer_id = $customer_id and status = 0");

   $insert_query = "INSERT INTO `tbl_availed` (customer_id, services_name, purok, barangay, municipality) VALUES ('$customer_id', '$services_name', '$purok', '$barangay', '$municipality')";

   if(mysqli_query($conn, $insert_query)){
      echo "
         <script>
            Swal.fire({
               icon: 'success',
               title: 'Services Availed',
               text: 'Your services have been availed successfully.',
               showConfirmButton: false,
               timer: 3000
            }).then(function() {
               window.location.href = 'availedServices.php';
            });
         </script>";
   } else {
      die('Query failed: ' . mysqli_error($conn));
   }
}

?>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>