<?php
$conn = new mysqli("localhost", "root", "", "healthcare_db"); //Database connection
if ($conn->connect_error) {
    die("Failed to connect to the server");
}