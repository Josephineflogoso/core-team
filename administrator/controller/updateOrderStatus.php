<?php

    include_once "../config/dbconnect.php";
   
    $order_id=$_POST['id'];
    $status=$_POST['status'];
    //echo $order_id;
$updateStatus=mysqli_query($conn, "UPDATE tbl_order SET order_status = '$status' WHERE order_id = $order_id");
    
?>