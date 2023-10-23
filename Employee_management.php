<?php

require_once 'DB_config.php';
require_once 'Employee.php';


$db_config = new DB_config();
$db = $db_config->connect();


$employee = new Employee($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_employee'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $department = $_POST['department'];
        $email = $_POST['email'];

        
        if ($employee->addEmployee($first_name, $last_name, $department, $email)) {
            
            echo "Employee added successfully!";
        } else {
           
            echo "Failed to add employee.";
        }
    } elseif (isset($_POST['update_employee'])) {
        $employee_id = $_POST['employee_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $department = $_POST['department'];
        $email = $_POST['email'];

        
        if ($employee->updateEmployee($employee_id, $first_name, $last_name, $department, $email)) {
           
            echo "Employee information updated successfully!";
        } else {
            
            echo "Failed to update employee information.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/employee.css">
    <title>Employee Management</title>
</head>
<body>
    <div>
    <h1 class="title">Employee Management</h1>
    
    
    <h2>Add Employee</h2>
    <form method="post">
        <input type="text" name="first_name" placeholder="First Name" required><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br>
        <input type="text" name="department" placeholder="Department" required><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <button type="submit" name="add_employee">Add Employee</button>
    </form>

  
    <h2>Update Employee Information</h2>
    <form method="post">
        <input type="text" name="employee_id" placeholder="Employee ID" required><br>
        <input type="text" name="first_name" placeholder="First Name" required><br>
        <input type="text" name="last_name" placeholder="Last Name" required><br>
        <input type="text" name="department" placeholder="Department" required><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <button type="submit" name="update_employee">Update Employee</button>
    </form>
    </div>
</body>
</html>
