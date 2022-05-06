<?php
include('includes/connection.php');

require_once("config.php");
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
// code for print Heading of tables
$pdf->SetFont('Arial','B',12);
$ret ="SELECT * FROM customers";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$header=$query1->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query1->rowCount() > 0)
{
foreach($header as $heading) {
foreach($heading as $column_heading)
$pdf->Cell(46,12,$column_heading,1);
}}
//code for print data
$sql = "SELECT * from  customers ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row) {
$pdf->SetFont('Arial','',12);
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(46,12,$column,1);
} }
$pdf->Output();
?>