<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "habits";

	$name = $_POST['habit-name'];
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	$query = "INSERT INTO habits (name, status, streak) VALUES ('$name', 'pending', '0')";
	mysqli_query($conn, $query);
	mysqli_close($conn);
	header("Location: index.php");
	exit();
?>