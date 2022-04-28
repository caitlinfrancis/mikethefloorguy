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
    include('includes/errorreporting.php');

    // include functions file
    include('includes/functions.php');

    // if add button was submitted
    if( isset( $_POST['add'] ) ) {

    // set all variables to empty by default
    $username = $password = "";
    
    // check to see if inputs are empty
    // create variables with form data
    // wrap the data with our function
    
    if( !$_POST["username"] ) {
        $nameError = "Please enter a username <br>";
    } else {
        $username = validateFormData( $_POST["username"] );
    }

    if( !$_POST["password"] ) {
        $passwordError = "Please enter a password <br>";
    } else {
        $password = validateFormData( $_POST["password"] );
        $password = password_hash( $_POST["password"], PASSWORD_DEFAULT );
    }
    
    // check to see if each variable has data
    if( $username && $password ) {
        $query = "INSERT INTO users (username, password)
        VALUES ('$username', '$password')";

        if( mysqli_query( $connection, $query ) ) {
            echo "<div class='alert alert-success'>New user set in database!</div>";
        } else {
            echo "Error: ". $query . "<br>" . mysqli_error($connection);
        }
    }
    
}

/*
MYSQL INSERT QUERY

INSERT INTO users (id, username, password, email, signup_date, biography)
VALUES (NULL, 'jacksonsmith', 'abc123', 'jack@son.com', CURRENT_TIMESTAMP, 'Hello! I'm Jackson. This is my bio.');

*/

mysqli_close($connection);
include('includes/header.php');

?>

        <h1>Add System User</h1>

            <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">

            <div class="form-group col-sm-6">
                <label for="cust_lname">Username *</label>
                <input type="text" class="form-control input-lg" name="username"><br><br>
            </div>

            <div class="form-group col-sm-6">
                <label for="cust_lname">Password *</label>
                <small class="text"><?php echo $passwordError; ?></small>
                <input type="text" class="form-control input-lg" name="password"><br><br>
            </div>


            <div class="col-sm-12">
                <a href="customer.php" type="button" class="btn btn-lg btn-default">Cancel</a>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add User</button>
             </div>

            </form>
            
        </div>
        
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>


<?php
include('includes/footer.php');
?>