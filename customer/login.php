<?php

include_once "../administrator/config/dbconnect.php";
session_start();



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
<style>
   /* sweetalert 2 */
.swal2-modal {
  width: 800px; /* Set the width of the modal box */
  max-height: 100vh; /* Set the maximum height of the modal box */
}
.swal2-title,
.swal2-content {
  font-size: 50px; /* Set the font size of title and content */
}
.swal2-icon svg {
  font-size: 200px; /* Set the font size of the icon */
}
.swal2-popup .swal2-title,
.swal2-popup .swal2-content,
.swal2-popup .swal2-html-container {
  font-size: 30px; /* Set the font size of the text */
}
</style>
</head>
<body>



<section class="home1">

<div class="content1">
<img src="image/ar-logo.png" width="100" height="100">
<br><br><br>
<h3>Business-to-Consumer (B2C) Ecommerce web application </h3>
</div>
   <form action="" method="post">
      <h2>returning customer</h2>
      <input type="email" name="email" placeholder="***@gmail.com" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>Forgot password? message: mission.s.roger@gmail.com</p>
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>
</section>

</body>
</html>

<?php

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $cpass = mysqli_real_escape_string($conn, $_POST['password']);

   $select_users = mysqli_query($conn, "SELECT * FROM `tbl_customer` WHERE email = '$email' AND pass = '$cpass'") or die('query failed');
   $select_admin = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE email = '$email' AND password = '$cpass'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $row = mysqli_fetch_assoc($select_users);
      if ($row['user_type'] == 'Customer') {
         $_SESSION['customer_name'] = $row['name'];
         $_SESSION['customer_email'] = $row['email'];
         $_SESSION['number'] = $row['number'];
         $_SESSION['customer_id'] = $row['customer_id'];

         $redirectURL = "index.php";
         $welcomeMessage = "Welcome " . $_SESSION['customer_name'];
         $redirectLocation = "window.location.href = '$redirectURL'";
      }
   } elseif (mysqli_num_rows($select_admin) > 0) {
      $row = mysqli_fetch_assoc($select_admin);
      if ($row['user_type'] == 'Admin') {
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['customer_email'] = $row['email'];
         $_SESSION['number'] = $row['number'];
         $_SESSION['admin_id'] = $row['admin_id'];

         $redirectURL = "../administrator/index.php";
         $welcomeMessage = "Welcome Admin " . $_SESSION['admin_name'];
         $redirectLocation = "window.location.href = '$redirectURL'";
      }
   }

   if (isset($redirectURL)) {
      echo '<script>
         Swal.fire({
            title: "Login Successfully!",
            text: "' . $welcomeMessage . '",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               ' . $redirectLocation . ';
            }
         })
      </script>';
   } else {
      echo '<script>
         Swal.fire({
            title: "Incorrect email or password!",
            text: "Please try again.",
            icon: "error",
            confirmButtonText: "OK",
         }).then((result) => {
            if (result.isConfirmed) {
               window.location.href = "login.php";
            }
         })
      </script>';
   }
}


?>
<?php

?>