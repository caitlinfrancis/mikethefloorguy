
<?php

define("TITLE", "LOGIN | Mike The Floor Guy");

include('includes/errorreporting.php');
include('includes/functions.php');

if( isset( $_POST['login'] ) ) {
    

    $formUsername = validateFormData( $_POST['username'] );
    $formPass = validateFormData( $_POST['password'] );
    
    include('includes/connection.php');
    
    // create query
    $query = "SELECT username, password FROM users WHERE username='$formUsername'";
    
    // store the result
    $result = mysqli_query( $connection, $query );
    
    // verify if result is returned
    if( mysqli_num_rows($result) > 0 ) {
        
        // store basic user data in variables
            $row = mysqli_fetch_assoc($result);
            $username       = $row['username'];
            $hashedPass     = $row['password'];
        
        
        // verify hashed password with submitted password
        if( password_verify( $formPass, $hashedPass ) ) {
            
            session_start();

            // correct login details!
            // store data in SESSION variables
            $_SESSION['loggedInUser'] = $username;
            
            header( "Location: coverpage.php" );

        } else { // hashed password didn't verify
            
            // error message
            $loginError = "<div class='alert alert-danger'>Wrong username / password combination. Try again.</div>";
        }
        
    } else { // there are no results in database
        
        // error message
        $loginError = "<div class='alert alert-danger'>No such user in database. Please try again. <a class='close' data-dismiss='alert'>&times;</a></div>";
    }
    

}




include('includes/header.php');


?>
<h1>Login</h1>

<?php echo $loginError; ?>

<form class="form-inline" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
    
    <div class="form-group">
        <label for="username" class="sr-only">Username</label>
        <input type="text" class="form-control input-lg" id="login-username" placeholder="username" name="username" value="<?php echo $formUsername; ?>">
    </div>
    <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" class="form-control input-lg" id="login-password" placeholder="password" name="password">
    </div>
    <br></br>
   
    <div>
    <button type="submit" class="btn btn-lg btn-success pull-left" name="login">Submit</button>
    </div>

</form>

</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>




