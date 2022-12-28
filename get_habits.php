<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "habits";
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

// retrieve habits data from database
$query = "SELECT * FROM habits";
$result = mysqli_query($db, $query);

// create array to store habits data
$habits = array();

// store habits data in array
while ($row = mysqli_fetch_assoc($result)) {
	$habits[] = $row;
}

// close connection to database
mysqli_close($db);

// return habits data as JSON
echo json_encode($habits);

?>
