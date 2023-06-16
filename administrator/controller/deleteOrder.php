<?php

    include_once "../config/dbconnect.php";
    
    $order_id=$_POST['record'];
    $query="DELETE FROM tbl_order where order_id='$order_id'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo"Order Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>