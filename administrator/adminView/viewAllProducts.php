<div>
    <h2>Product Items</h2>
    <table class="table ">
        <br>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal"
            data-target="#myModal">Add Product</button>
        <br>
        <br>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Product Image</th>
                <th class="text-center">Product Description</th>
                <th class="text-center">Stocks</th>
                <th class="text-center">Category</th>
                <th class="text-center">Price</th>
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from tbl_product, tbl_category 
      WHERE tbl_product.category_id=tbl_category.category_id";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
            $productId = $row["product_id"];
        $currentStocks = $row["stocks"];
        
      
    ?>
        <tr>
            <td><?=$count?></td>
            <td><?=$row["product_name"]?></td>
            <td><img height='100px' src='<?=$row["product_image"]?>'></td>
            <td><?=$row["product_desc"]?></td>
            <td><?=$row["stocks"]?></td>
            <td><?=$row["category_name"]?></td>
            <td><?=$row["price"]?></td>
            <td>
                <?php
                if($row['stocks'] <= 0)
                {
                    ?>
                     <button class="btn btn-primary" style="height:40px"
                    onclick="getStocks('<?=$row['product_id']?>')">Get Stocks</button>
                    <button class="btn btn-primary" style="height:40px"
                    onclick="itemEditForm('<?=$row['product_id']?>')">Edit</button>
                    <?php
                } 
                else
                {
                    ?>
 <button class="btn btn-primary" style="height:40px"
                    onclick="itemEditForm('<?=$row['product_id']?>')">Edit</button>
                    <?php
                }
                ?>
                </td>
               
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
                    <h4 class="modal-title">New Product Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form enctype='multipart/form-data' onsubmit="addItems()" method="POST">
                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" id="p_name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="p_price" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Description:</label>
                            <input type="text" class="form-control" id="p_desc" required>
                        </div>
                        <div class="form-group">
                            <label for="stocks">Stocks:</label>
                            <input type="number" class="form-control" id="stocks" required>
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <select id="category" required>
                                <option disabled selected>Select category</option>
                                <?php

                  $sql="SELECT * from tbl_category";
                  $result = $conn-> query($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      echo"<option value='".$row['category_id']."'>".$row['category_name'] ."</option>";
                    }
                  }
                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Choose Image:</label>
                            <input type="file" class="form-control-file" id="file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" id="upload" style="height:40px">Add
                                Item</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>


</div>