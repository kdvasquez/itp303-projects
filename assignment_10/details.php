<?php
	if (!isset($_GET['title']) || trim($_GET['title']) == '') {
		$error = "Invalid Track ID";
	} else {
		// DB Credentials
		$host = "303.itpwebdev.com";
		$user = "kdvasque_db_user";
		$pass = "ITP303SPRING!";
		$db = "kdvasque_dvd_db";

		// Connect 
		$mysqli = new mysqli($host, $user, $pass, $db);

		// Check for MySQL Connection Errors 
		if ($mysqli->connect_errno){
			echo $mysqli->connect_error;
			exit();
		}
		$mysqli->set_charset('utf8');
		$title = $_GET['title'];
		$title = $mysqli->real_escape_string($title);


		$sql = "SELECT dvd_title_id, dvd_titles.title, dvd_titles.release_date, dvd_titles.award, labels.label, sounds.sound, genres.genre, ratings.rating, formats.format
				FROM dvd_titles
				LEFT JOIN labels
					ON dvd_titles.label_id = labels.label_id
				LEFT JOIN sounds
					ON dvd_titles.sound_id = sounds.sound_id
				LEFT JOIN genres
					ON dvd_titles.genre_id = genres.genre_id
				LEFT JOIN ratings
					ON dvd_titles.rating_id = ratings.rating_id
				LEFT JOIN formats
					ON dvd_titles.format_id = formats.format_id 
				WHERE dvd_titles.title = '$title';";


		//Run SQL
		$results = $mysqli->query($sql);

		// Check for SQL Errors 
		if (!$results) {
			echo $mysqli->error;
			$mysqli->close(); // want to close DB connection right before exiting the program
			exit();
		}
		$row = $results->fetch_assoc();
		// Close MySQL Connection 
		$mysqli->close();
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="main.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

			<?php if (isset($error) && !empty($error) ) : ?>
				<div class="text-danger font-italic">
					<?php 
						echo $error; 
					?>
				</div>

			<?php else : ?>

				<table class="table table-responsive">
					<tr>
						<th class="text-right">Edit</th>
						<td>
							<a href="edit_form.php?dvd_title_id=<?php echo $row['dvd_title_id'] ?>"> Edit</a>
						</td>

					<tr>
						<th class="text-right">Title:</th>
						<td>
							<!-- PHP Output Here -->
							<?php echo $row['title'] ?>
						</td>
					</tr>

					<tr>
						<th class="text-right">Release Date:</th>
						<td><!-- PHP Output Here -->
							<?php echo $row['release_date'] ?>
						</td>
					</tr>

					<tr>
						<th class="text-right">Genre:</th>
						<td><!-- PHP Output Here -->
						<?php echo $row['genre'] ?>
						</td>

					</tr>

					<tr>
						<th class="text-right">Label:</th>
						<td><!-- PHP Output Here -->
						<?php echo $row['label'] ?>
						</td>
					</tr>

					<tr>
						<th class="text-right">Rating:</th>
						<td><!-- PHP Output Here -->
						<?php echo $row['rating'] ?>
						</td>
					</tr>

					<tr>
						<th class="text-right">Sound:</th>
						<td><!-- PHP Output Here -->
						<?php echo $row['sound'] ?>
						</td>
					</tr>

					<tr>
						<th class="text-right">Format:</th>
						<td><!-- PHP Output Here -->
						<?php echo $row['format'] ?>
						</td>
					</tr>

					<tr>
						<th class="text-right">Award:</th>
						<td><!-- PHP Output Here -->
						<?php echo $row['award'] ?>
						</td>
					</tr>

				</table>
			<?php endif; ?>

			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>