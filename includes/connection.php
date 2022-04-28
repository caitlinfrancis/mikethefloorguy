<?php

$connection = mysqli_init(); mysqli_ssl_set($connection,NULL,NULL, "{path to CA cert}", NULL, NULL); mysqli_real_connect($connection, "mikethefloorguy.mysql.database.azure.com", "mikethefloorguy", "Poop!@34", "floorguy_database", 3306, MYSQLI_CLIENT_SSL);
?>
