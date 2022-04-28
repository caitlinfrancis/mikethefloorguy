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
    $cFirstName = $cLastName = $cEmail = $cPhoneNum = $cCompany = "";
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    
    if( !$_POST["cust_fname"] ) {
        $nameError = "Please enter customers first name <br>";
    } else {
        $cFirstName = validateFormData( $_POST["cust_fname"] );
    }

    if( !$_POST["cust_lname"] ) {
        $nameError = "Please enter customers last name <br>";
    } else {
        $cLastName = validateFormData( $_POST["cust_lname"] );
    }

    if( !$_POST["cust_email"] ) {
        $emailError = "Please enter an email <br>";
    } else {
        $cEmail = validateFormData( $_POST["cust_email"] );
    }

    if( !$_POST["cust_phonenum"] ) {
        $phoneNumError = "Please enter a phone number <br>";
    } else {
        $cPhoneNum = validateFormData( $_POST["cust_phonenum"] );
    }
    
    // these inputs are not required
    // so we'll just store whatever has been entered
    $cCompany  = validateFormData( $_POST["cust_company"] );

    
    // if required fields have data
    if( $cFirstName && $cLastName && $cEmail && $cPhoneNum ) {
        
        // create query
        $query = "INSERT INTO customer_table (cust_id, cust_fname, cust_lname, cust_email, cust_phonenum, cust_company) VALUES (NULL, '$cFirstName', '$cLastName', '$cEmail', '$cPhoneNum', '$cCompany')";
        
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

<h1>Add Customer</h1>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="cust_lname">First Name *</label>
        <input type="text" class="form-control input-lg" id="cust_fname" name="cust_fname" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_lname">Last Name *</label>
        <input type="text" class="form-control input-lg" id="cust_lname" name="cust_lname" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_email">Email *</label>
        <input type="text" class="form-control input-lg" id="cust_email" name="cust_email" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_phonenum">Phone Number *</label>
        <input type="text" class="form-control input-lg" id="cust_phonenum" name="cust_phonenum" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_company">Company</label>
        <input type="text" class="form-control input-lg" id="cust_company" name="cust_company" value="">
    </div>
    <div class="col-sm-12">
            <a href="customer.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Customer</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>