<!DOCTYPE html>
<html>
<head>
	<title>Habit Tracker</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="header">
		<h1>My Habits <h1>
		<h2 id="date-time"></h2>
		<script>
			var d = new Date();
			var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
			var day = days[d.getDay()];
			var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			var month = months[d.getMonth()];
			var date = d.getDate();
			var year = d.getFullYear();
			document.getElementById("date-time").innerHTML = day + ", " + month + " " + date + ", " + year + " " + d.toLocaleTimeString();
		</script>
	<div id="habit-list">
		<?php
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$dbname = "habits";
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			$query = "SELECT * FROM habits WHERE status='pending'";
			$result = mysqli_query($conn, $query);
			echo "<h2>Pending Habits</h2>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<div class='habit' id='habit-" . $row['id'] . "'>";
				echo "<input type='checkbox' onchange='updateStatus(this, " . $row['id'] . ")'>";
				echo "<span class='habit-name'>" . $row['name'] . "</span>";
				echo "<button onclick='displayInfo(" . $row['id'] . ")'>Info</button>";
				echo "</div>";
			}
			$query = "SELECT * FROM habits WHERE status='completed'";
			$result = mysqli_query($conn, $query);
			echo "<h2>Completed Habits</h2>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<div class='habit' id='habit-" . $row['id'] . "'>";
				echo "<input type='checkbox' checked onchange='updateStatus(this, " . $row['id'] . ")'>";
				echo "<span class='habit-name'>" . $row['name'] . "</span>";
				echo "<button onclick='displayInfo(" . $row['id'] . ")'>Info</button>";
				echo "</div>";
				}
				mysqli_close($conn);
		?>
		</div>
		<button id="add-habit-button" onclick="displayForm()">Add Habit</button>
		
		<form id="add-habit-form" action="add_habit.php" method="post">
			<input type="text" name="name" placeholder="Habit name">
			<input type="submit" value="Add Habit">
		</form>

		<div id="info-div"></div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="script.js"></script>
		<script>
		updateDateTime();
		updateStatus();
		</script>
		</body>
		</html>