<?php  include_once "../config/dbconnect.php"; 
session_start();

?>


<div id="ordersBtn" >
  <h2>Order Details</h2>





  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>number</th>
        <th>email</th>
        <th>Total price</th>
        <th>Order method</th>
        <th>Date</th>
        <th>Time</th>
        <th class="text-center" colspan="3">Actions</th>
     </tr>
    </thead>
    
     <?php
      $sql="SELECT * from tbl_order";
      $result=$conn-> query($sql);
      $sn=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $id=$row['customer_id'];
          $Oid=$row['order_id'];
          $tcode = $row['transac_code'];
    ?>
       <tr>
          <td><?=$sn++;?></td>
          <?php 
          $sql="SELECT * FROM tbl_customer WHERE customer_id = $id ";
          $res = mysqli_query($conn, $sql);
          $rows=mysqli_fetch_assoc($res);
          
          ?>
          <td><?php echo $rows['name']; ?></td>   
          <td><?php echo $rows['number']; ?></td>    
          <td><?php echo $rows['email']; ?></td>    
          <td><?=$row["total_price"]?></td>   
          <td><?=$row["method"]?></td>     
          <td><?=$row["date"]?></td> 
          <td><?=$row["time"]?></td> 
          <?php
          if($row['order_status'] == 'Cancelled')
          {
            ?>
               <td colspan="2"><button class="btn btn-danger">Cancelled</button></td>
            <?php
          }
          else
          {
            if($row['order_status'] == 'Pending')
            {
              ?>
                <td><button class="btn btn-warning" onclick="ChangeOrderStatus('<?=$row['order_id']?>','Completed')">Pending</button></td>
              <?php
            }
            else if($row['order_status'] == 'Completed')
            {
              ?>
                 <td colspan ="2"><button class="btn btn-success">Completed</button></td>
              <?php
            }
            if($row['order_status'] == 'Pending')
            {
              ?>
               <td><button class="btn btn-danger" onclick="ChangeOrderStatus('<?=$row['order_id']?>','Cancelled')">Cancel</button></td>
              <?php
            }
            else
            {
              echo "";
            }
          }

        

          ?>
         
         
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $tcode; ?>">View</button>
          <!-- Modal -->
<div class="modal fade" id="<?php echo $tcode; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      
      <h4 class="modal-title">Order Details</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="order-view-modal modal-body">
    
    <?php
  
  $sql1="SELECT * from tbl_order WHERE customer_id = $id";
  $result1=$conn->query($sql1);
  $row1=mysqli_fetch_assoc($result1);
?>
<h3>Address: </h3>
<p><?=$row["purok"]?>, <?=$row["barangay"]?>, <?=$row["municipality"]?>, <?=$row["province"]?></p>
<table class="table table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Product Image</th>
      <th>Product Name</th>
      <th>Quantity</th>
    </tr>
  </thead>
  <?php
    $sql2="SELECT * from tbl_cart WHERE transac_code= '$tcode'";
    $result2=$conn->query($sql2);
    $count=1;
    if ($result2-> num_rows > 0){
      while ($row2=$result2->fetch_assoc()) {
  ?>
  <tr>
    <td><?=$count?></td>
    <td><img height='100px' src='<?=$row2["image"]?>'></td>
    <td><?=$row2["product_name"]?></td> 
    <td><?=$row2["quantity"]?></td> 
  </tr>
  <?php
        $count=$count+1;
      }
    }
  ?>
</table>
</div>

    </div>
  </div><!--/ Modal content-->
</div><!-- /Modal dialog-->
</div>
          
          </td>        </tr>
    <?php
            
        }
      }
    ?>
     
  </table>

  </div>

