<div >
  <h2>All Customers</h2>
  <table class="table ">
    <br>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Customer ID </th>
        <th class="text-center">Full Name </th>
        <th class="text-center">Email</th>
        <th class="text-center">Number</th>
        <th class="text-center">User Type</th>
        <th class="text-center">Date</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_customer where user_type=0";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["customer_id"]?></td>
      <td><?=$row["name"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["number"]?></td>
      <td><?=$row["user_type"]?></td>
      <td><?=$row["date"]?></td>
      
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>
