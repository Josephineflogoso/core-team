<?php  include_once "../config/dbconnect.php"; 
session_start();
$month = $_POST['month'];
$newMonth = new DateTime($month);
$newMonth = $newMonth->format('F Y'); 

$month1 = new DateTime($month);
$month1 = $month1->format('m');

$year = new DateTime($month);
$year = $year->format('Y');


?>


<div id="ordersBtn" >
    <div style="display:flex; justify-content:space-between;">
  <h2>Monthly Sales</h2>
  <h5><?php echo $newMonth ?>  </h5>
  <a href="adminView/monthlyprint.php?month=<?php echo $month1; ?> & year= <?php echo $year; ?>"><button class="btn btn-primary">Print</button></a>
  </div>
  <span>Select Month: </span><input type="month" id = "dateInput" name = "date">
  <input type="submit" class="btn btn-primary" value="Sort" name="submit" onclick="(function() {
    var month = document.getElementById('dateInput').value;

    if (month) {
        showMonth(month);
    }
})()" disabled>



  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Date</th>
        <th>Total Daily Sales</th>
        <th>Total Order</th>
     </tr>
    </thead>
    <tbody>
     <?php
       $sql = "SELECT DATE(date) as order_date, COUNT(*) as total_orders, SUM(total_amount) as total_sales FROM tbl_order WHERE MONTH(date) = '$month1' AND YEAR(date) = '$year' and order_status = 'Completed' GROUP BY date";
       $result = $conn->query($sql);
      $sn=1;
      if ($result-> num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            $orders[$row['order_date']] = [
                'total_orders' => $row['total_orders'],
                'total_sales' => number_format($row['total_sales'],2),
            ];
        }
        foreach ($orders as $date => $order) {
            $date1 = new DateTime($date);
            $date1 = $date1->format('F d, Y');
    ?>

       <tr>
          <td><?=$sn++?></td>
          <td><?php echo $date1; ?></td>   
          <td><?php echo $order['total_sales']; ?></td>    
          <td><?php echo $order['total_orders']; ?></td>    
       </tr>
         
         
        <?php
        }
        $getSales=mysqli_query($conn,"SELECT SUM(total_amount) as total_amount from tbl_order WHERE order_status = 'Completed' and MONTH(date) = '$month1' AND YEAR(date) = '$year'");
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
  document.getElementById('dateInput').addEventListener('input', toggleSortButton);

  function toggleSortButton() {
    var month = document.getElementById('dateInput').value;
    var sortButton = document.querySelector('input[name="submit"]');
    if (month) {
        sortButton.disabled = false;
    } else {
        sortButton.disabled = true;
    }
  }
  </script>

