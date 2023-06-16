<?php
    include_once "../config/dbconnect.php";

    $inquiry_id=$_POST['inquiry_id'];
    $status= $_POST['status'];

    $updateInquiry = mysqli_query($conn,"UPDATE tbl_inquiry SET 
        status='$status',
        WHERE inquiry_id=$inquiry_id");

    if($updateInquiry)
    {
        echo "true";
        header("Location: ../index.php#products");
    }
    // else
    // {
    //     echo mysqli_error($conn);
    // }
?>

<?php

    include_once "../config/dbconnect.php";
   
    $inquiry_id=$_POST['record'];
    //echo $order_id;
    $sql = "SELECT status from tbl_inquiry where id='$inquiry_id'"; 
    $result=$conn-> query($sql);
  //  echo $result;

    $row=$result-> fetch_assoc();
    
   // echo $row["pay_status"];
    
    if($row["status"]==0){
         $update = mysqli_query($conn,"UPDATE tbl_inquiry SET status=1 where id='$inquiry_id'");
    }
    else if($row["status"]==1){
         $update = mysqli_query($conn,"UPDATE tbl_inquiry SET status=0 where id='$inquiry_id'");
    }
    
        
 
    // if($update){
    //     echo"success";
    // }
    // else{
    //     echo"error";
    // }
    
?>