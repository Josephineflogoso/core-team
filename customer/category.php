<?php

include_once "../administrator/config/dbconnect.php";

session_start();

$customer_id = $_SESSION['customer_id'];

if(!isset($customer_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">

   <h3>Category</h3>
   
   <p> <a href="index.php">home</a> / category </p>
</div>

<section class="category">

   <h1 class="title">Category</h1>

<div class="box-container">

<?php
  include_once "../administrator/config/dbconnect.php";
  $sql="SELECT * from tbl_category WHERE tbl_category.category_id";
  $result=$conn-> query($sql);
  $count=1;
  if ($result-> num_rows > 0){
    while ($row=$result-> fetch_assoc()) {
      $id=$row['category_id'];
?>

    <div class="box">
        <h3><?=$row['category_name']; ?></h3>
        <a href="productCat.php?id=<?php echo $id; ?>" class="btn">shop now</a>
    </div>
    <?php
     };
  };
  ?>
</div>
</section>
   </div>

</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>