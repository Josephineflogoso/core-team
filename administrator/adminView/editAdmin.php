
<div class="container p-5">

<h4>Edit Admin</h4>
<?php
    include_once "../config/dbconnect.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM tbl_admin WHERE admin_id='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
      
?>
<form id="update-Admin" onsubmit="updateAdmin()" enctype='multipart/form-data'>
	<div class="form-group">
      <input type="text" class="form-control" id="admin_id" value="<?=$row1['admin_id']?>" hidden>
    </div><br>
    <div class="form-group">
      <label for="name">Full Name:</label>
      <input type="text" class="form-control" id="a_name" value="<?=$row1['name']?>" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="a_email" value="<?=$row1['email']?>" required>
    </div> 
    <div class="form-group">
      <button type="submit" style="height:40px" class="btn btn-primary">Update</button>
      </div>
  
    <?php
    		}
    	}
    ?>
  </form>

    </div>