<?php
include_once "../config/dbconnect.php";

$admin_id = $_POST['admin_id'];
$a_name = $_POST['name'];
$a_email = $_POST['email'];
$a_number = $_POST['number'];

$updateAdmin = mysqli_query($conn, "UPDATE tbl_admin SET 
    name='$a_name', 
    email='$a_email', 
    number='$a_number' 
    WHERE admin_id=$admin_id");

if ($updateAdmin) {
    echo "success";
    header("Location: ../administrator/index.php#admin");
} else {
    echo mysqli_error($conn);
}
?>
