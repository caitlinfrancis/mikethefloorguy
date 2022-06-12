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
      <p class="lead">Welcome to the Help Menu for Adding an Invoice for an Existing Customer. <br>
        This menu opened in a secondary screen, so please feel free to toggle between the application and this help page as needed</p>

        <p class="lead">
          There is a search bar listed at the top of this page. The input for this search is based on customer email as it is a special characteristic of a customer that may existing within the database. 
          Please utilize an email in the @domain.com format to search for an existing customer within the database. <br></p>
       <p> If the customer exists within the database, the customer data will prepopulate within the customer and address fields leaving 6 remaining data fields to be filled out <br>
      If a customer is not found, you can delete the customer email and search for another without having to refresh the page</p>

     There are 6 data fields listed on the Add Invoice for an Existing customer page that require specific inputs in order to successfully submit a new invoice for an existing customer into your database.<br>
     <br><lg>&diamond;Start Date: The start date is a required field as indicated by the asterisk. Select the start date of the job from the populated calendar
      <br><lg>&diamond;End Date: The start date is a required field as indicated by the asterisk. Select the end date of the job from the populated calendar
      <br><lg>&diamond;Supplies Cost: The supplies cost is a required field as indicated by the asterisk. Please enter the total supplies cost
      <br><lg>&diamond;Invoice Total: The invoice total is a required field as indicated by the asterisk. Please enter the total quoted invoice price
      <br><lg>&diamond;Job Status: The job status is a required field as indicated by the asterisk. Please enter the job status
      <br><lg>&diamond;Job Description: Adding a job description is not a requirement<br></br>


      <p class="lead">
     Once the required information has been entered, please select the green button for "Add Invoice"
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
