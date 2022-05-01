<?php
define("TITLE", "Edit Customer | Mike The Floor Guy");
session_start();

// if user is not logged in
if( !$_SESSION['loggedInUser'] ) {
    
    header("Location: index.php");
}

// get ID sent by GET collection
$cId = $_GET['id'];

include('includes/connection.php');
include('includes/functions.php');
include('includes/errorreporting.php');


$query = "SELECT * FROM customer WHERE customer_id ='$cId'";
$result = mysqli_query( $connection, $query );

// if result is returned
if( mysqli_num_rows($result) > 0 ) {
    
    // we have data!
    // set some variables
    while( $row = mysqli_fetch_assoc($result) ) {

        $cFirstName = $row['customer_fname'];
        $cLastName = $row['customer_lname'];
        $cEmail = $row['customer_email'];
        $cPhoneNum = $row['customer_phonenum'];
        $cCompany = $row['customer_company'];

    }
} else { // no results returned
    $alertMessage = "<div class='alert alert-warning'>No Results. <a href='customer.php'>Head back</a>.</div>";
}

// if update button was submitted
if( isset($_POST['update']) ) {
    
    // set variables

    $cFirstName = validateFormData($_POST["customer_fname"] );
    $cLastName = validateFormData($_POST["customer_lname"] );
    $cEmail = validateFormData($_POST["customer_email"] );
    $cPhoneNum = validateFormData($_POST["customer_phonenum"] );
    $cCompany = validateFormData($_POST["customer_company"] );

    
    // new database query & result
    $query = "UPDATE customer
            SET customer_fname='$cFirstName',
            customer_lname='$cLastName',
            customer_email='$cEmail',
            customer_phonenum='$cPhoneNum',
            customer_company='$cCompany'
            WHERE customer_id='$cId'";
    
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
                        <form action='". htmlspecialchars( $_SERVER["PHP_SELF"] ) ."?customer_id=$cId' method='post'>
                            <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete'>
                            <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>No, do not delete</a>
                        </form>
                    </div>";
    
}

// if confirm delete button was submitted
if( isset($_POST['confirm-delete']) ) {
    
    // new database query & result
    $query = "DELETE FROM customer WHERE customer_id='$cId'";
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
        <label for="customer_fname">First Name</label>
        <input type="text" class="form-control input-lg" id="customer_fname" name="customer_fname" value="<?php echo $cFirstName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_lname">Last Name</label>
        <input type="text" class="form-control input-lg" id="customer_lname" name="customer_lname" value="<?php echo $cLastName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_email">Email</label>
        <input type="text" class="form-control input-lg" id="customer_email" name="customer_email" value="<?php echo $cEmail; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_phonenum">Phone Number</label>
        <input type="text" class="form-control input-lg" id="customer_phonenum" name="customer_phonenum" value="<?php echo $cPhoneNum; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_company">Company</label>
        <input type="text" class="form-control input-lg" id="customer_company" name="customer_company" value="<?php echo $cCompany; ?>">
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