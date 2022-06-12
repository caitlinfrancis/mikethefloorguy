<?php
   session_start();


    include('includes/connection.php');
    include('includes/functions.php');
    include('includes/errorreporting.php');


    if( isset( $_POST['add'] ) ) {

    $username = $password = "";
    
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





mysqli_close($connection);
include('includes/header.php');

?>

        <h1>Add System User</h1>

            <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">

            <div class="form-group col-sm-6">
                <label for="username">Username *</label>
                <input type="text" class="form-control input-lg" name="username"><br><br>
            </div>

            <div class="form-group col-sm-6">
                <label for="password">Password *</label>
                <small class="text"><?php echo $passwordError; ?></small>
                <input type="text" class="form-control input-lg" name="password"><br><br>
            </div>


            <div class="col-sm-12">
                <a type="button" class="btn btn-lg btn-default">Cancel</a>
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


<html>
      <body>

      </div><!-- end .container -->

        <footer class="text-center">
            <hr>
            <lg>&diamond; <a href="help_adduserdb.php" target="_blank"> Help Menu &diamond;</a></lg><br>
            <lg>&diamond; Mike the Floor Guy Database User Interface &diamond;</a> </lg>
        </footer>
        
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>