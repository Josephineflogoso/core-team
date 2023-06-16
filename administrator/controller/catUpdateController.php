<?php
include_once "../config/dbconnect.php";


$category_id=$_POST['category_id'];
$c_name= $_POST['c_name'];

$updateCat = mysqli_query($conn,"UPDATE tbl_category SET 
    category_name='$c_name'
    WHERE category_id=$category_id");


if($updateCat)
{
   echo "success";
    header("Location: ../index.php#category");
    
}
 else
 {
     echo mysqli_error($conn);
 }
?>