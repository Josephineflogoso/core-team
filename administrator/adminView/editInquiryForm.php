
<div class="container p-5">

<h4>Edit Inquiry status</h4>
<?php
    include_once "../config/dbconnect.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM tbl_inquiry WHERE inquiry_id='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
?>
<form id="update-Inquiry" onsubmit="updateInquiry()" enctype='multipart/form-data'>
    <div class="form-group">
      <label>Status:</label>
        <select id="status">
          <option select>Pending</option>
          <option select>Approve</option>
          <option select>Decline</option>
        </select>
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