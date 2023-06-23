<?php

    include_once "../config/dbconnect.php";
   
    $order_id=$_POST['id'];
    $status=$_POST['status'];
    //echo $order_id;
    if($status == 'Cancelled')
    {
        $getTransCode=mysqli_query($conn, "SELECT * FROM tbl_order WHERE order_id = $order_id ");
        $row = mysqli_fetch_assoc($getTransCode);
        $transCode = $row['transac_code'];
        $customerId = $row['customer_id'];

        $getItemInCart = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE transac_code = '$transCode' and status = 1 and customer_id = $customerId");

        while($rows = mysqli_fetch_assoc($getItemInCart))
        {
            $productName = $rows['product_name'];
            $quantity = $rows['quantity'];

            $updateProducts = mysqli_query($conn, "UPDATE tbl_product SET stocks = stocks + $quantity WHERE product_name = '$productName'");

        }
        $updateCart = mysqli_query($conn, "UPDATE  tbl_cart set status = 2 WHERE transac_code = '$transCode' and customer_id = $customerId");
        
        $updateStatus=mysqli_query($conn, "UPDATE tbl_order SET order_status = '$status' WHERE order_id = $order_id");

    }
    else
    {

        $updateStatus=mysqli_query($conn, "UPDATE tbl_order SET order_status = '$status' WHERE order_id = $order_id");
    }

    
?>