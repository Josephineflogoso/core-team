<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

    <div class="header-2">
        <div class="flex">
            <a href="index.php" class="logo"><img src="image/ar-logo.png" width="60" height="60"></a>

            <nav class="navbar">
                <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                <a href="category.php"><i class="fa fa-th-large" aria-hidden="true"></i> Category</a>
                <a href="shop.php"><i class="fa fa-book" aria-hidden="true"></i> School Supplies</a>
                <a href="services.php"><i class="fa fa-rss-square" aria-hidden="true"></i> IT Services</a>
                <a href="order.php"><i class="fa fa-list-alt" aria-hidden="true"></i> Orders</a>
            </nav>

            <div class="icons">

                <div id="menu-btn" class="fas fa-bars"></div>
                <!-- <a href="search_page.php" class="fas fa-search"></a> -->
                <a href="search_page.php" class="fas fa-search" data-toggle="tooltip" title="Search"></a>
                <div id="user-btn" class="fas fa-user"title="User"></div>
                <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE customer_id = '$customer_id' and status=0") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number);
               
               $select_wishlist_number = mysqli_query($conn, "SELECT * FROM `tbl_wishlist` WHERE customer_id = '$customer_id'") or die('query failed');
               $wishlist_rows_number = mysqli_num_rows($select_wishlist_number);

               $select_inquiry_number = mysqli_query($conn, "SELECT * FROM `tbl_inquiry` WHERE customer_id = '$customer_id' AND status = 0") or die('query failed');
               $inquiry_rows_number = mysqli_num_rows($select_inquiry_number);
            ?>
                <a href="wishlist.php" title="Wishlist"> <i class="fas fa-heart"></i> <span>(<?php echo $wishlist_rows_number; ?>)</span>
                </a>
                <a href="cart.php" title="Shopping Cart"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span>
                </a>
                <a href="avail.php" title="Selected services"> <i class="fas fa-check-square"></i>
                    <span>(<?php echo $inquiry_rows_number; ?>)</span> </a>
                <a href="availedServices.php" class="fa-brands fa-servicestack" data-toggle="tooltip" title="Availed Services"></a>
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['customer_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['customer_email']; ?></span></p>
                <a href="javascript:void(0);" class="delete-btn" onclick="confirmLogout()">logout</a>
                <script>
                function confirmLogout() {
                    Swal.fire({
                        title: 'Are you sure you want to logout?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, logout!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "logout.php";
                        }
                    })
                }
                </script>

            </div>
        </div>
    </div>

</header>