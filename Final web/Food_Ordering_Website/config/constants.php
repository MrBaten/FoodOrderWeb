<?php

    session_start();

    // Create constants to store non reapeating values
    define('SITEURL', 'http://localhost/Food_Ordering_Website/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    // Making Database connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME,  DB_PASSWORD);  // Database connection
    $db_select = mysqli_select_db($conn, DB_NAME); // Selecting Database

?>