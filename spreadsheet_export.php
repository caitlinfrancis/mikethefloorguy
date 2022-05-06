<?php
include('includes/connection.php');

try {
  $pdo = new PDO(
    "mysql:host=$server;dbname=$db",
    $username, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
    ]
  );
} catch (Exception $ex) { exit($ex->getMessage()); }

// (B) HTTP CSV HEADERS
header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"export.csv\"");
 
// (C) GET USERS FROM DATABASE + DIRECT OUTPUT
$stmt = $pdo->prepare("SELECT * FROM `customer`");
$stmt->execute();
while ($row = $stmt->fetch()) {
  echo implode(",", [$row["customer_id"], $row["customer_email"], $row["customer_fname"]]);
  echo "\r\n";
}