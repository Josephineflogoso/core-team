<?php
    include_once "../config/dbconnect.php";
    

       
        $ProductName = $_POST['p_name'];
        $desc= $_POST['p_desc']; 
        $stocks= $_POST['stocks'];
        $price = $_POST['p_price'];      
        $category = $_POST['category'];            
        $name = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
    
        $location="./assets/img";
        $image=$location.$name;

        $target_dir="../assets/img";
        $finalImage=$target_dir.$name;

        move_uploaded_file($temp,$finalImage);

        $sql="SELECT * FROM tbl_product WHERE product_name='$ProductName'";
        $res=mysqli_query($conn, $sql);
        $count=mysqli_fetch_assoc($res);
        if($count>0)
        {
            echo "Product name already exist";
        }
        else
        {

         $insert = mysqli_query($conn,"INSERT INTO tbl_product
         (product_name,product_image,stocks,price,product_desc,category_id) 
         VALUES ('$ProductName','$image','$stocks','$price','$desc','$category')");
 
         if(!$insert)
         {
             echo mysqli_error($conn);
         }
         else
         {
            $productId = mysqli_insert_id($conn);
            $insertTransaction = mysqli_query($conn, "INSERT INTO tbl_transaction (product_id, stock_price) VALUES ($productId, $price)");
            
         }
        }
?>