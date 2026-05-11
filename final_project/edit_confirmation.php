<?php
	// Check to see if any required fields are missing.

	var_dump($_POST);

	if ( !isset($_POST['pet_name']) || trim($_POST['pet_name']) == ''
		|| !isset($_POST['breed_id']) || trim($_POST['breed_id']) == ''
		|| !isset($_POST['gender_id']) || trim($_POST['gender_id']) == ''
		|| !isset($_POST['age']) || trim($_POST['age']) == ''
		|| !isset($_POST['type_id']) || trim($_POST['type_id']) == '') {
		// One or more of the required fields is empty.
		$error = "Please fill out all required fields.";
	} else {
		// All required fields provided. Continue with the EDIT workflow.

		$host = "303.itpwebdev.com";
		$user = "kdvasque_db_user";
        $pass = "ITP303SPRING!";
        $db = "kdvasque_pets_db";

		// DB Connection.
		$mysqli = new mysqli($host, $user, $pass, $db);
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset('utf8');

		$pet_name = $_POST['pet_name'];
		$breed_id = $_POST['breed_id'];
		$gender_id = $_POST['gender_id'];
		// $age = $_POST['age'];
		$type_id = $_POST['type_id'];

		$age = 1 OR null
		if ( isset($_POST['age']) && trim($_POST['age']) != '' ) {
			$age = $_POST['age'];
		} else {
			$age = "null";
		}

		// if ( isset($_POST['album_id']) && trim($_POST['album_id']) != '' ) {
		// 	$album_id = $_POST['album_id'];
		// } else {
		// 	$album_id = "null";
		// }

		// $composer = 'user input' OR null
		// if ( isset($_POST['composer']) && trim($_POST['composer']) != '' ) {
		// 	// $composer = 'USER INPUT'
		// 	$composer = "'". $_POST['composer'] . "'";
		// } else {
		// 	$composer = "null";
		// }

		$pet_id = $_POST['pet_id'];

		#TODO
		$sql = "UPDATE pets
				SET name = '$pet_name',
					breed_id = $breed_id,
					gender_id = $gender_id,
					age = $age,
					type_id = $type_id
				WHERE pet_id = $pet_id;";

		echo "<hr>$sql<hr>";

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
	<title>Edit Confirmation | Pets Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<!-- <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href="edit_form.php">Edit</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol> -->
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Edit Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php if ( isset($error) && trim($error) != '' ) : ?>

					<div class="text-danger">
						<?php echo $error; ?>
					</div>

				<?php else: ?>

					<div class="text-success">
						<span class="font-italic"><?php echo $pet_name; ?></span> was successfully edited.
					</div>

				<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="shop.php" role="button" class="btn btn-primary">Go to Shop</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>