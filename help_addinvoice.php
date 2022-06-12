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
      <p class="lead">Welcome to the Help Menu for Adding an Invoice. <br>
        This menu opened in a secondary screen, so please feel free to toggle between the application and this help page as needed</p>


     There are 15 data fields listed on the Add Invoice page that require specific inputs in order to successfully submit a full Invoice into your database.<br>
     <br><lg>&diamond;First Name: The customers first name is a required field as indicated by the asterisk. Please enter the customers first name
      <br><lg>&diamond;Last Name: The customers last name is a required field as indicated by the asterisk. Please enter the customers last name
      <br><lg>&diamond;Email: The customers email is a required field as indicated by the asterisk. Please ensure the format of the email is entered is an @domain.com format. Formatting assistance is provided
      <br> <lg>&diamond;Phone Number: The customers phone number is a required field as indicated by the asterisk. Please ensure the format of the phone number is entered in a xxx-xxx-xxxx format. Formatting assistance is provided
      <br><lg>&diamond;Street Address: The street address to include the street number and name is a requirement as indicated by the asterisk
      <br><lg>&diamond;City: The state is a required field as indicated by the asterisk. Please enter a city
      <br> <lg>&diamond;State: The state is a required field as indicated by the asterisk. Please select a state from the drop down menu
      <br> <lg>&diamond;Zip Code: The zip code is a required field as indicated by the asterisk. Please enter a zip code
      <br> <lg>&diamond;Company: Adding a company is not a requirement<
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
