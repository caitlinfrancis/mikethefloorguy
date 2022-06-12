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
      <p class="lead">Welcome to the Help Menu for Viewing Invoice Information.<br>
        This menu opened in a secondary screen, so please feel free to toggle between the application and this help page as needed</p>

        <p class="lead">
          There is a search bar listed at the top of this page. The input for this search can be any of the data associated with a customer to include 
          their first name, last name, invoice ID, and street address which are the pertinent fields indicated as needed for searching customers and their related jobs. <br></p>
       <p> If a customer exists within the database with the searched for information, the customers and invoices that have that value will populate at the top of the search table<br>
      If a customer is not found, you can delete the value that was input into the search and click search again to repopulate the entire table again or you can simply search for another input and not have to refresh the page</p>

     There are several data fields listed on the Invoice Information page, most importantly the caluclation that takes the overall amount charge to the customer for time and labor minus the supply costs to show you the profitability of each job.
     The bottom of the page has an "Export to Excel" function that allows you to export this data to a spreadsheet for ease of calculations for tax purposes.

     Additionally, there is an ease of access +Add Invoice button that will allow you to add a customer from this screen instead of access through the header dropdown.
     One other important function to outline is the "Edit" button listed next to each invoice that allows you to edit details of that specific invoice. 


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
