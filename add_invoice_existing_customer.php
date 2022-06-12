
<?php
session_start();

if( !$_SESSION['loggedInUser'] ) {

   header("Location: login.php");
}

include('includes/connection.php');
include('includes/functions.php');
include('includes/errorreporting.php');


if( isset( $_POST['add'] ) ) {
    
    $cFirstName = $cLastName = $cEmail = $cPhoneNum = $cCompany =  
    $streetAddress = $city = $state = $zip = 
    $startDate = $endDate = $supplies = $totalAmount = $jobDescription = $jobStatus = "";
    
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

    if( !$_POST["customer_email"] ) {
        $cEmailError = "This is a required field";
    } else {
        $cEmail = validateFormData( $_POST["customer_email"] );
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

    if( !$_POST["startdate"] ) {
        $startDateError = "This is a required field";
    } else {
        $startDate= validateFormData( $_POST["startdate"] );
    }

    if( !$_POST["enddate"] ) {
        $endDateError = "This is a required field";
    } else {
        $endDate= validateFormData( $_POST["enddate"] );
    }

    if( !$_POST["supplies"] ) {
        $suppliesError = "This is a required field";

    } else {
        $supplies= validateFormData( $_POST["supplies"] );
    }

    if( !$_POST["invoice_total"] ) {
        $totalAmountError = "This is a required field";
    } else {
        $totalAmount= validateFormData( $_POST["invoice_total"] );
    }

    if( !$_POST["job_status"] ) {
        $jobStatusError = "This is a required field";
    } else {
        $jobStatus= validateFormData( $_POST["job_status"] );
    }

    // comparing the start and end dates
    $startDateToTime = strtotime($startDate);
    $endDateToTime = strtotime($endDate);

    if ($_POST["enddate"]) {
        if ($startDateToTime > $endDateToTime) {
            $endDateBeforeStartDateError = "The end date can't be before the start date";
            $endDate = null;
        }
    }

    // these inputs are not required
    //just store whatever has been entered
    $cCompany  = validateFormData( $_POST["customer_company"] );
    $jobDescription = validateFormData( $_POST["job_description"] );
    
    // if required fields have data
    if( $cFirstName && $cLastName && $cPhoneNum && $cEmail && $streetAddress && $city && $state && $zip && (strlen($zip) == 5) && $startDate && $endDate && $supplies && $totalAmount && $jobStatus) {

        // getting the customer and address id's
        if ($cEmail) {
            $query = "SELECT * FROM customer INNER JOIN address on address.address_id = customer.address_id
            where customer_email = '$cEmail'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) > 0) {

                while( $row = mysqli_fetch_assoc($result) ) {
                    $customerId = $row['customer_id'];
                    $addressId = $row['address_id'];
                }
            } 
        }



        // create invoice query
        $addInvoiceQuery = "INSERT INTO invoice (invoice_id, startdate, enddate, supplies, invoice_total, job_description, profitability, job_status, address_id, customer_id) 
        VALUES (NULL, '$startDate', '$endDate', '$supplies', '$totalAmount', '$jobDescription', '$totalAmount' - '$supplies', '$jobStatus', '$addressId', '$customerId')";
        $query = mysqli_query ($connection, $addInvoiceQuery);


        if( $query ) {
    
            header( "Location: invoice.php?alert=success" );
        } else {
    
        // something went wrong
        echo "Error: ". $query ."<br>" . mysqli_error($connection);
        }
    }

}

include('includes/header.php');
?>

<?php 

        include('includes/connection.php');

        if(isset($_GET['search']))
        {
            $customerEmail = $_GET['search'];

            if ($customerEmail) {
                $query = "SELECT * FROM customer INNER JOIN address on address.address_id = customer.address_id
                where customer_email = '$customerEmail'";
                $result = mysqli_query($connection, $query);

                if(mysqli_num_rows($result) > 0) {

                    while( $row = mysqli_fetch_assoc($result) ) {
                        $customerId = $row['customer_id'];
                        $addressId = $row['address_id'];

                        $cFirstName = $row['customer_fname'];
                        $cLastName = $row['customer_lname'];
                        $cEmail = $row['customer_email'];
                        $cPhoneNum = $row['customer_phonenum'];
                        $cCompany = $row['customer_company'];

                        $city = $row['city'];
                        $state = $row['state'];
                        $streetAddress= $row['street_address'];
                        $zip = $row['zip'];
            
                    }
                } else {
                    echo "<div class='alert alert-info'>No customers found with email '$customerEmail'</div>";
                }
            }
        }
    ?>

<h1>Add Invoice to Existing Customer</h1>

