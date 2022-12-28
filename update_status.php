<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "habits";
	$id = $_POST['id'];
    $status = $_POST['status'];
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if ($status == "completed") {
		$query = "UPDATE habits SET status='completed', streak=streak+1 WHERE id='$id'";
	} else {
		$query = "UPDATE habits SET status='pending', streak=0 WHERE id='$id'";
	}
	mysqli_query($conn, $query);
	mysqli_close($conn);
?>