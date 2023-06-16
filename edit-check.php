<?php

include('config/db.php');

if (isset($_POST['editContact'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_POST['id_to_edit']);
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);

    $query = "UPDATE `contacts` SET `name`='$name', `phone`='$phone', `email`='$email' WHERE `id`='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<script type="text/javascript">alert("Contact successfully updated!");</script>';
        echo '<script type="text/javascript">window.location.replace("index.php");</script>';
    } else {
        echo '<script type="text/javascript">alert("Sorry, some error occured. Please try again!");</script>';
        echo '<script type="text/javascript">window.location.replace("index.php");</script>';
    }
}
?>