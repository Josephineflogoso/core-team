<div >
  <h2>Inquiries</h2>
  <table class="table ">
    <br>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Customer ID</th>
        <th class="text-center">Services name</th>
        <th class="text-center">Address</th>
        <th class="text-center">Date</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_availed";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>

    <tr>
    <td><?=$count?></td>
      <td><?=$row["customer_id"]?></td>
      <td><?=$row["services_name"]?></td>
      <td><?=$row["purok"]?>, <?=$row["barangay"]?>, <?=$row["municipality"]?>, <?=$row["province"]?></td>     
      <td><?=$row["date"]?></td>    
       
     
      <?php 
                if($row["status"]==0){
                            
            ?>
                <td><button class="btn btn-danger" onclick="ChangeStatus('<?=$row['id']?>')">Pending </button></td>
            <?php
                        
                }else{
            ?>
                <td><button class="btn btn-success" onclick="ChangeStatus('<?=$row['id']?>')">Complete</button></td>
        
            <?php
                }
            ?>
      </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
        
  </table>