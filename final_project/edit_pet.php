<?php
session_start();

$host = "303.itpwebdev.com";
$user = "kdvasque_db_user";
$pass = "ITP303SPRING!";
$db = "kdvasque_pets_db";

// Check connection
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Check if pet_id is provided in the URL
if (!isset($_GET['pet_id'])) {
    // Redirect to a page indicating that pet_id is required
    header("Location: error.php");
    exit;
}

// Retrieve pet details from the database based on pet_id
$pet_id = $_GET['pet_id'];
$sql = "SELECT * FROM pets WHERE pet_id = $pet_id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    // Redirect to a page indicating that pet_id is invalid
    header("Location: error.php");
    exit;
}
$pet = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Pet</h1>
        <form action="update_pet.php" method="POST">
            <input type="hidden" name="pet_id" value="<?php echo $pet['pet_id']; ?>">
            <div class="mb-3">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $pet['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="inputBreed" class="form-label">Breed</label>
                <input type="text" class="form-control" id="inputBreed" name="inputBreed" value="<?php echo $pet['breed']; ?>">
            </div>
            <div class="mb-3">
                <label for="inputGender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="inputGender" name="inputGender" value="<?php echo $pet['gender']; ?>">
            </div>
            <div class="mb-3">
                <label for="inputAge" class="form-label">Age</label>
                <input type="text" class="form-control" id="inputAge" name="inputAge" value="<?php echo $pet['age']; ?>">
            </div>
            <div class="mb-3">
                <label for="inputType" class="form-label">Type</label>
                <input type="text" class="form-control" id="inputType" name="inputType" value="<?php echo $pet['type']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="shop.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
