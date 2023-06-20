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
   <title>Services selected</title>

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

if(isset($_GET['confirm'])){
  $delete_id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM `tbl_inquiry` WHERE id = '$delete_id'") or die('query failed');
  
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `tbl_inquiry` WHERE id = '$delete_id'") or die('query failed');
   
}
?>

<div class="heading">
   <h3>Services lists</h3>
   <p> <a href="index.php">home</a> /services lists </p>
</div>

<section class="shopping-cart">

   <h1 class="title">services selected</h1>

   <div class="box-container">
      <?php
         $select_inquiry = mysqli_query($conn, "SELECT * FROM `tbl_inquiry` WHERE customer_id = '$customer_id' and status=0 ") or die('query failed');
         if(mysqli_num_rows($select_inquiry) > 0){
            while($fetch_inquiry = mysqli_fetch_assoc($select_inquiry)){   
      ?>
      <div class="box">
      <a href="avail.php?delete=<?php echo $fetch_inquiry['id']; ?>" class="fas fa-times" onclick="deleteInquiry(event)"></a>

<script>
function deleteInquiry(event) {
  event.preventDefault();

  Swal.fire({
    title: 'Are you sure?',
    text: "This action cannot be undone.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      // Perform the delete action here
      window.location.href = event.target.getAttribute('href');
    }
  });
}
</script>

         <img src="../administrator<?=$fetch_inquiry['services_image'];?>" alt="">
         <div class="name"><?php echo $fetch_inquiry['services_name']; ?></div>
         <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $fetch_inquiry['id']; ?>">
            <input type="hidden"  name="services_name" value="<?php echo $fetch_inquiry['services_name']; ?>">
            <input type="hidden" name="services_image" value="<?php echo $fetch_inquiry['services_image']; ?>">
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">you dont have availed services</p>';
      }
      ?>
   </div>
   <br>
   <p style="font-size: 18px; text-align: center;">NOTE: If you are going to avail services, please contact first using the contact details given below.</p>


      <div class="flex">
        <a href="services.php" class="option-btn">Back to Services</a>
        <a href="confirmServices.php" class="option-btn">Proceed to confirm services</a>
      </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>