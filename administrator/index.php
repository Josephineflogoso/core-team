<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="./assets/css/style.css"></link>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!--  sweetalert 2 link  -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.css" integrity="sha512-R93r+YzbV7hJGtPHPrV1T8CknnMoV1L9zCrRU+bQ7/PfetPwYUn7b0C1dJf/KMBlpKc1CF9m7m3CqJhzc7Ff+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- SweetAlert2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.js" integrity="sha512-y6zbdj+EtLsmYBwJ98fqfCjvmpUWffPQ0G4Zo9JZIc+29Rj0ODpS1SInJICyqwr3A0ahjK4a4+xGnb2Jc6f+Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
   <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" />

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
</head>
<body >


    
        <?php
            include "./adminHeader.php";
           
            include_once "./config/dbconnect.php";
        ?>

<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
<div class="side-header">
    <img src="./assets/img/ar-logo.png" width="100" height="100" alt="administrator"> 
    <h5 style="margin-top:7px;">A&R E-commerce</h5>
</div>

<hr style="border:1px solid; background-color:#064770; border-color:#064770;">
    <a href="./index.php" ><i class="fa fa-bars" aria-hidden="true"></i></i> Dashboard</a>
    <a href="#customers"  onclick="showCustomers()" ><i class="fa fa-users"></i> Customers</a>
    <a href="#admin"  onclick="showAdmin()" ><i class="fa fa-users"></i> Admin</a>
    <a href="#wishlist"  onclick="showWishlist()" ><i class="fa fa-users"></i> Wishlist</a>
    <a href="#services"  onclick="showServices()" ><i class="fa fa-rss-square" aria-hidden="true"></i> IT Services</a>
    <a href="#inquiries"  onclick="showInquiries()" ><i class="fa fa-question-circle"></i> Inquiries</a>
    <a href="#category"   onclick="showCategory()" ><i class="fa fa-th-large"></i> Category</a>
    <a href="#products"   onclick="showProductItems()" ><i class="fa fa-th"></i> Products</a>
    <a href="#transaction"   onclick="showTransaction()" ><i class="fa fa-th"></i> History Transaction</a>
    <a href="#orders" onclick="showOrders()" ><i class="fa fa-list-alt" aria-hidden="true"></i> Orders</a>
    <a href="#shipping"   onclick="showShipping()" ><i class="fa fa-truck" aria-hidden="true"></i> Shipping Fees</a>
    <a href="#sale" onclick="showSale()" ><i class="fa fa-line-chart" aria-hidden="true"></i> Sales Reports</a>
    <a href="#invent" onclick="showInvent()" ><i class="fa fa-file-text" aria-hidden="true"></i> Inventory Reports</a> 
</div>
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></button>
</div>

    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <i class="fa fa-users  mb-2" style="font-size: 50px; color:#064770;"></i>
                    <h4 style="color:#000;">Total Customers</h4>
                    <h5 style="color:#000;">
                    <?php
                        $sql="SELECT * from tbl_customer where user_type=0";
                        $result=$conn-> query($sql);
                        $count=0;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                    
                                $count=$count+1;
                            }
                        }
                        echo $count;
                    ?></h5>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <i class="fa fa-th-large mb-2" style="font-size: 50px; color:#064770;"></i>
                    <h4 style="color:#000;">Total Categories</h4>
                    <h5 style="color:#000;">
                    <?php
                       
                       $sql="SELECT * from tbl_category";
                       $result=$conn-> query($sql);
                       $count=0;
                       if ($result-> num_rows > 0){
                           while ($row=$result-> fetch_assoc()) {
                   
                               $count=$count+1;
                           }
                       }
                       echo $count;
                   ?>
                   </h5>
                </div>
            </div>
            <div class="col-sm-4">
            <div class="card">
                    <i class="fa fa-th mb-2" style="font-size: 50px; color:#064770;"></i>
                    <h4 style="color:#000;">Total Products</h4>
                    <h5 style="color:#000;">
                    <?php
                       
                       $sql="SELECT * from tbl_product";
                       $result=$conn-> query($sql);
                       $count=0;
                       if ($result-> num_rows > 0){
                           while ($row=$result-> fetch_assoc()) {
                   
                               $count=$count+1;
                           }
                       }
                       echo $count;
                   ?>
                   </h5>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <i class="fa fa-list-alt" aria-hidden="true" style="font-size: 50px; color:#064770;"></i>
                    <h4 style="color:#000;">Total orders</h4>
                    <h5 style="color:#000;">
                    <?php
                       
                       $sql="SELECT * from tbl_order";
                       $result=$conn-> query($sql);
                       $count=0;
                       if ($result-> num_rows > 0){
                           while ($row=$result-> fetch_assoc()) {
                   
                               $count=$count+1;
                           }
                       }
                       echo $count;
                   ?>
                   </h5>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <i class="fa fa-rss-square" style="font-size: 50px; color:#064770;"></i>
                    <h4 style="color:#000;">Total IT Services</h4>
                    <h5 style="color:#000;">
                    <?php
                       
                       $sql="SELECT * from tbl_services";
                       $result=$conn-> query($sql);
                       $count=0;
                       if ($result-> num_rows > 0){
                           while ($row=$result-> fetch_assoc()) {
                   
                               $count=$count+1;
                           }
                       }
                       echo $count;
                   ?>
                   </h5>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <i class="fa fa-question-circle" style="font-size: 50px; color:#064770;"></i>
                    <h4 style="color:#000;">Total Inquiries</h4>
                    <h5 style="color:#000;">
                    <?php
                       
                       $sql="SELECT * from tbl_inquiry";
                       $result=$conn-> query($sql);
                       $count=0;
                       if ($result-> num_rows > 0){
                           while ($row=$result-> fetch_assoc()) {
                   
                               $count=$count+1;
                           }
                       }
                       echo $count;
                   ?>
                   </h5>
                </div>
            </div>
        </div>
        
    </div>
       
            
        <?php
            if (isset($_GET['category']) && $_GET['category'] == "success") {
                echo '<script> alert("Category Successfully Added")</script>';
            }else if (isset($_GET['category']) && $_GET['category'] == "error") {
                echo '<script> alert("Adding Unsuccess")</script>';
            }
        
        ?>


    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>    
    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
 
</html>