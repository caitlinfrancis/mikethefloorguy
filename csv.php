<?php

    include('includes/connection.php');
    include('includes/functions.php');
    include('includes/errorreporting.php');


$output = '';
if(isset($_POST["export_csv"])) {
    $sql = "SELECT * FROM invoice INNER JOIN address on address.address_id = invoice.address_id 
    INNER JOIN customer on customer.customer_id = invoice.customer_id ORDER BY invoice_id asc";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) > 0) {
        $output .= '

        <table class="table" bordered="1">
        <tr>
        <th>Invoice ID</th>
        <th>Firstname</th>
        <th>Last Name</th>
        <th>Street Address</th>
        <th>City</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Job Status</th>
        <th>Invoice Total</th>
        <th>Supplies</th>
        <th>Profitability</th>
        </tr>
        ';

        while($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>
                <td>'.$row["invoice_id"]. '</td>
                <td>'.$row["customer_fname"]. '</td>
                <td>'.$row["customer_lname"]. '</td>
                <td>'.$row["street_address"]. '</td>
                <td>'.$row["city"]. '</td>
                <td>'.$row["startdate"]. '</td>
                <td>'.$row["enddate"]. '</td>
                <td>'.$row["job_status"]. '</td>
                <td>'.$row["invoice_total"]. '</td>
                <td>'.$row["supplies"]. '</td>
                <td>'.$row["profitability"]. '</td>
            </tr> 
            
            ';
        }
        $output .= '</table>';
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
        header("Content-Disposition: attachment; filename=export.xls");
        echo $output;
    }
}

?>