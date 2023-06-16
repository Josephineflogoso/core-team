
<div class="container p-5">

<h4>Edit Shipping</h4>
<?php
    include_once "../config/dbconnect.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM tbl_shipping_fees WHERE shipping_id='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
      
?>
<form id="update-shipping" onsubmit="updateShipping()" enctype='multipart/form-data'>
	<div class="form-group">
      <input type="text" class="form-control" id="shipping_id" value="<?=$row1['shipping_id']?>" hidden>
    </div><br>
    <div class="form-group">
      <label for="municipality">Municipality:</label>
      <input type="text" class="form-control" id="municipality" value="<?=$row1['municipality']?>" required>
    </div>
    <div class="form-group">
      <label for="barangay">Barangay:</label>
      <input type="text" class="form-control" id="barangay" value="<?=$row1['barangay']?>" required>
    </div>
    <div class="form-group">
      <label for="shipping_cost">Sipping cost:</label>
      <input type="number" class="form-control" id="shipping_cost" value="<?=$row1['shipping_cost']?>" required>
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