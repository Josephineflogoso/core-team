
<div class="container p-5">

<h4>Edit Transaction</h4>
<?php
    include_once "../config/dbconnect.php";
	$ID=$_POST['record'];
	$qry=mysqli_query($conn, "SELECT * FROM tbl_transaction WHERE product_id='$ID'");
	$numberOfRow=mysqli_num_rows($qry);
	if($numberOfRow>0){
		while($row1=mysqli_fetch_array($qry)){
?>
<form id="update-transaction" onsubmit="updateTransaction()" enctype='multipart/form-data'>
	<div class="form-group">
      <input type="text" class="form-control" id="product_id" value="<?=$row1['product_id']?>" hidden>
    </div>
    <div class="form-group">
      <label for="stocks">Stocks:</label>
      <input type="number" class="form-control" id="stock" value="<?=$row1['stock']?>" required>
    </div>
    <div class="form-group">
      <label for="price">Unit Price:</label>
      <input type="number" class="form-control" id="price" value="<?=$row1['price']?>" required>
    </div>
    <div class="form-group">
      <label for="date">Date:</label>
      <input type="date" class="form-control" id="date" value="<?=$row1['date']?>">
    </div>
    <div class="form-group">
      <button type="submit" style="height:40px" class="btn btn-primary">Update Item</button>
    </div>
  
    <?php
    		}
    	}
    ?>
  </form>

    </div>