<?php
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    header("Location: index.php");
}

// get ID sent by GET collection
$cId = $_GET['id'];

// connect to database
include('includes/connection.php');

// include functions file
include('includes/functions.php');


include('includes/errorreporting.php');


$query = "SELECT * FROM customer_table WHERE cust_id ='$cId'";
$result = mysqli_query( $connection, $query );

// if result is returned
if( mysqli_num_rows($result) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysqli_fetch_assoc($result) ) {

        $cFirstName = $row['cust_fname'];
        $cLastName = $row['cust_lname'];
        $cEmail = $row['cust_email'];
        $cPhoneNum = $row['cust_phonenum'];
        $cCompany = $row['cust_company'];

    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>No Results. <a href='customer.php'>Head back</a>.</div>";
}

// if update button was submitted
if( isset($_POST['update']) ) {
    
    // set variables

    $cFirstName = validateFormData($_POST["cust_fname"] );
    $cLastName = validateFormData($_POST["cust_lname"] );
    $cEmail = validateFormData($_POST["cust_email"] );
    $cPhoneNum = validateFormData($_POST["cust_phonenum"] );
    $cCompany = validateFormData($_POST["cust_company"] );

    
    // new database query & result
    $query = "UPDATE customer_table
            SET cust_fname='$cFirstName',
            cust_lname='$cLastName',
            cust_email='$cEmail',
            cust_phonenum='$cPhoneNum',
            cust_company='$cCompany'
            WHERE cust_id='$cId'";
    
    $result = mysqli_query( $connection, $query );
    
    if( $result ) {
        
       
        header("Location: customer.php?alert=updatesuccess");
    } else {
        echo "Error updating record: " . mysqli_error($connection); 
    }
}

// if delete button was submitted
if( isset($_POST['delete']) ) {
    
    $alertMessage = "<div class='alert alert-danger'>
                        <p>Are you sure you want to delete this customer?</p><br>
                        <form action='". htmlspecialchars( $_SERVER["PHP_SELF"] ) ."?cust_id=$cId' method='post'>
                            <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete'>
                            <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>No, do not delete</a>
                        </form>
                    </div>";
    
}

// if confirm delete button was submitted
if( isset($_POST['confirm-delete']) ) {
    
    // new database query & result
    $query = "DELETE FROM customer_table WHERE cust_id='$cId'";
    $result = mysqli_query( $connection, $query );
    

    if( $result ) {
        
    
        header("Location: customer.php?alert=deleted");
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
    
}

// close the mysql connection
mysqli_close($connection);

include('includes/header.php');
?>

<h1>Edit Customer</h1>

<?php echo $alertMessage; ?>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>?id=<?php echo $cId; ?>" method="post" class="row">

    <div class="form-group col-sm-6">
        <label for="cust_fname">First Name</label>
        <input type="text" class="form-control input-lg" id="cust_fname" name="cust_fname" value="<?php echo $cFirstName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_lname">Last Name</label>
        <input type="text" class="form-control input-lg" id="cust_lname" name="cust_lname" value="<?php echo $cLastName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_email">Email</label>
        <input type="text" class="form-control input-lg" id="cust_email" name="cust_email" value="<?php echo $cEmail; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_phonenum">Phone Number</label>
        <input type="text" class="form-control input-lg" id="cust_phonenum" name="cust_phonenum" value="<?php echo $cPhoneNum; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="cust_company">Company</label>
        <input type="text" class="form-control input-lg" id="cust_company" name="cust_company" value="<?php echo $cCompany; ?>">
    </div>

    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-lg btn-danger pull-left" name="confirm-delete">Delete</button>
        <div class="pull-right">
            <a href="customer.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success" name="update">Update</button>
        </div>
    </div>
</form>

<?php
include('includes/footer.php');
?>