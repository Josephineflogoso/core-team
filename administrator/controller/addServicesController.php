<?php
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['upload']))
    {   
        $ServicesName = $_POST['s_name'];
        $desc= $_POST['s_desc'];             
        $name = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
    
        $location="./assets/img";
        $image=$location.$name;

        $target_dir="../assets/img";
        $finalImage=$target_dir.$name;

        move_uploaded_file($temp,$finalImage);

        $sql="SELECT * FROM tbl_services WHERE services_name='$ServicesName'";
        $res=mysqli_query($conn, $sql);
        $count=mysqli_fetch_assoc($res);

        if($count>0)
        {
            echo "<script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Service name already exists!'
                    });
                 </script>";
        }
        else
        {

         $insert = mysqli_query($conn,"INSERT INTO tbl_services
         (services_name,image,services_desc) 
         VALUES ('$ServicesName','$image','$desc')");
 
         if(!$insert)
         {
             echo mysqli_error($conn);
         }
         else
         {
            echo "<script>
                    Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      text: 'Records added successfully!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'index.php#products';
                      }
                    });
                  </script>";            
         }
        }     
    }      
?>
