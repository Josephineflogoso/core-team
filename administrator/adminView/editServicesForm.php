
<div class="container p-5">

<h4>Edit Services Detail</h4>
<?php
    include_once "../config/dbconnect.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM tbl_services WHERE services_id='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
?>
<form id="update-Services" onsubmit="updateServices()" enctype='multipart/form-data'>
	<div class="form-group">
      <input type="text" class="form-control" id="services_id" value="<?=$row1['services_id']?>" hidden>
    </div>
    <div class="form-group">
      <label for="name">Services name:</label>
      <input type="text" class="form-control" id="s_name" value="<?=$row1['services_name']?>">
    </div>
    <div class="form-group">
      <label for="desc">Services description:</label>
      <input type="text" class="form-control" id="s_desc" value="<?=$row1['services_desc']?>">
    </div>
    <div class="form-group">
      <label>Status:</label>
        <select id="status">
          <option select>Available</option>
          <option select>Not available</option>
        </select>
    </div>
      <div class="form-group">
        
         <img width='200px' height='150px' src='<?=$row1["image"]?>'>
         <div>
            <label for="file">Choose Image:</label>
            <input type="text" id="existingImage" class="form-control" value="<?=$row1['image']?>" hidden>
            <input type="file" id="newImage" value="">
         </div>
    </div>
   
    <div class="form-group">
  <button type="submit" style="height:40px" class="btn btn-primary" onclick="updateServices();">Update Services</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
    <?php
    		}
    	}
    ?>
  </form>

    </div>