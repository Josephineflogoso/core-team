
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
      $sql="SELECT * from tbl_cart";
      $result=$conn-> query($sql);
      $count=1;
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $salesValue = $row["quantity"] * $row["price"];
          $remainingStocks = $row["stocks"] - $row["quantity"];
          $inventoryValue = $remainingStocks * $row["price"];
    ?>
    <tr>
      <td><?= $row["product_name"] ?></td> 
      <td><?= $row["stocks"] ?></td> 
      <td><?= $row["quantity"] ?></td> 
      <td><?= $remainingStocks ?></td> 
    
    </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
  </table>

   