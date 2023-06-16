<div >
  <h2>Wishlist</h2>
  <table class="table ">
    <br>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Customer ID</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Price</th>
        <th class="text-center">Image</th>
        <th class="text-center">Date</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_wishlist";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["customer_id"]?></td>
      <td><?=$row["product_name"]?></td>
      <td><?=$row["price"]?></td>   
      <td><img height='100px' src='<?=$row["image"]?>'></td>
      <td><?=$row["date"]?></td>
      </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
  </table>