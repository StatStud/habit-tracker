var current_date = new Date();

setInterval(function() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var habits = JSON.parse(this.responseText);
			for (var i = 0; i < habits.length; i++) {
				var habit = habits[i];
				if (habit.status == "pending") {
					if (current_date.getDate() > habit.last_completion) {
						var checkbox = document.getElementById("checkbox-" + habit.id);
						checkbox.checked = false;
						updateStatus(checkbox, habit.id);
					}
				}
				if (habit.status == "completed") {
					if (current_date.getDate() > habit.last_completion) {
						var checkbox = document.getElementById("checkbox-" + habit.id);
						checkbox.checked = false;
						updateStatus(checkbox, habit.id);
					}
				}
			}
		}
	};
	xhttp.open("GET", "get_habits.php", true);
	xhttp.send();
}, 1000);

function updateStatus(checkbox, id) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (checkbox.checked) {
				checkbox.parentElement.style.backgroundColor = "green";
				moveHabit(checkbox.parentElement, "completed-habits");
			} else {
				checkbox.parentElement.style.backgroundColor = "red";
				moveHabit(checkbox.parentElement, "pending-habits");
			}
			generateHabits();
		}
	};
	xhttp.open("POST", "update_status.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	if (checkbox.checked) {
		xhttp.send("id=" + id + "&status=completed&last_completion=" + current_date.getDate());
	} else {
		xhttp.send("id=" + id + "&status=pending");
	}
}

function moveHabit(habit, subheading_id) {
	document.getElementById(subheading_id).appendChild(habit);
}

function generateHabits() {
	var habit_list = document.getElementById("habit-list");
	habit_list.innerHTML = ""; // clear the habit list
	
	var pending_habits_div = document.createElement("div");
	pending_habits_div.id = "pending-habits";
	var completed_habits_div = document.createElement("div");
	completed_habits_div.id = "completed-habits";
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var habits = JSON.parse(this.responseText);
			for (var i = 0; i < habits.length; i++) {
				var habit = habits[i];
				var habit_div = document.createElement("div");
				habit_div.id = "habit-" + habit.id;
				habit_div.classList.add("habit");
				var checkbox = document.createElement("input");
				checkbox.type = "checkbox";
				checkbox.id = "checkbox-" + habit.id;
				checkbox.addEventListener("change", function() {
					updateStatus(this, habit.id);
				});
				if (habit.status == "completed") {
					checkbox.checked = true;
					habit_div.style.backgroundColor = "green";
					completed_habits_div.appendChild(habit_div);
				} else {
					habit_div.style.backgroundColor = "red";
					pending_habits_div.appendChild(habit_div);
				}
				var habit_name_span = document.createElement("span");
				habit_name_span.classList.add("habit-name");
				habit_name_span.innerHTML = habit.name;
				habit_div.appendChild(checkbox);
				habit_div.appendChild(habit_name_span);
				
				var info_button = document.createElement("button");
				info_button.innerHTML = "Info";
				info_button.addEventListener("click", function() {
					displayInfo(habit.id);
				});
				habit_div.appendChild(info_button);
			}
			habit_list.appendChild(pending_habits_div);
			habit_list.appendChild(completed_habits_div);
		}
	};
	xhttp.open("GET", "get_habits.php", true);
	xhttp.send();
}

function displayInfo(id) {
	var habit_div = document.getElementById("habit-" + id);
	if (habit_div.children.length == 3) {
		// info not currently displayed, so display it
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var habit = JSON.parse(this.responseText);
				var streak_p = document.createElement("p");
				streak_p.innerHTML = "Streak: " + habit.streak;
				habit_div.appendChild(streak_p);
				
				var delete_button = document.createElement("button");
				delete_button.innerHTML = "Delete";
				delete_button.addEventListener("click", function() {
					deleteHabit(id);
				});
				habit_div.appendChild(delete_button);
			}
		};
		xhttp.open("GET", "get_streak.php?id=" + id, true);
		xhttp.send();
	} else {
		// info currently displayed, so remove it
		habit_div.removeChild(habit_div.lastChild);
		habit_div.removeChild(habit_div.lastChild);
	}
}

function deleteHabit(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			generateHabits();
		}
	};
}