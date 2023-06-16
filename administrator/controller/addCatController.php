<?php
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['upload']))
    {
       
        $catname = $_POST['c_name'];
        $sql="SELECT * FROM tbl_category WHERE category_name='$catname'";
        $res=mysqli_query($conn, $sql);
        $count=mysqli_fetch_assoc($res);
        if($count>0)
        {
            echo "Category name already exist";
        }
        else
        {
            $insert = mysqli_query($conn,"INSERT INTO tbl_category
            (category_name) 
            VALUES ('$catname')");
    
            if(!$insert)
            {
                echo mysqli_error($conn);
                header("Location: ../index.php#category");
            }
            else
            {
                echo "Records added successfully.";
                header("Location: ../index.php#category");
            }
        }
       
        
     
    }
        
?>