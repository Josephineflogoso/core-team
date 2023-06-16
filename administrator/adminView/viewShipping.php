
<div >
  <h3>Shipping Fees</h3>
  <table class="table ">
  <br>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Barangay</th>
        <th class="text-center">Municipality</th>
        <th class="text-center">Shipping cost</th>
        <th class="text-center">Date</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_shipping_fees";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["barangay"]?></td> 
      <td><?=$row["municipality"]?></td> 
      <td><?=$row["shipping_cost"]?></td> 
      <td><?=$row["shipping_date"]?></td> 
      <td><button class="btn btn-primary" style="height:40px" onclick="editShipping('<?=$row['shipping_id']?>')">Edit</button></td>
    
      </tr>
      <?php
            $count=$count+1;
          }
        }
      ?>
  </table>


   <!-- Modal -->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Shipping Fee</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  enctype='multipart/form-data' onsubmit="addShipping()" method="POST">
            <div class="form-group">
              <label for="barangay">Barangay:</label>
              <input type="text" class="form-control" id="barangay" required>
            </div>
            <div class="form-group">
              <label for="municipality">Municipality:</label>
              <input type="text" class="form-control" id="municipality" required>
            </div>
            <div class="form-group">
              <label for="shipping_cost">Shipping Cost</label>
              <input type="number" class="form-control" id="shipping_cost" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary" id="upload" style="height:40px">Add Shipping</button>
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  
</div>

   