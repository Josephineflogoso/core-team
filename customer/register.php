<?php

include_once "../administrator/config/dbconnect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
    <style>
    /* sweetalert 2 */
    .swal2-modal {
        width: 600px;
        /* Set the width of the modal box */
        max-height: 200vh;
        /* Set the maximum height of the modal box */
    }

    .swal2-title,
    .swal2-content {
        font-size: 50px;
        /* Set the font size of title and content */
    }

    .swal2-icon svg {
        font-size: 300px;
        /* Set the font size of the icon */
    }

    .swal2-popup .swal2-title,
    .swal2-popup .swal2-content,
    .swal2-popup .swal2-html-container {
        font-size: 30px;
        /* Set the font size of the text */
    }

    .confirm-button,
    .cancel-button {
        font-size: 50px;
        /* Set the font size of the button text */
        padding: 10px 24px;
        border-radius: 5px;
    }

    .confirm-button {
        background-color: #3085d6;
        color: #fff;
        margin-right: 10px;
    }

    .cancel-button {
        background-color: #d33;
        color: #fff;
    }

    .button-text {
        font-size: 100px;
    }
    </style>

</head>

<body>



    <?php
// if(isset($message)){
//    foreach($message as $message){
//       echo '
//       <div class="message">
//          <span>'.$message.'</span>
//          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
//       </div>
//       ';
//    }
// }



if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $pass = mysqli_real_escape_string($conn, $_POST['pass']);
   $cpass = mysqli_real_escape_string($conn, $_POST['confirm_pass']);

   $select_users = mysqli_query($conn, "SELECT * FROM `tbl_customer` WHERE email = '$email' AND pass = '$pass'") or die('query failed');

   $sql="SELECT * FROM tbl_customer WHERE email='$email'";
   $res=mysqli_query($conn, $sql);
   $count=mysqli_fetch_assoc($res);
   if($count>0)
   {
      echo '<script>
         Swal.fire({
            title: "gmail already exist!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "register.php";
            }
         })
      </script>';
   
  

   }else{
      if($pass != $cpass){
         echo '<script>
         Swal.fire({
            title: "confirm password not matched!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "register.php";
            }
         })
      </script>';
      }else{
         mysqli_query($conn, "INSERT INTO `tbl_customer`(name, email, number, pass) VALUES('$name', '$email', '$number', '$cpass')") or die('query failed');
         echo '<script>
      Swal.fire({
         title: "Register Successfully!",
         icon: "success",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "login.php";
         }
      })
   </script>';
      }
   }
   
}

?>

    <section class="home1">

        <div class="content1">
            <img src="image/ar-logo.png" width="100" height="100">
            <br><br><br>
            <h3>Business-to-Consumer (B2C) Ecommerce web application </h3>
        </div>
        <form action="" method="post">
            <h2>I am a new customer</h2>

            <input type="text" name="name" placeholder="full name" required class="box">
            <input type="email" name="email" placeholder="***@gmail.com" required class="box">
            <input type="number" name="number" placeholder="09*********" required class="box">
            <input type="password" name="pass" placeholder="enter your password" required class="box">
            <input type="password" name="confirm_pass" placeholder="confirm your password" required class="box">
            <input type="submit" name="submit" value="register now" class="btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>

    </section>

</body>

</html>