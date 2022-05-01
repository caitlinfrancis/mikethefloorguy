<?php

define("TITLE", "Update Customer | Mike The Floor Guy");
function editRecord() {

    include('includes/connection.php');
    include('includes/functions.php');
    include('includes/errorreporting.php');

    $connection = mysqli_connect($server, $username, $password, $databasename);

    //check if connection was succesful or not
    if(!$connection) {
    die ('Connection unsuccesful :'.mysqli_connect_error());
    }

    //storing the input
    $cId = $_POST['edit-customer_id'];
    $cFirstName = $_POST['edit-customer_fname'];
    $cLastName = $_POST['edit-customer_lname'];
    $cEmail = $_POST['edit-customer_email'];
    $cPhoneNum = $_POST['edit-customer_phonenum;'];
    $cCompany = $_POST['edit-customer_company;'];

    //set/define Update query
    $sql = "UPDATE customer SET customer_fname='$cFirstName', customer_lname='$cLastName', customer_email='$cEmail', customer_phonenum='$cPhoneNum', customer_company='$cCompany' WHERE customer_id='$cId'";
    $editQuery = mysqli_query($connection, $sql); //executing SQL query

    //check if inserting data was successful
    if(!$editQuery){
        echo 'Error :'.$sql.mysqli_error($connection);
    }

    //Close Connection
    mysqli_close($connection);

    //Redirecting user back to main page index.php
    header( 'location: index.php' );

    }

    if(isset($_POST['edit-button'])) {
    editRecord();

    }
?>