<form action="" method="GET">
    <div class="input-group mb-3">
        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Enter customer email"><br></br>
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post" class="row">
    <div class="form-group col-sm-6">
        <label for="customer_fname">First Name *</label><label><?php echo '<font color="red">' . $cFNameError. '</font><br>'; ?></label>
        <input readonly type="text" maxlength="25" class="form-control input-lg" id="customer_fname" name="customer_fname" value="<?php echo $cFirstName; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="customer_lname">Last Name *</label><label><?php echo '<font color="red">' . $cLNameError. '</font><br>'; ?></label>
        <input readonly type="text" maxlength="25" class="form-control input-lg" id="customer_lname" name="customer_lname" value="<?php echo $cLastName; ?>" >
    </div>

    <div class="form-group col-sm-6 popup">
        <label for="customer_email" >Email *</label><a href="#" data-toggle="tooltip" 
        title="Please ensure the email format is @domain.com. An example is abcd@gmail.com">&nbsp;&nbsp;Format Assistance</a>
        <label><?php echo '<font color="red">' . $cEmailError. '</font><br>'; ?></label>
        <input readonly type="email" maxlength="50" pattern=".*.com" class="form-control input-lg" id="customer_email" name="customer_email" value="<?php echo $cEmail; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="customer_phonenum">Phone Number *</label><a href="#" data-toggle="tooltip" 
            title="An example of the required phone number format is 123-444-5678">&nbsp;&nbsp;Format Assistance</a>
        <label><?php echo '<font color="red">' . $phoneNumError. '</font><br>'; ?></label>
        <input readonly type="tel" class="form-control input-lg" maxlength="12"  pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required id="customer_phonenum" name="customer_phonenum" 
            value="<?php echo $cPhoneNum; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="street_address">Street Address *</label><label><?php echo '<font color="red">' . $streetAddressError. '</font><br>'; ?></label>
        <input readonly type="text" maxlength="45" class="form-control input-lg" id="street_address" name="street_address" value="<?php echo $streetAddress; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="city">City *</label><label><?php echo '<font color="red">' . $cityError. '</font><br>'; ?></label>
        <input readonly type="text" maxlength="45" class="form-control input-lg" id="city" name="city" value="<?php echo $city; ?>">
    </div>

    <div class="form-group form-group col-sm-6">
        <label for="state">State *</label><label><?php echo '<font color="red">' . $stateError. '</font><br>'; ?></label>
        <input readonly type="text" class="form-control input-lg" id="state" name="state" value="<?php echo $state; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="zip">Zip Code *</label><label><?php echo '<font color="red">' . $zipError. '</font><br>'; ?></label>
        <label><?php echo '<font color="red">' . $zipLengthError. '</font><br>'; ?></label>
        <input readonly type="number" min="0" maxlength="5" minlength="5" oninput="this.value=this.value.slice(0,this.dataset.maxlength)"
        class="form-control input-lg" id="zip" name="zip" value="<?php echo $zip; ?>">        
    </div>

    <div class="form-group col-sm-6">
        <label for="customer_company">Company</label>
        <input readonly type="text" maxlength="50" class="form-control input-lg" id="customer_company" name="customer_company" value="<?php echo $cCompany; ?>">
    </div> 

    <div class="form-group col-sm-6">
        <label for="startdate">Start Date *</label><label><?php echo '<font color="red">' . $startDateError. '</font><br>'; ?></label>
        <input type="date" class="form-control input-lg" id="startdate" name="startdate" value="<?php echo $startDate; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="enddate">End Date *</label><label><?php echo '<font color="red">' . $endDateBeforeStartDateError. '</font><br>'; ?></label><label><?php echo '<font color="red">' . $endDateError. '</font><br>'; ?></label>
        <input type="date" class="form-control input-lg" id="enddate" name="enddate" value="<?php echo $endDate; ?>">
    </div>


    <div class="form-group col-sm-6">
        <label for="supplies">Supplies Cost *</label><label><?php echo '<font color="red">' . $suppliesError. '</font><br>'; ?></label>
        <input type="decimal" step=".01" data-maxlength="12" min="0.00" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" 
        class="form-control input-lg" id="supplies" name="supplies" value="<?php echo $supplies; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="invoice_total">Invoice Total *</label><label><?php echo '<font color="red">' . $totalAmountError. '</font><br>'; ?></label>
        <input type="decimal"  step=".01" data-maxlength="12" min="0.00" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" 
        class="form-control input-lg" id="invoice_total" name="invoice_total" value="<?php echo $totalAmount; ?>">
    </div>

    <div class="form-group col-sm-6">
        <label for="job_status">Job Status *</label>
        <label><?php echo '<font color="red">' . $jobStatusError. '</font><br>'; ?></label>
        <select class="form-control input-lg" id="job_status" name="job_status" list="Status" value="<?php echo $jobStatus; ?>">
            <option value="none" selected disabled hidden>Please select an option</option>
            <option value="new">New</option>
            <option value="not started">Not started</option>
            <option value="in progress">In progress</option>
            <option value="complete">Complete</option>
        </select>
    </div>

    <div class="form-group col-sm-6">
        <label for="job_description">Job Description</label>
        <input type="text" maxlength="255" class="form-control input-lg" id="job_description" name="job_description" value="<?php echo $jobDescription; ?>">
    </div>

    <div class="col-sm-12">
            <a href="invoice.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Invoice</button>
    </div>
</form>

<html>
      <body>

      </div><!-- end .container -->

        <footer class="text-center">
            <hr>
            <lg>&diamond; <a href="help_addinvoiceexisting.php" target="_blank"> Help Menu &diamond;</a></lg><br>
            <lg>&diamond; Mike the Floor Guy Database User Interface &diamond;</a> </lg>
        </footer>
        
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>
