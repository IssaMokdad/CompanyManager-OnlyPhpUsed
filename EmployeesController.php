<?php
session_start();
require_once "Employees.php";

class EmployeesController
{
    public static function selectLists()
    {
        $message = EmployeesService::getEmployeeIds();
        $html="";
        foreach ($message as $key) {
            $html =$html .  "<option value=" . $key. ">$key</option>";
    }
    $_SESSION['selectemployeeids'] = $html;
    header('Location: employeesboard.php');
}
    public static function createEmployee($employee)
    {
        $message = EmployeesService::createEmployee($employee);
        $_SESSION['message'] = $message;
        header('Location: employeesboard.php');
        // echo 'ahlan';
        // session_start();
        // $_SESSION['message']='ah';
        // header('Location: employeesboard.php');
    }
    public static function updateEmployee($employee)
    {
        $message = EmployeesService::updateEmployee($employee);
        $_SESSION['message'] = $message;
        $message = EmployeesService::getEmployeeIds();
        $html="";
        foreach ($message as $key) {
            $html =$html .  "<option value=" . $key. ">$key</option>";
    }
        $_SESSION['selectemployeeids'] = $html;
        header('Location: editemployee.php');
    }
    public static function deleteEmployee($employee)
    {
        $message = EmployeesService::deleteEmployee($employee);
        $_SESSION['message'] = $message;
        header('Location: employeesboard.php');
    }
    public static function getEmployee($employeeid)
    {
        $employee = new Employees($employeeid);
        $message = EmployeesService::getEmployee($employee);
        $html = "<table class='zui-table'><thead><tr><th>Employee ID</th><th>First Name</th><th>Last Name</th>
        <th>Manager ID</th><th>Email</th><th>Action</th></tr></thead><tbody>";
        if($message){$html = $html . "<tr><td>" . $message->id . "</td><td>" . $message->name . "</td><td>" . $message->last_name . "</td>
        <td>" . $message->manager_id . "</td><td>$message->email</td><td><div class='employeeservice'><form action='index.php' method='post'>
        <input class='board' type='text' name='section' value='deleteemployee' required>
        <input class='board' type='number' name='id' value='$message->id' required>
        <button type='submit'><i class='fa fa-close'></i></button></form>
        <form action='index.php' method='post'>
        <input class='board' type='number' name='id' value='$message->id'>
        <input class='board' type='text' name='name' value='$message->name'>
        <input class='board' type='text' name='lastname' value='$message->last_name'>
        <input class='board' type='number' name='managerid' value='$message->manager_id'>
        <input class='board' type='email' name='email' value='$message->email'>
        <input class='board' type='text' name='section' value='editemployee' required>
        <button type='submit'><i class='fa fa-edit'></i></button></form></div>
        </td></tr>";}
        
        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "employeesboard.php";
        header('Location: listall.php');
    }
    public static function listEmployee()
    {
        $message = EmployeesService::listEmployee();
        // $_SESSION['list']=$message;
        $html = "<table class='zui-table'><thead><tr><th>Employee ID</th><th>First Name</th><th>Last Name</th>
        <th>Manager ID</th><th>Email</th><th>Action</th></tr></thead><tbody>";
        
        if($message){foreach ($message as $message) {
                $html = $html . "<tr><td>" . $message->id . "</td><td>" . $message->name . "</td><td>" . $message->last_name . "</td>
                <td>" . $message->manager_id . "</td><td>$message->email</td><td><div class='employeeservice'><form action='index.php' method='post'>
                <input class='board' type='text' name='section' value='deleteemployee' required>
                <input class='board' type='number' name='id' value='$message->id' required>
                <button type='submit'><i class='fa fa-close'></i></button></form>
                <form action='index.php' method='post'>
                <input class='board' type='number' name='id' value='$message->id'>
                <input class='board' type='text' name='name' value='$message->name'>
                <input class='board' type='text' name='lastname' value='$message->last_name'>
                <input class='board' type='number' name='managerid' value='$message->manager_id'>
                <input class='board' type='email' name='email' value='$message->email'>
                <input class='board' type='text' name='section' value='editemployee' required>
                <button type='submit'><i class='fa fa-edit'></i></button></form></div>
                </td></tr>";
        }}
        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "employeesboard.php";
        header('Location: listall.php');
    }
}
