<?php
/**
 * using mysqli_connect for database connection
 */
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = ''; // Example password
$databaseName = 'mykpi_test';

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
