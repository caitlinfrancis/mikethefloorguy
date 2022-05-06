<?php
    define("TITLE", "Customer Page | Mike The Floor Guy");
    session_start();
?>

<?php 
if( !$_SESSION['loggedInUser'] ) {
    
header("Location: index.php");
}


include('includes/connection.php');
include('includes/functions.php');
include('includes/errorreporting.php');

// query & result
$query = "SELECT * FROM customer INNER JOIN address on address.address_id = customer.address_id ORDER BY customer_fname asc";

$result = mysqli_query( $connection, $query );

// check for query string
if( isset( $_GET['alert'] ) ) {
    
  
    if( $_GET['alert'] == 'success' ) {
        $alertMessage = "<div class='alert alert-success'>New customer added! <a class='close' data-dismiss='alert'>&times;</a></div>";
        
    
    } elseif( $_GET['alert'] == 'updatesuccess' ) {
        $alertMessage = "<div class='alert alert-success'>Customer updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
    
  
    } elseif( $_GET['alert'] == 'deleted' ) {
        $alertMessage = "<div class='alert alert-success'>Customer deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
      
}

// close the mysql connection
mysqli_close($connection);

include('includes/header.php');
?>

<h1>Customer Contact Information</h1>

<?php if(isset($alertMessage)){
    echo $alertMessage; 
}
?>

<div class ='container'>
<table class="table table-striped table-bordered">
    <tr>
        <th style="width:10%">First Name</th>
        <th style="width:10%">Last Name</th>
        <th style="width:10%">Email</th>
        <th style="width:15%">Phone Number</th>
        <th style="width:10%">Company</th>
        <th style="width:10%">Street Address</th>
        <th style="width:10%">City</th>
        <th style="width:5%">State</th>
        <th style="width:5%">Zip</th>
        <th style="width:10%">Edit</th>
    </tr>
    
    <?php
    
    if( mysqli_num_rows($result) > 0 ) {
        
        // output the data
        
        while( $row = mysqli_fetch_assoc($result) ) {
            echo "<tr>";
            
            echo "<td>" . $row['customer_fname'] . "</td><td>" . $row['customer_lname'] . "</td><td>" . $row['customer_email'] 
            . "</td><td>" . $row['customer_phonenum'] . "</td><td>" . $row['customer_company'] . "</td><td>" . $row['street_address'] 
            . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['zip'] . "</td>";

            echo '<td><a href="edit.php?id=' . $row['customer_id'] . '" type="button" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                    </a></td>';
            
            echo "</tr>";
        }
    } else { // if no entries
        echo "<div class='alert alert-info'>You have no customers</div>";
    }

    //mysqli_close($connection);

    ?>

</table>
<div>

<tr>
    <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Add Customer</a></div></td>
</tr>

<div class="table-responsive">

<div id="live_data"> </div>
<form method="post" action="generatepdf.php">
<input type="submit" name="export_excel" class="btn btn-success" value="Export to Excel" />
</form>



<?php
include('includes/footer.php');
?>