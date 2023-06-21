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
      $sql="SELECT * from tbl_availed a inner join tbl_customer c on a.customer_id = c.customer_id";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $code=$row['transac_code'];
    ?>

    <tr>
    <td><?=$count?></td>
      <td><?=$row["name"]?></td>
      <td>
        <?php
        $getInquiry = mysqli_query($conn, "SELECT * FROM tbl_inquiry WHERE customer_id = $row[customer_id] and transac_code = '$code'");
        while($inquiryRow=mysqli_fetch_assoc($getInquiry))
        {
          ?><ul style="text-align:left;">
          <li><?php echo $inquiryRow['services_name']; ?></span></li>
          </ul>
          <?php
        }
        ?>
      </td>
      <td><?=$row["purok"]?>, <?=$row["barangay"]?>, <?=$row["municipality"]?>, <?=$row["province"]?></td>     
      <td><?=$row["date"]?></td>    
       
     
      <?php 
                if($row["status"]==0){
                            
            ?>
                <td><button class="btn btn-danger" onclick="ChangeStatus('<?=$row['avail_id']?>',1)">Pending </button></td>
            <?php
                        
                }else if ($row["status"] == 1){
            ?>
                <td><button class="btn btn-warning" onclick="ChangeStatus('<?=$row['avail_id']?>',2)">Ongoing</button></td>
        
            <?php
                }
                else
                {
                  ?>
                  <td><button class="btn btn-success">Completed</button></td>
          
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