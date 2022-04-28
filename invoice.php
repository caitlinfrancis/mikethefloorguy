<?php
    session_start();
?>


<?php  if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
   header("Location: index.php");
}

// connect to database
include('includes/connection.php');
include('includes/errorreporting.php');

// query & result
$query = "SELECT * FROM quote_invoice";
$result = mysqli_query( $connection, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
  
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New quote/invoice information added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Quote/invoice information updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
  
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Quote/invoice deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
      
}

// close the mysql connection
mysqli_close($connection);

include('includes/header.php');
?>

<h1>Quote/Invoice Information</h1>

<?php if(isset($alertMessage)){
    echo $alertMessage; 
}
?>

<table class="table table-striped table-bordered">
    <tr>
        <th>Quote/Invoice ID</th>
        <th>Address</th>
        <th>Start Date</th>
        <th>Total Quote/Invoice Dollar Amount</th>
    </tr>
    
    <?php
    
    if( mysqli_num_rows($result) > 0 ) {
        
        // we have data!
        // output the data
        
        while( $row = mysqli_fetch_assoc($result) ) {
            echo "<tr>";
            
            echo "<td>" . $row['quote_invoice_id'] . "</td><td>" . $row['address_id'] . "</td><td>" . $row['start_date'] . "</td><td>" . $row['total_invoice_amount'] . "</td>";

            echo '<td><a href="edit.php?id=' . $row['quote_invoice_id'] . '" type="button" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                    </a></td>';
            
            echo "</tr>";
        }
    } else { // if no entries
        echo "<div class='alert alert-warning'>No Quotes In Database</div>";
    }

    //mysqli_close($connection);

    ?>


</table>

<tr>
    <td colspan="7"><div class="text-center"><a href="add_invoice.php" type="button" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Add Quote/Invoice</a></div></td>
</tr>

<?php
include('includes/footer.php');
?>