
<div >
  <h3>Inventory Reports</h3>
  <table class="table ">
    <br>
    <thead>
      <tr>
        <th class="text-center">Product name</th>
        <th class="text-center">Quantity on hand</th>
        <th class="text-center">Sold quantity</th>
        <th class="text-center">Remaining stocks</th> 
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_product";
      $result=$conn-> query($sql);
      $count=1;
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $getQuantity=mysqli_query($conn,"SELECT SUM(quantity) as quantity FROM tbl_cart WHERE product_name = '$row[product_name]' AND status = 1 ");
          $count = mysqli_fetch_assoc($getQuantity);
  
    ?>
    <tr>
      <td><?= $row["product_name"] ?></td> 
      <td><?= $count["quantity"] + $row['stocks'] ?></td> 
      <td><?= $count["quantity"] ?></td> 
      <td><?= $row["stocks"] ?></td> 
     
    
    </tr>
      <?php
          }
        }
      ?>
  </table>

   