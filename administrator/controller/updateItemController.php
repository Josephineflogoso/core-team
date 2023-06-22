<?php
    include_once "../config/dbconnect.php";

    $product_id=$_POST['product_id'];
    $p_name= $_POST['p_name'];
    $p_desc= $_POST['p_desc'];
    $category= $_POST['category'];


    if( $_FILES['newImage'] == "" ){
        $image=$_POST['existingImage'];
      
    }else{
        $name = $_FILES['newImage']['name'];
        $temp = $_FILES['newImage']['tmp_name'];
        $location="./assets/img";
        $image=$location.$name;

        $target_dir="../assets/img";
        $finalImage=$target_dir.$name;

        move_uploaded_file($temp,$finalImage);
      
    }
    $updateItem = mysqli_query($conn,"UPDATE tbl_product SET 
        product_name='$p_name', 
        product_desc='$p_desc', 
        category_id=$category,
        product_image='$image' 
        WHERE product_id=$product_id");


 
    // else
    // {
    //     echo mysqli_error($conn);
    // }
?>