<?php
session_start();


if( !$_SESSION['loggedInUser'] ) {

   header("Location: login.php");
}

include('includes/connection.php');
include('includes/functions.php');
include('includes/errorreporting.php');
?>

<body>

  <div class="container">
      <p class="lead">Welcome to the Help Menu for Adding a User to the Database <br>
        This menu opened in a secondary screen, so please feel free to toggle between the application and this help page as needed</p>


    Please enter a username and password for an account you would like to set in the database system.<br>
    The password shows as clear text but will be hashed within the database to prevent others from identifying the set password.


      <p class="lead">
     Once the required information has been entered, please select the green button for "Add User"
     OR select "Cancel" to exit the screen.

    </body>

    <?php include('includes/header.php'); ?>    


<?php include('includes/footer.php'); ?>

<html>
  <head>
    <style>
 /* Popup container */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
}

/* The actual popup (appears on top) */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class when clicking on the popup container (hide and show the popup) */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
      
    </style>
  </head>

</html>
