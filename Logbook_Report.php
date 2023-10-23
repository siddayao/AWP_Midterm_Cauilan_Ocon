<?php

require_once 'DB_config.php';
require_once 'Attendance.php';


$db_config = new DB_config();
$db = $db_config->connect();


$attendance = new Attendance($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];
    $attendance_logs = $attendance->getAttendanceLogs($employee_id);
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/Logbook.css">
    <title>Attendance Log Report</title>
</head>
<body>
    <div>
    <br>
    <h1>Attendance Log Report</h1>
    
   
    <form method="post">
        <label for="employee_id">Select an Employee:</label>
        <select name="employee_id" id="employee_id">
            <!-- Populate this dropdown with a list of employees -->
        </select>
        <button type="submit" name="get_logs">Get Attendance Logs</button>
    </form>
    
    <?php if (isset($attendance_logs) && !empty($attendance_logs)) : ?>
    <h2>Attendance Logs</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time In (AM)</th>
                <th>Time Out (AM)</th>
                <th>Time In (PM)</th>
                <th>Time Out (PM)</th>
                <th>Total Hours</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendance_logs as $log) : ?>
                <tr>
                    <td><?php echo $log['Date']; ?></td>
                    <td><?php echo $log['Time_In_AM']; ?></td>
                    <td><?php echo $log['Time_Out_AM']; ?></td>
                    <td><?php echo $log['Time_In_PM']; ?></td>
                    <td><?php echo $log['Time_Out_PM']; ?></td>
                    <td><?php echo $log['Total_Hours']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    </div>
</body>
</html>
