<?php include('viewSales.php') ?>

<div class="calendar">

<form action="" method="post" style="display: flex; align-items: center; justify-content: center; margin: 20px; font-size: 20px; font-family: Arial;">
    <select name="year" id="month" class="date" required style="margin-right: 10px; padding: 5px; font-size: 20px; font-family: Arial;">
            <option value="0">Select Year</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
            <option value="2031">2031</option>
            <option value="2032">2032</option>
            <option value="2033">2033</option>
            <option value="2034">2034</option>
        </select>

        <button class="search" name="submit" style="background-color: #000; color: white; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; font-size: 20px; font-family: Arial;" 
        onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';"
        onmouseout="this.style.backgroundColor='#000';">
        Search
    </button>        
   
    <?php
        if(isset($_POST['year']))
        {
            $year = $_POST['year'];
        }
        else
        {
            $year = date('Y');
        }
    ?>
     <a href="yearprint.php" style="margin-left: 10px; ">
    <button class="print"
    style="background-color: #000; color: white; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer; font-size: 20px; font-family: Arial;" 
    onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#000';">Print Reports</button></a>
    </form>
</div>  

<div class="ban" style="margin: 20px;">
    <h2 style="text-align: center; font-size: 24px; font-family: Arial;">Yearly Reports</h2>
    <table class="dex" style="width: 100%; margin-top: 20px;">
    <colgroup>
                    
            <col width=20%>
            <col width=20%>
            <col width=20%>
            <col width=20%>                     
                              
     </colgroup>


            <?php
            
            

                if(isset($_POST['submit']))
                {
                        if($_POST['year'] > 0)
                    {
        
                        $current_year = $_POST['year'];
                        $sn=1;
        
                        $sql = "SELECT DATE(date) as `date`, COUNT(*) as `total_orders`, SUM(total) as `total_sales` FROM `tbl_order` WHERE  YEAR(date) = $current_year and status != 0 GROUP BY MONTH(date)";
                        $result = $conn->query($sql);
                        $count = mysqli_num_rows($result);
                        if ($count > 0)
                        {
        
                            ?>
                                    <thead>
                                        <tr>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">No.</th>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">Date</th>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">Total Orders</th>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">Total Sales</th>
                                        </tr>
                                    </thead>
                            <?php
        
                            $orders = [];
                            while ($row = $result->fetch_assoc())
                            {
                                $orders[$row['date']] = ['total_orders' => $row['total_orders'], 'total_sales' => $row['total_sales'],];
                            }
        
                            foreach ($orders as $date => $order)
                            {
                                $date1 = new DateTime($date);
                                $date = $date1->format('F, Y');
                                ?>
        
                                    <tbody>
                                        <tr>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $sn++; ?></td>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $date; ?></td>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $order['total_orders']; ?></td>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo number_format ($order['total_sales'],2); ?></td>
                                        </tr>
                                    </tbody>
        
                                <?php
                            }
        
                        }
                    }
                }
                else
                {
                   
                    $current_year = date('Y');
                    $sn=1;
                    $sql = "SELECT DATE(date) as `date`, COUNT(*) as `total_orders`, SUM(total) as `total_sales` FROM `order` WHERE  YEAR(date) = $current_year and status != 0 GROUP BY MONTH(date)";
                        $result = $conn->query($sql);
                        $count = mysqli_num_rows($result);
                        if ($count > 0)
                        {
        
                            ?>
                                    <thead>
                                        <tr>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">No.</th>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">Date</th>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">Total Orders</th>
                                            <th style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;">Total Sales</th>
                                        </tr>
                                    </thead>
                            <?php
        
                            $orders = [];
                            while ($row = $result->fetch_assoc())
                            {
                                $orders[$row['date']] = ['total_orders' => $row['total_orders'], 'total_sales' => $row['total_sales'],];
                            }
        
                            foreach ($orders as $date => $order)
                            {
                                $date1 = new DateTime($date);
                                $date = $date1->format('F, Y');
                                ?>
        
                                    <tbody>
                                        <tr>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $sn++; ?></td>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $date; ?></td>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo $order['total_orders']; ?></td>
                                            <td style="padding: 10px; text-align: center; font-size: 16px; font-family: Arial;"><?php echo number_format ($order['total_sales'],2); ?></td>
                                        </tr>
                                    </tbody>
        
                                <?php
                            }
        
                        }
                }
            
            ?> 

    </table>
</div>
<br>





<?php

    if(isset($_POST['submit']))
    {
        $current_year=$_POST['year'];
        $sql = "SELECT  SUM(total) as `total_sales` FROM `order` WHERE YEAR(date) = $current_year and status != 0 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        ?>
            <h3 class="ttl_sales" style="font-size: 20px; font-family: Arial;">Total Sales: ₱<?php echo number_format($row['total_sales'],2); ?></h3>
        <?php
    }
    else
    {
        $current_year = date('Y');
        $sql = "SELECT  SUM(total) as `total_sales` FROM `order` WHERE YEAR(date) = $current_year and status != 0 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        ?>
            <h3 class="ttl_sales" style="font-size: 20px; font-family: Arial;">Yearly Total Sales: ₱<?php echo number_format($row['total_sales'],2); ?></h3>
        <?php
    }

?>


