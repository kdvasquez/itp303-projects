<?php
// Check to see if any required fields are missing.
if (
    !isset($_POST['dvd_title_id']) || trim($_POST['dvd_title_id']) == '' ||
    !isset($_POST['title']) || trim($_POST['title']) == ''
) {
    // One or more of the required fields is empty.
    $error = "Please fill out all required fields.";
} else {
    // All required fields provided. Continue with the EDIT workflow.
    $host = "303.itpwebdev.com";
    $user = "kdvasque_db_user";
    $pass = "ITP303SPRING!";
    $db = "kdvasque_dvd_db";

    // DB Connection.
    $mysqli = new mysqli($host, $user, $pass, $db);
    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }
    $mysqli->set_charset('utf8');

    $dvd_title_id = $_POST['dvd_title_id'];

	// $title = $_POST['title'];
    if (!isset($_POST['award']) || trim($_POST['award']) == '') {
        $award = 'NULL';
    } else {
        $award = $_POST['award'];
    }   

    if (!isset($_POST['label']) || trim($_POST['label']) == '') {
        $label = 'NULL';
    } else {
        $label = $_POST['label'];
    }

    if (!isset($_POST['sound']) || trim($_POST['sound']) == '') {
        $sound = 'NULL';
    } else {
        $sound = $_POST['sound'];
    }

    if (!isset($_POST['genre']) || trim($_POST['genre']) == '') {
        $genre = 'NULL';
    } else {
        $genre = $_POST['genre'];
    }

    if (!isset($_POST['rating']) || trim($_POST['rating']) == '') {
        $rating = 'NULL';
    } else {
        $rating = $_POST['rating'];
    }

    if (!isset($_POST['format']) || trim($_POST['format']) == '') {
        $format = 'NULL';
    } else {
        $format = $_POST['format'];
    }

    // Update DVD record in the database
    if (!isset($_POST['release_date']) || trim($_POST['release_date']) == '') {
        $release_date = "NULL";
    } else {
        // Stackoverflow
        $date = $_POST['release_date']; // input date in '%m-%d-%y' format
        $new_date = date('Y-m-d', strtotime($date)); // convert to '%Y-%m-%d' format
        $release_date = "'$new_date'";
    }

    $title = $_POST['title']; // Get DVD ID from POST data
	// $dvd_title_id = $_GET['dvd_title_id'];


    $sql = "UPDATE dvd_titles
            SET 
            title = '$title',
            release_date = $release_date,
            label_id = $label,
            sound_id = $sound,
            genre_id = $genre,
            rating_id = $rating,
            format_id = $format,
            award = '$award' 
            WHERE dvd_title_id = $dvd_title_id";

    $results = $mysqli->query($sql);

    if (!$results) {
        echo $mysqli->error;
        $mysqli->close();
        exit();
    }

    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="main.php">Home</a></li>
        <li class="breadcrumb-item"><a href="edit_form.php?dvd_title_id=<?php echo $dvd_title_id; ?>">Edit</a></li>
        <!-- <li class="breadcrumb-item"><a href="details.php?dvd_title_id=<?php echo $dvd_title_id; ?>">Details</a></li> -->
		<li class="breadcrumb-item"><a href="details.php?dvd_title_id=<?php echo $dvd_title_id; ?>">Details</a></li>

        <li class="breadcrumb-item active">Confirmation</li>
    </ol>
    <div class="container">
        <div class="row">
            <h1 class="col-12 mt-4">Edit Confirmation</h1>
        </div> <!-- .row -->
    </div> <!-- .container -->
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <?php if (isset($error) && trim($error) != '') : ?>
                    <div class="text-danger">
                        <?php echo $error; ?>
                    </div>
                <?php else : ?>
                    <div class="text-success">
                        <span class="font-italic"><?php echo $title; ?></span> was successfully updated.
                    </div>
                <?php endif; ?>
            </div> <!-- .col -->
        </div> <!-- .row -->
        <div class="row mt-4 mb-4">
            <div class="col-12">
				<!-- <form action="edit_form.php" method="GET">
				<input type="hidden" name="dvd_title_id" value="<?php echo $GET['dvd_title_id']; ?>">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form> -->
				<a href="edit_form.php?dvd_title_id=<?php echo $_POST['dvd_title_id']; ?>" role="button" class="btn btn-primary">Edit</a>
				<a href="details.php?dvd_title_id=<?php echo $_POST['dvd_title_id']; ?>" role="button" class="btn btn-primary">Go to Detail Page</a>

            </div> <!-- .col -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</body>
</html>
