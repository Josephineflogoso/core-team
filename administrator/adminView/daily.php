<?php include('viewSales.php') ?>


<div class="calendar"
    style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #f2f2f2;">
    <form action="" method="post" style="display: flex; align-items: center;">
        <input type="date" name="date1" class="date" style="padding: 5px; margin-right: 5px; border-radius: 5px; font-size: 16px; font-family: Arial;">
        <span class="to" style="margin-right: 5px; font-size: 16px; font-family: Arial;">to</span>
        <input type="date" name="date2" class="date" style="padding: 5px; margin-right: 5px; border-radius: 5px; font-size: 16px; font-family: Arial;">
        <button class="search" name="submit"
            style="padding: 5px 10px; border: none; border-radius: 5px; background-color: #000; color: white; font-size: 20px; font-family: Arial;"
            onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';" 
            onmouseout="this.style.backgroundColor='#000';">Search</button> 
    </form> 
 
 
    <?php 
     
    if(isset($_POST['submit'])) 
    { 
        $date1 = new DateTime($_POST['date1']); 
        $date1 = $date1->format('Y-m-d'); 
        $date2 = new DateTime($_POST['date2']); 
        $date2 = $date2->format('Y-m-d'); 
    } 
    else 
    { 
        $date1=date('Y-m-d'); 
        $date2=date('Y-m-d'); 
    } 
 
    ?> 
 
 
    <a href="dailyprint.php?date1=<?php  echo$date1; ?> & date2=<?php  echo$date2; ?>" style="text-decoration: none;"><button class="print" 
            style="padding: 5px 10px; border: none; border-radius: 5px; background-color: #000; color: white; font-size: 20px; font-family: Arial;"
            onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';"
            onmouseout="this.style.backgroundColor='#000';">Print Reports</button></a>
</div>

<div class="day" style="padding: 20px;">
    <h2 style="text-align: center; margin-bottom: 20px; font-size: 24px; font-family: Arial;">Daily Reports</h2>
    <table class="flex" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: rgb(218, 221, 221); color: #000;">
                <th style="padding: 10px; font-size: 16px; font-family: Arial;">No.</th>
                <th style="padding: 10px; font-size: 16px; font-family: Arial;">Customer ID</th>
                <th style="padding: 10px; font-size: 16px; font-family: Arial;">Amount Payed</th>
                <th style="padding: 10px; font-size: 16px; font-family: Arial;">Date</th>
                <th style="padding: 10px; font-size: 16px; font-family: Arial;">Time</th>
            </tr>


                <?php
                
                if(isset($_POST['submit']))
                {
                    $date1= new DateTime($_POST['date1']);
                    $date1 = $date1->format('Y-m-d');
                    $date2= new DateTime($_POST['date2']);
                    $date2 = $date2->format('Y-m-d');
                    $sql = "SELECT * FROM tbl_order WHERE date between '$date1' and '$date2' and status=1";
                    $result=mysqli_query($conn, $sql);
                    $sn=1;
                    while($row=mysqli_fetch_assoc($result))
                    {
                        ?>

                             <tr>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $sn++ ?>.</td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $row['firstname'].$row['lastname']; ?></td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $row['total_price']; ?></td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $row['date']; ?></td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $row['time']; ?></td>
                             </tr>

                        <?php
                    }

                }
                else
                {
                    $date=date('Y-m-d');

                    $sql="SELECT * FROM tbl_order WHERE date='$date' and order_status=1";
                    $result=mysqli_query($conn, $sql);
                    $sn=1;
                    while($row=mysqli_fetch_assoc($result))
                    {
                        ?>

                             <tr>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $sn++ ?>.</td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $row['customer_id']; ?></td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">₱<?php echo $row['total_amount']; ?></td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $row['date']; ?></td>
                                <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $row['time']; ?></td>
                             </tr>

                        <?php
                    }
                }
                
                ?>  
            
        </thead>
    </table>
</div>

<h3 class="tsales" style="text-align: center; margin-top: 20px; font-family: Arial;">Total Sales: ₱92</h3>
<h3 class="tsales" style="text-align: center; margin-top: 20px; font-family: Arial;">Daily Total Sales: ₱92</h3>
