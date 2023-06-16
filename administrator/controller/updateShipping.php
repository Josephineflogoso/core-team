<?php
include_once "../config/dbconnect.php";


$shipping_id=$_POST['shipping_id'];
$barangay= $_POST['barangay'];
$municipality= $_POST['municipality'];
$s_cost= $_POST['shipping_cost'];

$updateShipping = mysqli_query($conn,"UPDATE tbl_shipping_fees SET 
    barangay='$barangay', 
    municipality='$municipality',
    shipping_cost='$s_cost'
    WHERE shipping_id=$shipping_id");


if($updateShipping)
{
   echo "success";
    header("Location: ../index.php#shipping");
    
}
 else
 {
     echo mysqli_error($conn);
 }
?>