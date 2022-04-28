<?php

$con = mysqli_init(); mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL); mysqli_real_connect($conn, "mikethefloorguy.mysql.database.azure.com", "mikethefloorguy", "{your_password}", "{your_database}", 3306, MYSQLI_CLIENT_SSL);
?>
