<?php

    include_once "../config/dbconnect.php";
   
    $id=$_POST['id'];
    //echo $order_id;
    $getStocks = mysqli_query($conn, "SELECT * FROM tbl_transaction WHERE product_id = $id");
    $row=mysqli_fetch_assoc($getStocks);
    $stocks = $row['stock'];
    $price = $row['stock_price'];

$updateStock=mysqli_query($conn, "UPDATE tbl_product SET stocks = $stocks, price=$price WHERE product_id = $id");
$updateTransactionStock=mysqli_query($conn, "UPDATE tbl_transaction SET stock = 0 WHERE product_id = $id");
    
?>