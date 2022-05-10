<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<?php
    session_start();

    if( !$_SESSION['loggedInUser'] ) {
    
        header("Location: login.php");
        }
        
        include('includes/connection.php');
        include('includes/functions.php');
        include('includes/errorreporting.php');
?>


<?php 

// query & result
$query = "SELECT * FROM invoice INNER JOIN address on address.address_id = invoice.address_id 
INNER JOIN customer on customer.customer_id = invoice.customer_id ORDER BY invoice_id asc";

$result = mysqli_query( $connection, $query );


// check for query string
if( isset( $_GET['alert'] ) ) {
    
  
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New invoice added<a class='close' data-dismiss='alert'>&times;</a></div>";
        
    
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Invoice updated<a class='close' data-dismiss='alert'>&times;</a></div>";
    } 
      
}


// close the mysql connection
mysqli_close($connection);


include('includes/header.php');
?>

<h1>Invoice Information</h1>


        <form action="" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Enter your search criteria"><br></br>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
     

<?php if(isset($alertMessage)){
    echo $alertMessage; 
}
?>


<table class="table table-striped table-bordered">
    <tr>
        <th style="width:10%">Invoice ID</a></th>
        <th style="width:10%">First Name</a></th>
        <th style="width:10%">Last Name</a></th>
        <th style="width:10%">Street Address</th>
        <th style="width:10%">City</th>
        <th style="width:5%">State</th>
        <th style="width:5%">Zip</th>
        <th style="width:5%">Start Date</th>
        <th style="width:5%">End Date</th>
        <th style="width:5%">Job Status</th>
        <th style="width:5%">Invoice Total</th>
        <th style="width:5%">Supply Costs</th>
        <th style="width:5%">Profitability</th>
        <th style="width:10%">Edit</th>
    </tr>

    <tbody>


    <?php 

        include('includes/connection.php');

        if(isset($_GET['search']))
        {
            $filtervalues = $_GET['search'];

            if ($filtervalues) {
                $query = "SELECT * FROM invoice INNER JOIN address on address.address_id = invoice.address_id
                INNER JOIN customer on customer.customer_id = invoice.customer_id 
                WHERE CONCAT(invoice_id,customer_fname,customer_lname,street_address,city,state,zip,startdate,enddate,job_status,invoice_total,supplies,profitability) LIKE '%$filtervalues%' ";
                $result = mysqli_query($connection, $query);


                if(mysqli_num_rows($result) > 0) {

                    while( $row = mysqli_fetch_assoc($result) ) {
                        echo "<tr>";
                        
                        echo "<td>" . $row['invoice_id'] . "</td><td>". $row['customer_fname'] . "</td><td>" . $row['customer_lname'] . "</td><td>" 
                        . $row['street_address'] . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['zip'] . "</td><td>" . $row['startdate'] . "</td>
                        <td>" . $row['enddate'] . "</td><td>" . $row['job_status'] . "</td><td>" . $row['invoice_total'] . "</td><td>" . $row['supplies'] . "</td>
                        <td>" . $row['profitability'] . "</td>";
            
                        echo '<td><a href="edit_invoice.php?id=' . $row['invoice_id'] . '" type="button" class="btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-edit"></span>
                                </a></td>';
                        
                        echo "</tr>";
            
                    }
                } else {
                    echo "<div class='alert alert-info'>No invoices to display</div>";
                }
            } else {
                $query = "SELECT * FROM invoice INNER JOIN address on address.address_id = invoice.address_id 
                INNER JOIN customer on customer.customer_id = invoice.customer_id ORDER BY invoice_id asc";
                
                $result = mysqli_query( $connection, $query );
            }
            
        }
    ?>


    <?php
    if( mysqli_num_rows($result) > 0 ) {
        
        // output the data
        
        while( $row = mysqli_fetch_assoc($result) ) {
            echo "<tr>";
            
            echo "<td>" . $row['invoice_id'] . "</td><td>". $row['customer_fname'] . "</td><td>" . $row['customer_lname'] . "</td><td>" 
            . $row['street_address'] . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['zip'] . "</td><td>" . $row['startdate'] . "</td>
            <td>" . $row['enddate'] . "</td><td>" . $row['job_status'] . "</td><td>" . $row['invoice_total'] . "</td><td>" . $row['supplies'] . "</td>
            <td>" . $row['profitability'] . "</td>";

            echo '<td><a href="edit_invoice.php?id=' . $row['invoice_id'] . '" type="button" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                    </a></td>';
            
            echo "</tr>";

        }
    } 
    
    //mysqli_close($connection);

    ?>
</tbody>
</table>

<tr>
    <td colspan="7"><div class="text-center"><a href="add_invoice.php" type="button" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Add Invoice</a></div></td>
</tr>



<div class="table-responsive">
<div id="live_data"> </div>
<form method="post" action="csv.php">
<input type="submit" name="export_csv" class="btn btn-success" value="Export to Excel" />
</form>



<?php
include('includes/footer.php');
?>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


