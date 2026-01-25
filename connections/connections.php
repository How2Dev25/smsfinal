<?php
try {
   $host = 'localhost';
    $root = 'root';
    $password = '';
    $database = 'sms';

    // Create connection
    $connections = mysqli_connect($host, $root, $password, $database);

    // Check connection
    if (mysqli_connect_errno()) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>