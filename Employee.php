<?php
class Employee {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function addEmployee($first_name, $last_name, $department, $email) {
        $query = "INSERT INTO Employees (First_Name, Last_Name, Department, Email) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $first_name, $last_name, $department, $email);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    
    public function updateEmployee($employee_id, $first_name, $last_name, $department, $email) {
        $query = "UPDATE Employees SET First_Name = ?, Last_Name = ?, Department = ?, Email = ? WHERE Employee_ID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssssi", $first_name, $last_name, $department, $email, $employee_id);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false;
        }
    }
}
?>