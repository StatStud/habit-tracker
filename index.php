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
			//document.getElementById("date-time").innerHTML = Date();
			var d = new Date();
			var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
			var day = days[d.getDay()];
			var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			var month = months[d.getMonth()];
			var date = d.getDate();
			var year = d.getFullYear();
			document.getElementById("date-time").innerHTML = day + ", " + month + " " + date + ", " + year + " " + d.toLocaleTimeString();

			//use military time format
			// var hours = d.getHours();
			// var minutes = d.getMinutes();
			// if (minutes < 10) {
			// 	minutes = "0" + minutes;
			// }
			// document.getElementById("date-time").innerHTML = month + "/" + day + "/" + year + " " + hours + ":" + minutes;
		</script>
	</div>
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
				echo "<div class='habit'>";
				echo "<input type='checkbox' onchange='updateStatus(this, " . $row['id'] . ")'>";
				echo "<span class='habit-name'>" . $row['name'] . "</span>";
				echo "<button onclick='displayInfo(" . $row['id'] . ")'>Info</button>";
				echo "</div>";
			}
			$query = "SELECT * FROM habits WHERE status='completed'";
			$result = mysqli_query($conn, $query);
			echo "<h2>Completed Habits</h2>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<div class='habit'>";
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
		<input type="text" name="habit-name" placeholder="Habit Name">
		<input type="submit" value="Add Habit">
	</form>
	<div id="habit-info">
		<p id="streak"></p>
		<button id="delete-button" onclick="deleteHabit()">Delete Habit</button>
	</div>
	<script>
		function updateStatus(checkbox, id) {
			if (checkbox.checked) {
				var status = "completed";
			} else {
                var status = "pending";
			}
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				location.reload();
				}
				};
			xhttp.open("POST", "update_status.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("id=" + id + "&status=" + status);
			}


		function displayInfo(id) {
			var habitInfo = document.getElementById("habit-info");
			if (habitInfo.style.display === "block") {
				habitInfo.style.display = "none";
			} else {
				habitInfo.style.display = "block";
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("streak").innerHTML = "Streak: " + this.responseText;
					}
				};
				xhttp.open("POST", "get_streak.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("id=" + id);
				document.getElementById("delete-button").setAttribute("onclick", "deleteHabit(" + id + ")");
			}
		}

		function deleteHabit(id) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					location.reload();
				}
			};
			xhttp.open("POST", "delete_habit.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("id=" + id);
		}

		function displayForm() {
			document.getElementById("add-habit-form").style.display = "block";
			document.getElementById("add-habit-button").style.display = "none";
		}
</script>
</body>
</html>