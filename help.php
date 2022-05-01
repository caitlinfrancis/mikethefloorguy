<?php
define("TITLE", "Help Menu | Mike The Floor Guy");
session_start();


if( !$_SESSION['loggedInUser'] ) {

   header("Location: index.php");
}

include('includes/connection.php');
include('includes/functions.php');
?>

<body>

  <div class="container">
      <p class="lead">Welcome to the Help Menu</br>
      Please select a link below that will guide you to the section you are seeking assistance with</p>


      <p class="lead"> This menu opened in a second screen, so please feel free to toggle between the menu and this help page as needed<br>


      
    </body>

    <?php include('includes/header.php'); ?>    


<?php include('includes/footer.php'); ?>