<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];

    $sql = "INSERT INTO donors (name, email, phone, blood_group, location)
            VALUES ('$name', '$email', '$phone', '$blood_group', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "Donor registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
