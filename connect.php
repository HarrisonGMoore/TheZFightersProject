<!-- This creates the connection string used by the website to connect to the database -->
<?php
$servername = "aainca2gn1o572.cu7wdqr6hy40.us-east-2.rds.amazonaws.com";
$username = "MATT0568";
$password = "Puggl3s1";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->select_db("tailoredrecipes");
?>
