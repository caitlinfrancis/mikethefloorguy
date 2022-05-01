<?php

$sql = "SELECT * FROM customers";

if ($_GET['sort'] == 'customer_fname')
{
    $sql .= " ORDER BY customer_fname";
}
elseif ($_GET['sort'] == 'customer_lname')
{
    $sql .= " ORDER BY customer_lname";
}
elseif($_GET['sort'] == 'invoice_id')
{
    $sql .= " ORDER BY invoice_id";
}

?>