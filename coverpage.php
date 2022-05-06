<body>

<?php
session_start();
define("TITLE", "Cover Page | Mike The Floor Guy");
    
    include('includes/connection.php');
    
?>

  <div class="container">
      <p class="lead">Welcome <?php echo $_SESSION['loggedInUser']; ?>!</br>
      This is the customer and job management database for Mike the Floor Guy</p>



      <p class="lead"> Please select from the navigation links above to enter customer and job related data<br>
      A help menu is listed at the bottom of each page to assist as needed</p>


      <html> 
      <?php 
      echo "<img src='wood-texture-png-6.png' />"; 
      ?> 
      </html> 

      
    </body>

    <?php include('includes/header.php'); ?>    

<?php include('includes/footer.php'); ?>