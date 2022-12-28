<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "habits";
	$id = $_POST['id'];
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	$query = "SELECT streak FROM habits WHERE id='$id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	echo $row['streak'];
	mysqli_close($conn);
?>