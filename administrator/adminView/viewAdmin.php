<?php
include_once "../config/dbconnect.php";

$sql = "SELECT * FROM tbl_admin";
$result = $conn->query($sql);
$count = 1;
?>

<div>
  <h2>Admin</h2>
  <table class="table">
    <br>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">Add Admin</button>
    <br>
    <br>
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Admin ID</th>
        <th class="text-center">Full Name</th>
        <th class="text-center">Email</th>
        <th class="text-center">User Type</th>
        <th class="text-center">Date</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $row["admin_id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["user_type"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><button class="btn btn-primary" style="height:40px" onclick="editAdmin('<?php echo $row['admin_id']; ?>')">Edit</button></td>
          </tr>
      <?php
          $count = $count + 1;
        }
      }
      ?>
    </tbody>
  </table>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" onsubmit="addAdmin(); return false;">
            <div class="form-group">
              <label for="a_name">Full Name:</label>
              <input type="text" class="form-control" id="a_name" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="a_email" required>
            </div>
            <div class="form-group">
              <label for="pass">Password:</label>
              <input type="password" class="form-control" id="a_pass" required>
            </div>
            <div class="form-group">
              <label for="cpass">Confirm Password:</label>
              <input type="password" class="form-control" id="a_cpass" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary" id="upload" style="height:40px">Add Admin</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
