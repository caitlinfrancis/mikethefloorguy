<?php
define("TITLE", "Delete Customer | Mike The Floor Guy");
function deleteRecord() {

    include('includes/connection.php');
    include('includes/functions.php');
    include('includes/errorreporting.php');

    //check if connection was succesful or not
    if(!$connection) {
    die ('Connection unsuccesful :'.mysqli_connect_error());
    }

    //storing the input
    $cId = $_POST['delete-customer_id'];

    //set/define Update query
    $sql = "DELETE FROM customer WHERE customer_id='$cId'";

    //execute query
    $deleteQuery = mysqli_query($connection, $sql);

    if(!$deleteQuery){
        echo 'Error :'.mysqli_error($connection);
    }

    //Close Connection
    mysqli_close($connection);

    //Redirecting user back to page
    header( 'location: customer.php' );

    }

    if(isset($_POST['delete-button'])) {
        deleteRecord();

    }
?>