<?php
   session_start();
   include_once "./config/dbconnect.php";

?>
       
 <!-- nav -->
 <nav  class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #064770;">
    
    <a class="navbar-brand ml-5" href="./index.php">
        <img src="./assets/img/ar-logo.png" width="50" height="50">
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
    <div class="logout">  
        <?php           
        if(isset($_SESSION['customer_id'])){
          ?>
          <a href="../customer/logout.php" style="text-decoration:none; color:#fff; font-size:20px" class="logout">Logout</a>
          <?php
        } else {
            ?>
            
            <a href="logout.php" style="text-decoration:none; color:#fff; font-size:20px;">Logout</a>
        
            <?php
        } ?>
    </div>  
</nav>
