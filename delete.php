<?php
define("TITLE", "Delect Customer | Mike The Floor Guy");
function deleteRecord() {

    $server = 'localhost';
    $username = 'root';
    $password = '';
    $databasename = 'floorguy_database';

    //creating a connection to the database

    $connection = mysqli_connect($server, $username, $password, $databasename);

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

    //Redirecting user back to main page index.php
    header( 'location: index.php' );

    }

    if(isset($_POST['delete-button'])) {
        deleteRecord();

    }
?>