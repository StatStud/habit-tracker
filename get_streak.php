<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "habits";
	$id = $_POST['id'];
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	$query = "SELECT * FROM habits WHERE id='$id'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$streak = $row['streak'];
	$habit_name = $row['name'];
	$last_completion = $row['last_completion'];
	if ($last_completion == NULL) {
		echo "Habit: " . $habit_name;
		echo "\n";
		echo "Streak: 1 (first completion)";
	} else {
		echo "Habit: " . $habit_name;
		echo "\n";
		echo "Streak: " . $streak;
	}
	mysqli_close($conn);
?>