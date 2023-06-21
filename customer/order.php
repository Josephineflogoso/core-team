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
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>your orders</h3>
        <p> <a href="home.php">home</a> / orders </p>
    </div>

    <section class="placed-orders">

        <h1 class="title">placed orders</h1>

        <div class="box-container">

        <?php   

$customer_query = mysqli_query($conn, "SELECT * FROM `tbl_customer` WHERE customer_id = '$customer_id'") or die('query failed');
$fetch_customer = mysqli_fetch_assoc($customer_query);
?>

                <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `tbl_order` WHERE customer_id = '$customer_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
               $remaining_payment = $fetch_orders['remaining'];
      ?>
            <div class="box">
                <p> Order date : <span><?php echo $fetch_orders['date'] . ' ' . $fetch_orders['time']; ?></span></p>
                <p>Full Name: <span><?php echo $fetch_customer['name']; ?></span></p>
                <p>Number: <span><?php echo $fetch_customer['number']; ?></span></p>
                <p>Email: <span><?php echo $fetch_customer['email']; ?></span></p>
                <p>Address:
                    <span><?php echo $fetch_orders['purok'] . ', ' . $fetch_orders['barangay'] . ', ' . $fetch_orders['municipality'] . ', ' . $fetch_orders['province']; ?></span>
                </p>
                <p> Order method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                <p> your orders :
                <?php 
                $getItems=mysqli_query($conn, "SELECT * FROM tbl_cart WHERE transac_code = '$fetch_orders[transac_code]' and customer_id = $customer_id");
                while($itemsRow = mysqli_fetch_assoc($getItems))
                {
                    ?>
                    <span><?php echo $itemsRow['product_name']; ?>(<?php echo $itemsRow['quantity']; ?>), </span>
                    <?php
                }
                ?>
                </p>
                <?php
                if($fetch_orders['method'] == "Pick up")
                {
                    ?>
                    <p>Total payment : <span>₱ <?php echo (number_format($fetch_orders['total_price'], 2)); ?></span> </p>
                    <?php
                }
                else
                {
                    ?>
                     <p> 30% of total payment : <span>₱ <?php echo (number_format($fetch_orders['30%'], 2)); ?></span> </p>
                <p> Remaining payment: <span>₱
                        <?php echo isset($remaining_payment) ? number_format($remaining_payment, 2) : '0.00'; ?></span>
                </p>

                    <?php
                }

                ?>
               
                <p> Order status : <span> <?php if($fetch_orders['order_status'] == 0)
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
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
        </div>

    </section>








    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>