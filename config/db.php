<?php

$host = 'localhost';
$username = "root";
$password = "";
$database = "phonebook";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    echo "Error: " . mysqli_error($conn);
}

?>