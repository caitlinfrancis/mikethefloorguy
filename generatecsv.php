<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    header("Location: login.php");
}

include('includes/connection.php');

// (B) HTTP CSV HEADERS
header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"export.csv\"");
 
// (C) GET USERS FROM DATABASE + DIRECT OUTPUT
$query = "SELECT * FROM invoice INNER JOIN address on address.address_id = invoice.address_id 
INNER JOIN customer on customer.customer_id = invoice.customer_id ORDER BY invoice_id asc";
$result = mysqli_query( $connection, $query );

$query = mysqli_query();
while ($row = $query->fetch()) {
  echo implode(",", [$row["customer_id"], $row["customer_email"], $row["customer_fname"]]);
  echo "\r\n";
}