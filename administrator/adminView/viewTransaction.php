
<div >
  <h2>Transactions</h2>
  <table class="table ">
   
  <br>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Stocks</th>
        <th class="text-center">Price</th>
        <th class="text-center">Date</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_transaction";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["product_name"]?></td>
      <td><?=$row["stocks"]?></td>       
      <td><?=$row["price"]?></td>   
      <td><?=$row["date"]?></td>
      <td><button class="btn btn-primary" style="height:40px" onclick="editTransaction('<?=$row['transaction_id']?>')">Edit</button></td>
      </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
  </table>

   