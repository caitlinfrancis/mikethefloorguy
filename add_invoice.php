<?php error_reporting(E_ALL ^ E_WARNING); ?>

<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    // send them to the login page
    header("Location: index.php");
}

// connect to database
//include('includes/connection.php');
include('includes/connection.php');

// include functions file
include('includes/functions.php');

include('includes/errorreporting.php');

// if add button was submitted
if( isset( $_POST['add'] ) ) {
    
    // set all variables to empty by default
    $quoteId = $address = $startDate = $totalInvoice = "";
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    
    if( !$_POST["address_id"] ) {
        $addressError = "Please enter address <br>";
    } else {
        $address = validateFormData( $_POST["address_id"] );
    }

    if( !$_POST["start_date"] ) {
        $dateError = "Please Select Start Date from Dropdown <br>";
    } else {
        $startDate = validateFormData( $_POST["start_date"] );
    }

    if( !$_POST["total_invoice_amount"] ) {
        $invoiceAmount = "Please enter a dollar amount <br>";
    } else {
        $ctotalInvoice = validateFormData( $_POST["total_invoice_amount"] );
    }

    
    // these inputs are not required
    // so we'll just store whatever has been entered
 

    
    // if required fields have data
    if( $address && $startDate && $invoiceAmount ) {
        
        // create query
        $query = "INSERT INTO quote_invoice (quote_invoice_id, address_id, start_date, total_invoice_amount) VALUES (NULL, '$address', '$startDate', '$ctotalInvoice')";
        
        $result = mysqli_query( $connection, $query );
        
        // if query was successful
        if( $result ) {
            
            // refresh page with query string
            header( "Location: customer.php?alert=success" );
        } else {
            
            // something went wrong
            echo "Error: ". $query ."<br>" . mysqli_error($connection);
        }
        
    }
    
}

// close the mysql connection
mysqli_close($connection);


include('includes/header.php');
?>

<h1>Add Quote/Invoice</h1>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">

<div class="form-group col-sm-6">
        <label for="address_id">Address *</label>
        <input type="text" class="form-control input-lg" id="address_id" name="address_id" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="start_date">Start Date *</label>
        <input type="text" class="form-control input-lg" id="start_date" name="start_date" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="total_invoice_amount">Total Quote/Invoice Dollar Amount *</label>
        <input type="text" class="form-control input-lg" id="total_invoice_amount" name="total_invoice_amount" value="">
    </div>
    <div class="col-sm-12">
            <a href="invoice.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Quote/Invoice</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>