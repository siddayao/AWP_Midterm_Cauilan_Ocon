<?php
require_once 'DB_config.php';
require_once 'Attendance.php';

$db_config = new DB_config();
$db = $db_config->connect();

$attendance = new Attendance($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $date = $_POST['date'];
    $time_in_am = $_POST['time_in_am'];
    $time_out_am = $_POST['time_out_am'];
    $time_in_pm = $_POST['time_in_pm'];
    $time_out_pm = $_POST['time_out_pm'];

    
    if ($attendance->logAttendance($employee_id, $date, $time_in_am, $time_out_am, $time_in_pm, $time_out_pm)) {
       
        echo "Attendance logged successfully!";
    } else {
        
        echo "Failed to log attendance.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/Attendance_logging.css">
    <title>Attendance Logging</title>
</head>
<body>
    <div>
        <br>
    <h1>Employee Attendance Logging</h1>
    <br><br>
   
    <form method="post">
        <input type="text" name="employee_id" placeholder="Employee ID" required><br><br>
        <input type="date" name="date" required><br><br><br>
        <label>Morning (AM) Time-In and Time-Out:</label><br>
        <input type="time" name="time_in_am" placeholder="Time-In (AM)" required>
        <input type="time" name="time_out_am" placeholder="Time-Out (AM)" required><br><br><br>
        <label>Afternoon (PM) Time-In and Time-Out:</label><br>
        <input type="time" name="time_in_pm" placeholder="Time-In (PM)" required>
        <input type="time" name="time_out_pm" placeholder="Time-Out (PM)" required><br><br>
        <button type="submit">Log Attendance</button>
    </form>
    </div>
</body>
</html>
