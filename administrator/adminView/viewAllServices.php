<div>
    <h2>Services Details</h2>
    <table class="table ">
        <br>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#myModal">
            Add Services
        </button>
        <br><br>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Services name</th>
                <th class="text-center">Image</th>
                <th class="text-center">Services description</th>
                <th class="text-center">Date</th>
                <th class="text-center">Status</th>
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_services";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>

        <tr>
            <td><?=$count?></td>
            <td><?=$row["services_name"]?></td>
            <td><img height='100px' src='<?=$row["image"]?>'></td>
            <td><?=$row["services_desc"]?></td>
            <td><?=$row["uploaded_date"]?></td>
            <td><?=$row["status"]?></td>
            <td><button class="btn btn-primary" style="height:40px"
                    onclick="servicesEditForm('<?=$row['services_id']?>')">Edit</button></td>
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
                    <h4 class="modal-title">New Services</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype='multipart/form-data' onsubmit="addServices()" method="POST">
                        <div class="form-group">
                            <label for="name">Services Name:</label>
                            <input type="text" class="form-control" id="s_name" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Description:</label>
                            <input type="text" class="form-control" id="s_desc" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Choose Image:</label>
                            <input type="file" class="form-control-file" id="file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" id="upload" style="height:40px">Add
                                Services</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="height:40px">Close</button>
                </div>
            </div>

        </div>
    </div>


</div>