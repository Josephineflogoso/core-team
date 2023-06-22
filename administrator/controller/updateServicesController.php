<?php
    include_once "../config/dbconnect.php";
    // Include SweetAlert2 library
    include_once "../assets/js/sweetalert2.all.min.js";

    $services_id=$_POST['services_id'];
    $s_name= $_POST['s_name'];
    $s_desc= $_POST['s_desc'];
    $status= $_POST['status'];


    if($_FILES['newImage'] =='' ){
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
    $updateItem = mysqli_query($conn,"UPDATE tbl_services SET 
        services_name='$s_name', 
        services_desc='$s_desc', 
        status='$status',
        image='$image' 
        WHERE services_id=$services_id");


    if($updateItem)
    {
        // Show SweetAlert2 success message
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Record updated successfully!'
                }).then(function() {
                    window.location = '../index.php#products';
                });
              </script>";
    }
    else
    {
        // Show SweetAlert2 error message
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating the record'
                });
              </script>";
    }
?>
