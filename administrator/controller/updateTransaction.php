<!-- <?php
    include_once "../config/dbconnect.php";

    $transaction_id=$_POST['transaction_id'];
    $stocks= $_POST['stocks'];    
    $price= $_POST['price'];
    $date= $_POST['date'];

    $updateTransaction = mysqli_query($conn,"UPDATE tbl_transaction SET 
        stocks='$stocks',
        price='$price',
        date='$date',
        WHERE transaction_id=$transaction_id");


    if($updateTransaction)
    {
        echo "success";
        header("Location: ../index.php#transaction");
    }
    else
    {
        echo mysqli_error($conn);
    }
?> -->
