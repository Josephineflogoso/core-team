<?php

include_once "../administrator/config/dbconnect.php";

session_start();

$customer_id = $_SESSION['customer_id'];

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

    <!--  sweetalert 2 link  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
<style>
   /* sweetalert 2 */
.swal2-modal {
  width: 600px; /* Set the width of the modal box */
  max-height: 100vh; /* Set the maximum height of the modal box */
}
.swal2-title,
.swal2-content {
  font-size: 50px; /* Set the font size of title and content */
}
.swal2-icon svg {
  font-size: 250px; /* Set the font size of the icon */
}
.swal2-popup .swal2-title,
.swal2-popup .swal2-content,
.swal2-popup .swal2-html-container {
  font-size: 30px; /* Set the font size of the text */
}
.swal2-confirm {
  font-size: 10rem;
}

.swal2-cancel {
   font-size: 10rem;
}
</style>

</head>
<body>
   
<?php include 'header.php'; ?>

<?php 

if(!isset($customer_id)){
   header('location:login.php');
}
$id = '';
$catname = '';
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $sql="SELECT category_name from tbl_category WHERE category_id='$id'";
  $result=$conn-> query($sql);
  $row=mysqli_fetch_assoc($result);
  $catname=$row['category_name'];
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $stocks = $_POST['stocks'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   if($product_quantity > $stocks)
   {
      echo '<script>
      Swal.fire({
         title: "Not enough stocks!",
         icon: "error",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./productCat.php?id='.$id.'";
         }
      })
   </script>';
   }
   else
   {
      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE product_name = '$product_name' AND customer_id = '$customer_id' AND status=0") or die('query failed');
      if(mysqli_num_rows($check_cart_numbers) > 0){
         echo '<script>
         Swal.fire({
            title: "already added to cart!",
            icon: "error",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "./productCat.php?id='.$id.'";
            }
         })
      </script>';
      }else{
         $check_cart_numbers1 = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id' AND status=0") or die('query failed');
        
         if(mysqli_num_rows($check_cart_numbers1) > 0 )
         {
            $existing_cart_item = mysqli_fetch_assoc($check_cart_numbers1);
            $transaction_code = $existing_cart_item['transac_code'];
         }
         else
         {
            $transaction_code = generateTransactionCode();
         }
       
    
         mysqli_query($conn, "INSERT INTO `tbl_cart`(customer_id, product_name, stocks, price, quantity, image, transac_code) VALUES('$customer_id', '$product_name', '$stocks', '$product_price', '$product_quantity', '$product_image', '$transaction_code')") or die('query failed');
        
         echo '<script>
         Swal.fire({
            title: "Successfully",
            text: "Product Added to Cart!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "./productCat.php?id='.$id.'";
            }
         })
      </script>';
   
      }
   }

   

}
function generateTransactionCode(){
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $code_length = 8;
      $transaction_code = '';
      for ($i = 0; $i < $code_length; $i++) {
         $index = rand(0, strlen($characters) - 1);
         $transaction_code .= $characters[$index];
      }
   return $transaction_code;
}

 if(isset($_POST['add_to_wishlist'])){

   $product_name = $_POST['product_name'];
   $stocks = $_POST['stocks'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
  
   $check_cart_numbers1 = mysqli_query($conn, "SELECT * FROM `tbl_wishlist` WHERE product_name = '$product_name' AND customer_id = '$customer_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers1) > 0){
      echo '<script>
      Swal.fire({
         title: "already added to wishlist!",
         icon: "error",
         showConfirmButton: false,
         timer: 2000,
      }).then((result) => {
         if (result) {
            window.location.href = "./productCat.php?id=10";
         }
      })
   </script>';
   }else{
      $sql="INSERT INTO tbl_wishlist SET customer_id='$customer_id', product_name ='$product_name', stocks = '$stocks', price='$product_price', image='$product_image'";
      $res=mysqli_query($conn, $sql);
      if($res==TRUE)
      {
         echo '<script>
         Swal.fire({
            title: "Successfully",
            text: "Product Added to Wishlist!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
         }).then((result) => {
            if (result) {
               window.location.href = "./productCat.php?id=10";
            }
         })
      </script>';
      }
       
   }

}

?>

<div class="heading">

   <h3>Category</h3>
   
   <p> <a href="index.php">home</a> <a href="category.php">/ category </a> / <?php echo $catname; ?></p>
</div>

<section class="products">

   <h1 class="title"> <?php echo $catname; ?></h1>

<div class="box-container">

<?php
  include_once "../administrator/config/dbconnect.php";

  $sql="SELECT * from tbl_product WHERE category_id='$id' and stocks > 0";
  $result=$conn-> query($sql);
  $count=1;
  if ($result-> num_rows > 0){
    while ($row=$result-> fetch_assoc()) {
?>

    <form action="" method="post" class="box">
      <img class="image" src="../administrator/<?=$row['product_image']; ?>" alt="">
      <div class="name"><?=$row['product_name']; ?></div>
      <div class="desc"><?=$row['product_desc']; ?></div>
      <div class="stocks">Stocks: <?=$row['stocks']; ?></div>
      <div class="price">₱ <?=(number_format($row['price'], 2)) ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?=$row['product_name']; ?>">
      <input type="hidden" name="stocks" value="<?=$row['stocks']; ?>">
      <input type="hidden" name="product_desc" value="<?=$row['product_desc']; ?>">
      <input type="hidden" name="product_price" value="<?=$row['price']; ?>">
      <input type="hidden" name="product_image" value="<?=$row['product_image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      <input type="submit" value="add to wishlist" name="add_to_wishlist" class="btn">
    </form>
    <?php
     };
  };
  ?>
</div>
</section>
 


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>