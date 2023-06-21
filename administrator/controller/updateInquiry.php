<?php
    include_once "../config/dbconnect.php";
if(isset($_POST['id']) && isset($_POST['status']))
{
    $inquiry_id=$_POST['id'];
    $status= $_POST['status'];

    $updateInquiry = mysqli_query($conn,"UPDATE tbl_availed SET 
        status=$status
        WHERE avail_id=$inquiry_id");

    if($updateInquiry)
    {
        header("Location: ../index.php#inquiries");
    }
    else
    {
        echo "Error updating inquiry: " . mysqli_error($conn);
    }
}
   
   
?>

