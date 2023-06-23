<?php  include_once "../config/dbconnect.php"; 
session_start();
$date1 = $_POST['date1'];
$newDate1 = new DateTime($date1);
$newDate1 = $newDate1->format('F d, Y'); 

$date2 = $_POST['date2'];
$newDate2 = new DateTime($date2);
$newDate2= $newDate2->format('F d, Y');

?>


<div id="ordersBtn" >
    <div style="display:flex; justify-content:space-between;">
  <h2>Daily Sales</h2>
  <h2>From:<?php echo $newDate1; ?> To: <?php echo $newDate2; ?>  </h2>
  <a href="adminView/dailyprint.php?date1=<?php echo $date1; ?> & date2=<?php echo $date2; ?>"><button class="btn btn-primary">Print</button></a>
  </div>
  <span>From: </span><input type="date" id = "dateInput1" name = "date">
  <span>To: </span><input type="date" id = "dateInput2" name = "date">
  <input type="submit" class="btn btn-primary" value="Sort" name="submit" onclick="(function() {
    var date1 = document.getElementById('dateInput1').value;
    var date2 = document.getElementById('dateInput2').value;
    if (date1 && date2) {
        showSale(date1, date2);
    }
})()" disabled>



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
     </tr>
    </thead>
    <tbody>
     <?php
      $sql="SELECT * from tbl_order where order_status = 'Completed' and date between '$date1' and '$date2'";
      $result=$conn-> query($sql);
      
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $id=$row['customer_id'];
          $Oid=$row['order_id'];
          $tcode = $row['transac_code'];
    ?>

       <tr>
          <td><?=$row["order_id"]?></td>
          <?php 
          $sql="SELECT * FROM tbl_customer WHERE customer_id = $id ";
          $res = mysqli_query($conn, $sql);
          $rows=mysqli_fetch_assoc($res);
          
          ?>
          <td><?php echo $rows['name']; ?></td>   
          <td><?php echo $rows['number']; ?></td>    
          <td><?php echo $rows['email']; ?></td>    
          <td><?=number_format($row["total_amount"],2);?></td>   
          <td><?=$row["method"]?></td>     
          <td><?=$row["date"]?></td> 
          <td><?=$row["time"]?></td> 
       </tr>
         
         
        <?php
        }
        $getSales=mysqli_query($conn,"SELECT SUM(total_amount) as total_amount from tbl_order WHERE order_status = 'Completed' and date between '$date1' and '$date2'");
        $rows = mysqli_fetch_assoc($getSales);
        ?>
        <tr>
            <td colspan="8" style="font-weight:bolder;">Total Sales: <?php echo number_format($rows['total_amount'],2); ?></td>
        </tr>
        <?php
    }
    else
    {
        ?>
        <div style = "position:absolute; font-style:italic;color:gray;top:50%;left:50%;transform:translate(-50%,-50%);"><h1>No orders yet!</h1></div>
        </tbody>
        <?php
    }
        ?>

  </div>
  <script>
     document.getElementById('dateInput1').addEventListener('input', toggleSortButton);
  document.getElementById('dateInput2').addEventListener('input', toggleSortButton);

  function toggleSortButton() {
    var date1 = document.getElementById('dateInput1').value;
    var date2 = document.getElementById('dateInput2').value;
    var sortButton = document.querySelector('input[name="submit"]');
    if (date1 && date2) {
        sortButton.disabled = false;
    } else {
        sortButton.disabled = true;
    }
  }
  </script>

