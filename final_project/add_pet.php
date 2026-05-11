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

    // Retrieve form data
    $name = $_POST['inputName'];
    $breed_id = $_POST['inputBreed']; // Breed ID directly from the form
    $gender_id = $_POST['inputGender']; // Gender ID directly from the form
    $age = $_POST['inputAge'];
    $type_id = $_POST['inputType']; // Type ID directly from the form

    // Insert data into the database with the retrieved IDs
    $sql = "INSERT INTO pets (pet_name, breed_id, gender_id, age, type_id) VALUES ('$name', '$breed_id', '$gender_id', '$age', '$type_id')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

?>