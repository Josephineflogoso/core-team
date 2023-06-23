<?php
require_once "../TCPDF-main/tcpdf.php";
include_once "../config/dbconnect.php";

#$pdf = New TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
if (isset($_GET['date1']) && isset($_GET['date2'])) {
    $date = $_GET['date1'];
    $date1 = new DateTime($date);
    $date1 = $date1->format('F d, Y');

$date2 = $_GET['date2'];  
$date3 = new DateTime($date2);
$date3 = $date3->format('F d, Y');



    $sql = "SELECT * FROM `tbl_order` WHERE date between '$date' and '$date2' AND order_status = 'Completed'";
    $res = mysqli_query($conn, $sql);

    $pdf = new TCPDF();

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Virgo');
    $pdf->SetTitle('title');

    $pdf->SetFont('helvetica', 'b', 11);

    $pdf->AddPage();
    $pdf->Cell(0, 6, 'A&R E-commerce', 0, 1, 'C');
    $pdf->Cell(0, 6, ' Barangbang, San Remigio, Antique Philippines', 0, 1, 'C');

    $pdf->SetFont('helvetica', 'b', 13);
    $pdf->Cell(0, 10, ' DAILY SALES REPORT', 0, 1, 'C');
    $pdf->Cell(0, 8, $date1. ' to ' . $date3, 0, 1, 'C');

    $pdf->SetFont('helvetica', 'b', 11);
    $pdf->Cell(15, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Name', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Type', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Amount', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Date', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Time', 1, 0, 'C');
    $pdf->Ln();
    $sn = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $sql5="SELECT * FROM tbl_customer WHERE customer_id = $row[customer_id] ";
        $result = mysqli_query($conn, $sql5);
        $rows=mysqli_fetch_assoc($result);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(15, 10, $sn++, 1, 0, 'C');
        $pdf->Cell(40, 10, $rows['name'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['method'], 1, 0, 'C');
        $pdf->Cell(25, 10, number_format($row['total_amount'], 2), 1, 0, 'C');
        $pdf->Cell(30, 10, $row['date'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['time'], 1, 0, 'C');
        $pdf->Ln();
    }
    $sql2 = "SELECT SUM(total_amount)  AS sum from `tbl_order` where date between '$date' and '$date2' and order_status  = 'Completed'";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);
    $row2 = mysqli_fetch_assoc($res2);

    $total = number_format($row2['sum'], 2);

    $pdf->Cell(0, 10, 'Total Amount', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Php ' . $total, 0, 1, 'C');
}
$js = 'print(true);';
$pdf->IncludeJS($js);

$pdf->Output('report.pdf', 'I');


exit();
?>
