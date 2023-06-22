
<?php include "./headers/adminHeader.php";
    include "../config/dbconnect.php";
 ?>
<!-- Sidebar -->
<!-- <div class="sidebar" id="mySidebar">
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
    <a href="./adminView/viewAllProducts.php" ><i class="fa fa-th"></i> Products</a>
    <a href="#transaction"   onclick="showTransaction()" ><i class="fa fa-th"></i> History Transaction</a>
    <a href="#orders" onclick="showOrders()" ><i class="fa fa-list-alt" aria-hidden="true"></i> Orders</a>
    <a href="#shipping"   onclick="showShipping()" ><i class="fa fa-truck" aria-hidden="true"></i> Shipping Fees</a>
    <a href="#sale" onclick="showSale()" ><i class="fa fa-line-chart" aria-hidden="true"></i> Sales Reports</a>
    <a href="#invent" onclick="showInvent()" ><i class="fa fa-file-text" aria-hidden="true"></i> Inventory Reports</a> 
</div> -->
<!--  
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></button>
</div> -->

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


