<?php
session_start();

// Database credentials
$host = "303.itpwebdev.com";
$user = "kdvasque_db_user";
$pass = "ITP303SPRING!";
$db = "kdvasque_pets_db";

// Create Connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['pet_name'])) {

        $petName = $_POST['pet_name'];


        // Prepare SQL statement to remove pet from the database
        $sql = "DELETE FROM pets WHERE pet_name = '$petName'";

        if (mysqli_query($conn, $sql)) {
            echo "Pet removed successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Pet ID not provided";
    }
}

// Close the database connection
mysqli_close($conn);
?>
