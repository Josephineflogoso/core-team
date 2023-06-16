<?php

include_once "../administrator/config/dbconnect.php";

session_start();

$customer_id = $_SESSION['customer_id'];

if(!isset($customer_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>availed services</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Your availed services</h3>
        <p> <a href="home.php">home</a> / availed services </p>
    </div>

    <section class="placed-orders">

        <h1 class="title">availed</h1>

        <div class="box-container">

        <?php   

$customer_query = mysqli_query($conn, "SELECT * FROM `tbl_customer` WHERE customer_id = '$customer_id'") or die('query failed');
$fetch_customer = mysqli_fetch_assoc($customer_query);
?>

                <?php
         $availed_query = mysqli_query($conn, "SELECT * FROM `tbl_availed` WHERE customer_id = '$customer_id'") or die('query failed');
         if(mysqli_num_rows($availed_query) > 0){
            while($fetch_services = mysqli_fetch_assoc($availed_query)){
              
      ?>
            <div class="box">
                <p>Date Availed : <span><?php echo $fetch_services['date']; ?></span></p>
                <p>Full Name: <span><?php echo $fetch_customer['name']; ?></span></p>
                <p>Number: <span><?php echo $fetch_customer['number']; ?></span></p>
                <p>Email: <span><?php echo $fetch_customer['email']; ?></span></p>
                <p>Address:
                    <span><?php echo $fetch_services['purok'] . ', ' . $fetch_services['barangay'] . ', ' . $fetch_services['municipality'] . ', ' . $fetch_services['province']; ?></span>
                </p>
                <p> Services Availed: <span><?php echo $fetch_services['services_name']; ?></span> </p>
               
                <p> Services status : <span> <?php if($fetch_services['services_status'] == 0)
         {
            echo "Pending";
         }
         else{
            echo "Complete";

           } ?>


                    </span> </p>
            </div>
            <?php
       }
      }else{
         echo '<p class="empty">no services availed yet!</p>';
      }
      ?>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>