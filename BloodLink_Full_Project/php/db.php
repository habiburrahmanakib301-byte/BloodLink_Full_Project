<?php
$conn = new mysqli("localhost", "root", "", "bloodclub");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
