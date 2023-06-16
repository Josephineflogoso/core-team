<?php
include_once "../config/dbconnect.php";

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['c_password'])) {
  $a_name = $_POST['name'];
  $a_email = $_POST['email'];
  $a_pass = $_POST['password'];
  $a_cpass = $_POST['c_password'];

  $insert = mysqli_query($conn, "INSERT INTO tbl_admin (name, email, password, c_password) 
    VALUES ('$a_name', '$a_email', '$a_pass', '$a_cpass')");

  if (!$insert) {
    echo mysqli_error($conn);
  } else {
    echo "success";
  }
}
?>
