<?php 
include_once "../config/dbconnect.php";
?>

<div >
  <h3 style="font-size: 30px; font-family: Arial;">Sales Reports</h3>
  <a href="index.php"><button style="background-color: #005bff; color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-right: 10px; margin-button: 10px; align-content: center; font-size: 20px;"
  onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#005bff';">Dashboard</button></a>
  <table class="table">
    <br>
</table>

<div class="reports" style="background-color: #f2f2f2; padding: 40px; text-align: center; hover: #ff7200">
  <ul style="list-style-type: none; margin: 0; padding: 0;">
    <li style="display: inline-block;">
      <a href="./adminView/daily.php">
        <button class="daily" style="background-color: #064770; color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-right: 10px; font-size: 20px"
        onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#064770';">Daily</button>
      </a>
    </li>
    <li style="display: inline-block;">
      <a href="monthly.php">
        <button class="monthly" style="background-color: #064770; color: white; border: none; border-radius: 5px; padding: 10px 20px; margin-right: 10px; font-size: 20px"
        onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#064770';">Monthly</button>
      </a>
    </li>
    <li style="display: inline-block;">
      <a href="yearly.php">
        <button class="yearly" style="background-color: #064770; color: white; border: none; border-radius: 5px; padding: 10px 20px; font-size: 20px"
        onmouseover="this.style.backgroundColor='#ff7200'; this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#064770';">Yearly</button>
      </a>
    </li>
  </ul>
</div>
