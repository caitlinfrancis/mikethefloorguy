<style>
    <?php include 'CSS/default.css'; ?>
</style>

<?php
define("TITLE", "Add Customer | Mike The Floor Guy");
session_start();

if( !$_SESSION['loggedInUser'] ) {

   header("Location: login.php");
}

include('includes/connection.php');
include('includes/functions.php');
include('includes/errorreporting.php');

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
    } elseif (strlen($_POST["zip"]) < 5){
        $zipLengthError = "Zip code must be 5 digits";
        $zip = $_POST["zip"];
    } else {
        $zip = validateFormData($_POST["zip"] );
    }

    // these inputs are not required
    // so we'll just store whatever has been entered
    $cCompany  = validateFormData( $_POST["customer_company"] );
    $cEmail = validateFormData( $_POST["customer_email"] );
    
    // if required fields have data
    if( $cFirstName && $cLastName && $cPhoneNum && $streetAddress && $city && $state && $zip && (strlen($zip) == 5)) {

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
        <label for="customer_fname">First Name *</label><label><?php echo '<font color="red">' . $cFNameError. '</font><br>'; ?></label>
        <input type="text" maxlength="25" class="form-control input-lg" id="customer_fname" name="customer_fname" value="<?php echo $cFirstName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="customer_lname">Last Name *</label><label><?php echo '<font color="red">' . $cLNameError. '</font><br>'; ?></label>
        <input type="text" maxlength="25" class="form-control input-lg" id="customer_lname" name="customer_lname" value="<?php echo $cLastName; ?>" >
    </div>

    <div class="form-group col-sm-6 popup">
        <label for="customer_email" >Email *</label><a href="#" data-toggle="tooltip" 
        title="Please ensure the email format is @domain.com. An example is abcd@gmail.com">&nbsp;&nbsp;Format Assistance</a>
        <label><?php echo '<font color="red">' . $cEmailError. '</font><br>'; ?></label>
        <input type="email" maxlength="50" pattern=".*.com" class="form-control input-lg" id="customer_email" name="customer_email" value="<?php echo $cEmail; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="customer_phonenum">Phone Number *</label><a href="#" data-toggle="tooltip" 
            title="An example of the required phone number format is 123-444-5678">&nbsp;&nbsp;Format Assistance</a>
        <label><?php echo '<font color="red">' . $phoneNumError. '</font><br>'; ?></label>
        <input type="tel" class="form-control input-lg" maxlength="12"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required id="customer_phonenum" name="customer_phonenum" 
            value="<?php echo $cPhoneNum; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="street_address">Street Address *</label><label><?php echo '<font color="red">' . $streetAddressError. '</font><br>'; ?></label>
        <input type="text" maxlength="45" class="form-control input-lg" id="street_address" name="street_address" value="<?php echo $streetAddress; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="city">City *</label><label><?php echo '<font color="red">' . $cityError. '</font><br>'; ?></label>
        <input type="text" maxlength="45" class="form-control input-lg" id="city" name="city" value="<?php echo $city; ?>">
    </div>

    <div class="form-group form-group col-sm-6">
        <label for="state">State *</label><label><?php echo '<font color="red">' . $stateError. '</font><br>'; ?></label>
        <select class="form-control input-lg" id="state" name="state" list="state" value="<?php echo $state; ?>">
        <option value="none" selected disabled hidden>Please select an option</option>
            <option value="AL" <?php if("AL" == $state) { ?> selected = "selected" <?php }?>>Alabama</option>
            <option value="AK" <?php if("AK" == $state) { ?> selected = "selected" <?php }?>>Alaska</option>
            <option value="AZ" <?php if("AZ" == $state) { ?> selected = "selected" <?php }?>>Arizona</option>
            <option value="AR" <?php if("AR" == $state) { ?> selected = "selected" <?php }?>>Arkansas</option>
            <option value="CA" <?php if("CA" == $state) { ?> selected = "selected" <?php }?>>California</option>
            <option value="CO" <?php if("CO" == $state) { ?> selected = "selected" <?php }?>>Colorado</option>
            <option value="CT" <?php if("CT" == $state) { ?> selected = "selected" <?php }?>>Connecticut</option>
            <option value="DE" <?php if("DE" == $state) { ?> selected = "selected" <?php }?>>Delaware</option>
            <option value="FL" <?php if("FL" == $state) { ?> selected = "selected" <?php }?>>Florida</option>
            <option value="GA" <?php if("GA" == $state) { ?> selected = "selected" <?php }?>>Georgia</option>
            <option value="HI" <?php if("HI" == $state) { ?> selected = "selected" <?php }?>>Hawaii</option>
            <option value="ID" <?php if("ID" == $state) { ?> selected = "selected" <?php }?>>Idaho</option>
            <option value="IL" <?php if("IL" == $state) { ?> selected = "selected" <?php }?>>Illinois</option>
            <option value="IN" <?php if("IN" == $state) { ?> selected = "selected" <?php }?>>Indiana</option>
            <option value="IA" <?php if("IA" == $state) { ?> selected = "selected" <?php }?>>Iowa</option>
            <option value="KS" <?php if("KS" == $state) { ?> selected = "selected" <?php }?>>Kansas</option>
            <option value="KY" <?php if("KY" == $state) { ?> selected = "selected" <?php }?>>Kentucky</option>
            <option value="LA" <?php if("LA" == $state) { ?> selected = "selected" <?php }?>>Louisiana</option>
            <option value="ME" <?php if("ME" == $state) { ?> selected = "selected" <?php }?>>Maine</option>
            <option value="MD" <?php if("MD" == $state) { ?> selected = "selected" <?php }?>>Maryland</option>
            <option value="MA" <?php if("MA" == $state) { ?> selected = "selected" <?php }?>>Massachusetts</option>
            <option value="MI" <?php if("MI" == $state) { ?> selected = "selected" <?php }?>>Michigan</option>
            <option value="MN" <?php if("MN" == $state) { ?> selected = "selected" <?php }?>>Minnesota</option>
            <option value="MS" <?php if("MS" == $state) { ?> selected = "selected" <?php }?>>Mississippi</option>
            <option value="MO" <?php if("MO" == $state) { ?> selected = "selected" <?php }?>>Missouri</option>
            <option value="MT" <?php if("MT" == $state) { ?> selected = "selected" <?php }?>>Montana</option>
            <option value="NE" <?php if("NE" == $state) { ?> selected = "selected" <?php }?>>Nebraska</option>
            <option value="NV" <?php if("NV" == $state) { ?> selected = "selected" <?php }?>>Nevada</option>
            <option value="NH" <?php if("NH" == $state) { ?> selected = "selected" <?php }?>>New Hampshire</option>
            <option value="NJ" <?php if("NJ" == $state) { ?> selected = "selected" <?php }?>>New Jersey</option>
            <option value="NM" <?php if("NM" == $state) { ?> selected = "selected" <?php }?>>New Mexico</option>
            <option value="NY" <?php if("NY" == $state) { ?> selected = "selected" <?php }?>>New York</option>
            <option value="NC" <?php if("NC" == $state) { ?> selected = "selected" <?php }?>>North Carolina</option>
            <option value="ND" <?php if("ND" == $state) { ?> selected = "selected" <?php }?>>North Dakota</option>
            <option value="OH" <?php if("OH" == $state) { ?> selected = "selected" <?php }?>>Ohio</option>
            <option value="OK" <?php if("OK" == $state) { ?> selected = "selected" <?php }?>>Oklahoma</option>
            <option value="OR" <?php if("OR" == $state) { ?> selected = "selected" <?php }?>>Oregon</option>
            <option value="PA" <?php if("PA" == $state) { ?> selected = "selected" <?php }?>>Pennsylvania</option>
            <option value="RI" <?php if("RI" == $state) { ?> selected = "selected" <?php }?>>Rhode Island</option>
            <option value="SC" <?php if("SC" == $state) { ?> selected = "selected" <?php }?>>South Carolina</option>
            <option value="SD" <?php if("SD" == $state) { ?> selected = "selected" <?php }?>>South Dakota</option>
            <option value="TN" <?php if("TN" == $state) { ?> selected = "selected" <?php }?>>Tennessee</option>
            <option value="TX" <?php if("TX" == $state) { ?> selected = "selected" <?php }?>>Texas</option>
            <option value="UT" <?php if("UT" == $state) { ?> selected = "selected" <?php }?>>Utah</option>
            <option value="VT" <?php if("VT" == $state) { ?> selected = "selected" <?php }?>>Vermont</option>
            <option value="VA" <?php if("VA" == $state) { ?> selected = "selected" <?php }?>>Virginia</option>
            <option value="WA" <?php if("WA" == $state) { ?> selected = "selected" <?php }?>>Washington</option>
            <option value="WV" <?php if("WV" == $state) { ?> selected = "selected" <?php }?>>West Virginia</option>
            <option value="WI" <?php if("WI" == $state) { ?> selected = "selected" <?php }?>>Wisconsin</option>
            <option value="WY" <?php if("WY" == $state) { ?> selected = "selected" <?php }?>>Wyoming</option>
        </select>
    </div>

    <div class="form-group col-sm-6">
        <label for="zip">Zip Code *</label><label><?php echo '<font color="red">' . $zipError. '</font><br>'; ?></label><label><?php echo '<font color="red">' . $zipLengthError. '</font><br>'; ?></label>
        <input type="number" min="0" maxlength="5" minlength="5" oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
        class="form-control input-lg" id="zip" name="zip" value="<?php echo $zip; ?>">        
    </div>

    <div class="form-group col-sm-6">
        <label for="customer_company">Company</label>
        <input type="text" maxlength="50" class="form-control input-lg" id="customer_company" name="customer_company" value="<?php echo $cCompany; ?>">
    </div> 

    <div class="col-sm-12">
        <a href="customer.php" type="button" class="btn btn-lg btn-default cancel">Cancel</a>
        <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Customer</button>
    </div>
</form>

<html>
      <body>

      </div><!-- end .container -->

        <footer class="text-center">
            <hr>
            <lg>&diamond; <a href="help_add.php" target="_blank"> Help Menu &diamond;</a></lg><br>
            <lg>&diamond; Mike the Floor Guy Database User Interface &diamond;</a> </lg>
        </footer>
        
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>