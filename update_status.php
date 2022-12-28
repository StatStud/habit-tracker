<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "habits";
	$id = $_POST['id'];
    $status = $_POST['status'];
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if ($status == "completed") {
		// get current date and time
		$current_date = date("Y-m-d");
		// get date of last completion
		$query = "SELECT last_completion FROM habits WHERE id='$id'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$last_completion = $row['last_completion'];
		// compare current date to last completion date
		if ($current_date == $last_completion) {
			// if same date, increment streak
			$query = "UPDATE habits SET status='completed', streak=streak+1, last_completion='$current_date' WHERE id='$id'";
		} else {
			// if different date, reset streak to 1 because it is the start of a new habit
			$query = "UPDATE habits SET status='completed', streak=1, last_completion='$current_date' WHERE id='$id'";
		}
	} else {
		$query = "UPDATE habits SET status='pending', streak=0, last_completion=NULL WHERE id='$id'";
	}
	mysqli_query($conn, $query);
	mysqli_close($conn);
?>