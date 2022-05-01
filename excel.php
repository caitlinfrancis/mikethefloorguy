<?php
include('includes/connection.php');


$output = '';
if(isset($_POST["export_excel"])) {
    $sql = "SELECT * FROM customer ORDER BY customer_id DESC";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) > 0) {
        $output .= '

        <table class="table" bordered="1">
        <tr>
        <th>Firstname</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Company</th>
        <th>Street Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Edit</th>
        </tr>
        ';

        while($row = mysqli_fetch_array($result)) {
            $output .= '
            <tr>
                <td>'.$row["customer_id"]. '</td>
                <td>'.$row["customer_fname"]. '</td>
                <td>'.$row["customer_lname"]. '</td>
                <td>'.$row["customer_email"]. '</td>
                <td>'.$row["customer_phonenum"]. '</td>
                <td>'.$row["customer_company"]. '</td>

            </tr> 
            
            ';
        }
        $output .= '</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=download.xls");
        echo $output;
    }
}


?>