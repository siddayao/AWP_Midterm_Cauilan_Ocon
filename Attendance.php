<?php
class Attendance {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function logAttendance($employee_id, $date, $time_in_am, $time_out_am, $time_in_pm, $time_out_pm) {
        // Check if the attendance record already exists for the given employee and date
        $query = "SELECT Attendance_ID FROM Attendance WHERE Employee_ID = ? AND Date = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("is", $employee_id, $date);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Update the existing record
            $query = "UPDATE Attendance SET Time_In_AM = ?, Time_Out_AM = ?, Time_In_PM = ?, Time_Out_PM = ?, Total_Hours = ? WHERE Employee_ID = ? AND Date = ?";
            $stmt = $this->db->prepare($query);
    
            // Calculate total hours based on time-in and time-out records
            $total_hours = $this->calculateTotalHours($time_in_am, $time_out_am, $time_in_pm, $time_out_pm);
    
            $stmt->bind_param("ssssdis", $time_in_am, $time_out_am, $time_in_pm, $time_out_pm, $total_hours, $employee_id, $date);
        } else {
            // Insert a new record
            $query = "INSERT INTO Attendance (Employee_ID, Date, Time_In_AM, Time_Out_AM, Time_In_PM, Time_Out_PM, Total_Hours) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
    
            // Calculate total hours based on time-in and time-out records
            $total_hours = $this->calculateTotalHours($time_in_am, $time_out_am, $time_in_pm, $time_out_pm);
    
            $stmt->bind_param("dssssds", $employee_id, $date, $time_in_am, $time_out_am, $time_in_pm, $time_out_pm, $total_hours);
        }
    
        if ($stmt->execute()) {
            return true; // Attendance logged successfully
        } else {
            return false; // Failed to log attendance
        }
    }
    

    public function getAttendanceLogs($employee_id) {
        $query = "SELECT Date, Time_In_AM, Time_Out_AM, Time_In_PM, Time_Out_PM, Total_Hours FROM Attendance WHERE Employee_ID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $attendance_logs = array();
        while ($row = $result->fetch_assoc()) {
            $attendance_logs[] = $row;
        }

        return $attendance_logs;
    }

    private function calculateTotalHours($time_in_am, $time_out_am, $time_in_pm, $time_out_pm) {
        
       
    }
}



?>