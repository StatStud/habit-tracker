<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "habits";
	$id = $_POST['id'];
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	$query = "DELETE FROM habits WHERE id='$id'";
	mysqli_query($conn, $query);
	mysqli_close($conn);
?>