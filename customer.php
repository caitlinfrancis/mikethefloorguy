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
$query = "SELECT * FROM customer_table";
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

<table class="table table-striped table-bordered">
    <tr>
        <th>Customer ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Company</th>
        <th>Edit</th>
    </tr>
    
    <?php
    
    if( mysqli_num_rows($result) > 0 ) {
        
        // we have data!
        // output the data
        
        while( $row = mysqli_fetch_assoc($result) ) {
            echo "<tr>";
            
            echo "<td>" . $row['cust_id'] . "</td><td>" . $row['cust_fname'] . "</td><td>" . $row['cust_lname'] . "</td><td>" . $row['cust_email'] . "</td><td>" . $row['cust_phonenum'] . "</td><td>" . $row['cust_company'] . "</td>";

            echo '<td><a href="edit.php?id=' . $row['cust_id'] . '" type="button" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit"></span>
                    </a></td>';
            
            echo "</tr>";
        }
    } else { // if no entries
        echo "<div class='alert alert-warning'>You have no customers!</div>";
    }

    //mysqli_close($connection);

    ?>


</table>

<tr>
    <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Add Customer</a></div></td>
</tr>

<?php
include('includes/footer.php');
?>