<?php

include('config/db.php');

if (isset($_POST['addContact'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);

    $query = "INSERT INTO `contacts`(`name`, `phone`, `email`) VALUES('$name', '$phone', '$email')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<script type="text/javascript">alert("Contact successfully saved!");</script>';
        echo '<script type="text/javascript">window.location.replace("index.php");</script>';
    } else {
        echo '<script type="text/javascript">alert("Sorry, some error occured. Please try again!");</script>';
        echo '<script type="text/javascript">window.location.replace("index.php");</script>';
    }
}

?>