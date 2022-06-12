<?php

$server     = "localhost";
$username   = "root";
$password   = "";
$db         = "floorguy_database";

// create a connection
$connection = mysqli_connect( $server, $username, $password, $db );

// check connection
if( !$connection ) {
    die( "Connection failed: " . mysqli_connect_error() );
}



?>
