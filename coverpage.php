<?php
    session_start();
?>

    <?php include('includes/header.php'); ?>

      <main class="px-3">
        <h1>Mike the Floor Guy</h1>
        <p class="lead">This will be the main/cover page for Mikes Application once login occurs.</p>
      </main>
    
    
    <body>
        <div class="container">
            <h1>Cover Page</h1>
            <p class="lead">Welcome <?php echo $_SESSION['loggedInUser']; ?>!</p>
            
    </body>

<?php include('includes/footer.php'); ?>