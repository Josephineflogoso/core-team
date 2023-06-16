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
   <title>services</title>
  
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
            window.location.href = "./services.php";
         }
      })
   </script>';
   }else{
      mysqli_query($conn, "INSERT INTO `tbl_inquiry`(customer_id, services_name, services_image) VALUES('$customer_id', '$product_name', '$image')") or die('query failed');
      
      echo '<script>
      Swal.fire({
         title: "Successfully",
         text: "Services added to services lists",
         icon: "success",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./services.php";
         }
      })
   </script>';
            }
      }

?>

<div class="heading">
   <h3>services</h3>
   <p> <a href="index.php">home</a> / services </p>
</div>

<section class="services">

<h1 class="title">Services</h1>
<br>

<div class="box-container">

<?php  
         $select_services = mysqli_query($conn, "SELECT * FROM `tbl_services` LIMIT 50") or die('query failed');
         if(mysqli_num_rows($select_services) > 0){
            while($fetch_services = mysqli_fetch_assoc($select_services)){
               $ID = $fetch_services ['services_id'];
      ?>

    <div class="box">
      <form action="" method="POST">
    <img class="image" src="../administrator/<?php echo $fetch_services['image']; ?>" alt="">
        <h3><?php echo $fetch_services['services_name']; ?></h3>
        <p><?php echo $fetch_services['services_desc']; ?></p>   
     <input type="submit" value="avail" name="avail" class="btn">
     <input type="hidden" name="name" value=" <?php echo $fetch_services['services_name']; ?>">
     <input type="hidden" name="image" value=" <?php  echo $fetch_services['image']; ?>">

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


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>