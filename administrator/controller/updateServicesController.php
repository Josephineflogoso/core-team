<?php
    include_once "../config/dbconnect.php";
    // Include SweetAlert2 library
    include_once "../assets/js/sweetalert2.all.min.js";

    $services_id=$_POST['services_id'];
    $s_name= $_POST['s_name'];
    $s_desc= $_POST['s_desc'];
    $status= $_POST['status'];


    if( isset($_FILES['newImage']) ){
        
        $location="./assets/img";
        $img = $_FILES['newImage']['name'];
        $tmp = $_FILES['newImage']['tmp_name'];
        $dir = '../assets/img';
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','webp');
        $image =rand(1000,1000000).".".$ext;
        $final_image=$location. $image;
        if (in_array($ext, $valid_extensions)) {
            $path = UPLOAD_PATH . $image;
            move_uploaded_file($tmp, $dir.$image);
        }
    }else{
        $final_image=$_POST['existingImage'];
    }
    $updateItem = mysqli_query($conn,"UPDATE tbl_services SET 
        services_name='$s_name', 
        services_desc='$s_desc', 
        status='$status',
        image='$final_image' 
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
