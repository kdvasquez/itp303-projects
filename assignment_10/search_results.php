<?php
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

	// Filter
	// echo "<pre>";
	// var_dump($_GET);
	// echo "</pre>";

	// Retrieve results from the DB
	$sql = "SELECT dvd_title_id, title, release_date, award, genre, rating, label, format, sound
		FROM dvd_titles
		LEFT JOIN genres
			ON genres.genre_id = dvd_titles.genre_id
		LEFT JOIN ratings
			ON ratings.rating_id = dvd_titles.rating_id
		LEFT JOIN labels
			ON labels.label_id = dvd_titles.label_id
		LEFT JOIN formats
			ON formats.format_id = dvd_titles.format_id
		LEFT JOIN sounds 
			ON sounds.sound_id = dvd_titles.sound_id
		WHERE 1=1";

	if (isset($_GET['title']) && !empty($_GET['title'])) {
		$title = $_GET['title'];
		$sql = $sql . " AND dvd_titles.title LIKE '%" . $title . "%'";
	}

	if (isset($_GET['release_date']) && !empty($_GET['release_date'])) {
		$release_date = $_GET['release_date'];
		$sql = $sql . " AND dvd_titles.release_date = '$release_date'";
	}

	if (isset($_GET['genre_id']) && !empty($_GET['genre_id'])) {
		$genre_id = $_GET['genre_id'];
		$sql = $sql . " AND dvd_titles.genre_id = $genre_id";
	}
	if (isset($_GET['rating_id']) && !empty($_GET['rating_id'])) {
		$rating_id = $_GET['rating_id'];
		$sql = $sql . " AND dvd_titles.rating_id = '$rating_id'";
	}

	$sql = $sql . ';';
	// echo $sql;

	//Run SQL
	$results = $mysqli->query($sql);

	// Check for SQL Errors 
	if (!$results) {
		echo $mysqli->error;
		$mysqli->close(); // want to close DB connection right before exiting the program
		exit();
	}
	// Close MySQL Connection 
	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->

			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th> </th>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
							
						</tr>
					</thead>
					<tbody>
					<?php while ($row = $results->fetch_assoc()) : ?>

                            <tr>
								<td>
									<a href="delete.php?title=<?php echo $row['title'] ?>"> 
										Delete
									</a>
								</td>
                                <td>
									<a href="details.php?title=<?php echo $row['title'] ?>">
										<?php echo $row['title'] ?>
									</a>
								</td>
                                <td><?php echo $row['release_date'] ?></td>
                                <td><?php echo $row['genre'] ?></td>
                                <td><?php echo $row['rating']; ?></td>
                            </tr>
                    <?php endwhile; ?>
					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>