# habit-tracker

Description of code:
1. The date and time are displayed at the top center of the page in the format "Day, Month Day, Year Time".
2. The list of habits is displayed below the date and time, separated into two sections - "Pending Habits" and "Completed Habits".
3. The habits are displayed with a checkbox next to the habit name. If the habit is pending, the checkbox is empty. If the habit is completed, the checkbox is checked.
4. When the checkbox is clicked, the habit status is updated to the opposite of its current status (pending becomes completed and vice versa). The habit is also moved to the appropriate section (pending or completed).
5. When the "Info" button is clicked, the habit's streak value is displayed below the habit name. If the "Info" button is clicked again, the streak value is hidden.
6. When the "Delete" button is clicked, the habit is removed from the list and the database.
7. The "Add Habit" button is displayed at the bottom left of the page. When clicked, a form is displayed allowing the user to enter a habit name. When the form is submitted, the new habit is added to the list and the database.
8. On the beginning of a new day (midnight), all habits are reset to the "pending" status.

Write the code using html, css, javascript, AJAX, and PHP. The habits table (from which all habit information is stored) has four columns: “name”, “id”, “last_completion”, “status” and “streak”.  The main file name is called index.php. The other files are: add_habit.php, delete_habit.php, get_habits.php, update_status.php get_streaks.php, style.css, and script.js.
