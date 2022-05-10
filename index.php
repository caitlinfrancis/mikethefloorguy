<body>

<?php
session_start();
define("TITLE", "Cover Page | Mike The Floor Guy");
    
    include('includes/connection.php');    
    include('includes/functions.php');
    include('includes/errorreporting.php');
    
?>

  <div class="container">
      <p class="lead">Welcome <?php echo $_SESSION['loggedInUser']; ?>!</br>
      This is the customer and job management database for Mike the Floor Guy</p>



      <p class="lead"> Please select Login from the top right on the navigation bar to enter the management portal<br>
      A help menu is listed at the bottom of each page to assist as needed and there is additional contextual assistance on several pages</p>


      <html> 
      <?php 
      echo "<img src='logo.png' />"; 
      ?> 
      </html> 

      
    </body>

    <?php include('includes/header.php'); ?>    


