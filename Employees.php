<?php
require_once 'models.php';
require_once 'config.php';
class EmployeesService
{

    public static function createEmployee($employee)
    {
        //check if the manager id exists in employees ids, otherwise return a message
        //checking for email duplicates
        //returning the last added record to show it in the page
        $emails = EmployeesService::getEmployeeEmails();
        if (!filter_var($employee->email, FILTER_VALIDATE_EMAIL)){
            $message = "Email is not valid!";
            return $message;
        }
        if ($employee->manager_id) {
            $ids = EmployeesService::getEmployeeIds();
            if (in_array($employee->manager_id, $ids)) {

            } else {
                $message = "the manager must be an employee!";
                return $message;
            }}
        if (in_array($employee->email, $emails)) {
            $message = "This email already exists. Choose another one!";
            return $message;
        }
         
        global $conn;
        $query = "INSERT INTO Employees(manager_id,name,last_name, email) VALUES (?,?,?,?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('isss', $employee->manager_id, $employee->name, $employee->last_name, $employee->email);
        $stmt->execute();
        if (mysqli_affected_rows($conn)>0) {
            $lastest_id = mysqli_insert_id($conn);
            $stmt->close();
            $message = "$employee->name $employee->last_name with id: $lastest_id has been added successfully";
            return $message;
        } else {
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }}

    public static function updateEmployee($employee)
    {

        if ($employee->id) {
            $ids = EmployeesService::getEmployeeIds();
            if (in_array($employee->id, $ids)) {

            } else {
                $message = "This employee doesn't exist!";
                return $message;
            }}
        if ($employee->id===$employee->manager_id){
            $message = "An employee cannot be a manager of him/her self!";
                return $message;
        }
        if ($employee->manager_id) {
            $ids = EmployeesService::getEmployeeIds();
            if (in_array($employee->manager_id, $ids)) {

            } else {
                $message = "the manager must be an employee!";
                return $message;
            }
            $managerAncestorIds = EmployeesService::getEmployeeManagerAncestors($employee->manager_id);
            if(in_array($employee->id, $managerAncestorIds)){
                $message = "Loops are not allowed!";
                return $message;
            }
        }
        if ($employee->email){
        $emails = EmployeesService::getEmployeeEmails();
        if (in_array($employee->email, $emails)) {
            $message = "This email already exists. Choose another one!";
            return $message;
        }}
        global $conn;
        if ($employee->email){
        $query = "UPDATE Employees SET name=?, last_name=?, manager_id=?, email=? where id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssisi', $employee->name, $employee->last_name, $employee->manager_id, $employee->email, $employee->id);}
        else{
        $query = "UPDATE Employees SET name=?, last_name=?, manager_id=? where id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssii', $employee->name, $employee->last_name, $employee->manager_id, $employee->id);
        }
        $stmt->execute();
        if(mysqli_affected_rows($conn)>0){
            
            $stmt->close();
            $message = "Updated successfully";
            return $message;
        }
        else{
            $stmt->close();
            $message = "Something went wrong, try again!";
            return $message;
        }
    }

    public static function deleteEmployee($employee)
    {
        $ids = EmployeesService::getEmployeeIds();
        print_r($employee);
            if (in_array($employee->id, $ids)) {

            } else {
                $message = "This employee doesn't exist!";
                return $message;
            }
        global $conn;
        $query = "DELETE FROM Employees WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $employee->id);
        $stmt->execute();
        echo $stmt->error;
        if(mysqli_affected_rows($conn)>0){
            $message = "Deleted Successfully!";
            $stmt->close();
            return $message;
        }
        else{
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }
        
    }

    public static function listEmployee()
    {
        global $conn;
        $query = "SELECT * FROM Employees";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $last_name = isset($row['last_name']) ? $row['last_name'] : 'has no last name';
                $manager_id = isset($row['manager_id']) ? $row['manager_id'] : 'has no manager';
                $email = isset($row['email']) ? $row['email'] : 'has no email';
                $employee = new Employees($id, $name, $last_name, $manager_id, $email);
                $rows[] = $employee;
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }
    public static function getEmployee($employee)
    {
        global $conn;
        $query = "SELECT * FROM Employees WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $employee->id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $name = $row['name'];
                $last_name = isset($row['last_name']) ? $row['last_name'] : 'has no last name';
                $manager_id = isset($row['manager_id']) ? $row['manager_id'] : 'has no manager';
                $email = isset($row['email']) ? $row['email'] : 'has no email';
                $employee = new Employees($id, $name, $last_name, $manager_id, $email);
                // $rows[] = $employee;
            }
        } else {
            // $rows[] = [];
            $employee = [];
        }
        $stmt->close();
        return $employee;
    }

    public static function getEmployeeIds()
    {
        global $conn;
        $query = "SELECT id FROM Employees";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ids[] = $row['id'];
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $ids;
    }
    public static function getEmployeeEmails()
    {
        global $conn;
        $query = "SELECT email FROM Employees";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emails[] = $row['email'];
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $emails;
    }

    public static function getEmployeeManagerAncestors($manager_id) {
        $rv = [];
        $employee = new Employees($manager_id);
        $emp = EmployeesService::getEmployee($employee);
        if($emp->manager_id){
        $test=1;
        while($test) {
            $employee = new Employees($manager_id);
            $emp = EmployeesService::getEmployee($employee);
            $manager_id = $emp->manager_id;
            if($manager_id){
            $rv[] = $manager_id;}
            else{
            break;
            }
        }}
        return $rv;
    }

    public static function getManagersIds()
    {
        global $conn;
        $query = "SELECT DISTINCT manager_id FROM Employees";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row['manager_id'];
            }
        } else {
            $rows[] = [];
        }
        $stmt->close();
        return $rows;
    }
}
