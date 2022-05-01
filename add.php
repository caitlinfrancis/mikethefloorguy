<?php
define("TITLE", "Add Customer | Mike The Floor Guy");
session_start();

if( !$_SESSION['loggedInUser'] ) {

   header("Location: index.php");
}

include('includes/connection.php');
include('includes/functions.php');

if( isset( $_POST['add'] ) ) {
    
    $cFirstName = $cLastName = $cEmail = $cPhoneNum = $cCompany =  
    $streetAddress = $city = $state = $zip = "";
    
    if( !$_POST["customer_fname"] ) {
        $cFNameError = "This is a required field";
    } else {
        $cFirstName = validateFormData( $_POST["customer_fname"] );
    }

    if( !$_POST["customer_lname"] ) {
        $cLNameError = "This is a required field";
    } else {
        $cLastName = validateFormData( $_POST["customer_lname"] );
    }

    if( !$_POST["customer_phonenum"] ) {
        $phoneNumError = "This is a required field";
    } else {
        $cPhoneNum = validateFormData( $_POST["customer_phonenum"] );
    }

    if( !$_POST["street_address"] ) {
        $streetAddressError = "This is a required field";
    } else {
        $streetAddress = validateFormData( $_POST["street_address"] );
    }

    if( !$_POST["city"] ) {
        $cityError = "This is a required field";
    } else {
        $city = validateFormData( $_POST["city"] );
    }

    if( !$_POST["state"] ) {
        $stateError = "This is a required field";
    } else {
        $state = validateFormData( $_POST["state"] );
    }

    if( !$_POST["zip"] ) {
        $zipError = "This is a required field";
    } else {
        $zip= validateFormData( $_POST["zip"] );
    }
    
    // these inputs are not required
    // so we'll just store whatever has been entered
    $cCompany  = validateFormData( $_POST["customer_company"] );
    $cEmail = validateFormData( $_POST["customer_email"] );
    
    // if required fields have data
    if( $cFirstName && $cLastName && $cPhoneNum && $streetAddress && $city && $state && $zip) {

        // first checking to see if the customer already exists
        $selectCustomerQuery = "SELECT * FROM `customer` WHERE customer_fname = '$cFirstName' and customer_lname = '$cLastName' and customer_phonenum = '$cPhoneNum';";
        $result = mysqli_query ($connection, $selectCustomerQuery);

        if (mysqli_num_rows($result) == 0) {

            // check if the address exists
            $selectAddressQuery = "SELECT address_id FROM `address` WHERE street_address = '$streetAddress' and city = '$city' and state = '$state' and zip = '$zip';";
            $result = mysqli_query ($connection, $selectAddressQuery);

            if (mysqli_num_rows($result) == 0) {
                // adding the address first to get a valid address id
                $addAddressQuery = "INSERT INTO address (address_id, street_address, city, state, zip) 
                VALUES (NULL, '$streetAddress', '$city', '$state', '$zip')";
                $result = mysqli_query ($connection, $addAddressQuery);

                // retrieve the address to get the address id
                $result = mysqli_query ($connection, $selectAddressQuery);

                while($row = $result->fetch_array()) {
                    $addressId = $row["address_id"];
                }
                
                // create query
                $addCustomerQuery = "INSERT INTO customer (customer_id, customer_fname, customer_lname, customer_email, customer_phonenum, customer_company, address_id) 
                VALUES (NULL, '$cFirstName', '$cLastName', '$cEmail', '$cPhoneNum', '$cCompany', '$addressId')";
                $query = mysqli_query ($connection, $addCustomerQuery);

                if( $query ) {
            
                 header( "Location: customer.php?alert=success" );
                } else {
            
                // something went wrong
                echo "Error: ". $query ."<br>" . mysqli_error($connection);
                }
            } else {
                $addressAlertMessage = "<div class='alert alert-danger'>Address Already Exists<a class='close' data-dismiss='alert'>&times;</a></div>";
            }   
        } else {
            $customerAlertMessage = "<div class='alert alert-danger'>Customer Already Exists<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
        
    }

}


include('includes/header.php');
?>

<?php if(isset($customerAlertMessage)){
    echo $customerAlertMessage; 
}

if(isset($addressAlertMessage)){
    echo $addressAlertMessage; 
}
?>


<h1>Add Customer</h1>


<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="customer_fname">First Name *</label> <label><?php echo '<font color="red">' . $cFNameError. '</font><br>'; ?></label>
        <input type="text" class="form-control input-lg" id="customer_fname" name="customer_fname" value="<?php echo $cFirstName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_lname">Last Name *</label> <label><?php echo '<font color="red">' . $cLNameError. '</font><br>'; ?></label>
        <input type="text" class="form-control input-lg" id="customer_lname" name="customer_lname" value="<?php echo $cLastName; ?>" >
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_email">Email </label>
        <input type="text" class="form-control input-lg" id="customer_email" name="customer_email" value="<?php echo $cEmail; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_phonenum">Phone Number *</label> <label><?php echo '<font color="red">' . $phoneNumError. '</font><br>'; ?></label>
        <input type="text" class="form-control input-lg" id="customer_phonenum" name="customer_phonenum" value="<?php echo $cPhoneNum; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="street_address">Street Address *</label> <label><?php echo '<font color="red">' . $streetAddressError. '</font><br>'; ?></label>
        <input type="text" class="form-control input-lg" id="street_address" name="street_address" value="<?php echo $streetAddress; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="city">City *</label> <label><?php echo '<font color="red">' . $cityError. '</font><br>'; ?></label>
        <input type="text" class="form-control input-lg" id="city" name="city" value="<?php echo $city; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="state">State *</label> <label><?php echo '<font color="red">' . $stateError. '</font><br>'; ?></label>
        <input type="text" class="form-control input-lg" id="state" name="state" value="<?php echo $state; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="zip">Zip Code *</label> <label><?php echo '<font color="red">' . $zipError. '</font><br>'; ?></label>
        <input type="text" class="form-control input-lg" id="zip" name="zip" value="<?php echo $zip; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_company">Company</label>
        <input type="text" class="form-control input-lg" id="customer_company" name="customer_company" value="<?php echo $cCompany; ?>">
    </div> 
    <div class="col-sm-12">
            <a href="customer.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Customer</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>