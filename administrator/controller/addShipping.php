<?php
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['upload']))
    {
       
        $barangay = $_POST['barangay'];
        $municipality= $_POST['municipality'];      
        $shipping_cost = $_POST['shipping_cost'];            

         $insert = mysqli_query($conn,"INSERT INTO tbl_shipping_fees
         (barangay,municipality,shipping_cost) 
         VALUES ('$barangay','$municipality','$shipping_cost')");
 
         if(!$insert)
         {
             echo mysqli_error($conn);
         }
         else
         {
            echo "<script>alert('Records added successfully...!')</script>";
            echo "<script>window.location = 'index.php#shipping'</script>";
            
         }
        }
     
    
        
?>