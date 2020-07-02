<?php
session_start();
require_once "Teams.php";
require_once "Employees.php";
require_once "models.php";

class TeamsController
{
    public static function createTeam($team)
    {
        $message = TeamsService::createTeam($team);
        $_SESSION['message'] = $message;
        header('Location: teamsboard.php');
        // echo 'ahlan';
        // session_start();
        // $_SESSION['message']='ah';
        // header('Location: employeesboard.php');
    }
    public static function updateTeam($team)
    {
        $message = TeamsService::updateTeam($team);
        $_SESSION['message'] = $message;
        header('Location: editteam.php');
    }
    public static function deleteTeam($team)
    {
        $message = TeamsService::deleteTeam($team);
        $_SESSION['message'] = $message;
        header('Location: teamsboard.php');
    }
    public static function getTeam($teamid)
    {
        $team = new Teams($teamid);
        $message = TeamsService::getTeam($team);
        $html = "<table class='zui-table'><thead><tr><th>Team ID</th><th>Team Name</th>
        <th>Team Type</th></tr></thead><tbody>";
        $html = $html . "<tr><td>" . $message->id . "</td><td>" . $message->name . "</td><td>" . $message->type . "</td>
        <td></tr>";
        
        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "teamsboard.php";
        header('Location: listall.php');
    }
    public static function listTeam()
    {
        $message = TeamsService::listTeam();
        // $_SESSION['list']=$message;
        $html = "<table class='zui-table'><thead><tr><th>Team ID</th><th>Team Name</th>
                 <th>Type</th><th>Action</th></tr></thead><tbody>";
                 if($message){foreach ($message as $message) {
                    $html = $html . "<tr><td>" . $message->id . "</td><td>" . $message->name . "</td>
                    <td>" . $message->type . "</td><td><div class='employeeservice'><form action='index.php' method='post'>
                    <input class='board' type='text' name='section' value='deleteteam' required>
                    <input class='board' type='number' name='id' value='$message->id' required>
                    <button type='submit'><i class='fa fa-close'></i></button></form>
                    <form action='index.php' method='post'>
                    <input class='board' type='number' name='id' value='$message->id'>
                    <input class='board' type='text' name='name' value='$message->name'>
                    <input class='board' type='text' name='type' value='$message->type'>
                    <input class='board' type='text' name='section' value='editteam' required>
                    <button type='submit'><i class='fa fa-edit'></i></button></form></div>
                    </td></tr>";
            }}







        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "teamsboard.php";
        header('Location: listall.php');
    }

    public static function getAllTeamEmployees($teamid)
    {
        $team = new Employee_Team(null, $teamid);
        $message = TeamsService::getAllTeamEmployees($team);
        // $_SESSION['list']=$message;
        $html = "<table class='zui-table'><thead><tr><th>Employee ID</th><th>Employee Name</th>
                 <th>Employee Lastname</th><th>Employee email</th></tr></thead><tbody>";
        foreach ($message as $key) {
            $html = $html . "<tr><td>" . $key->id . "</td><td>" . $key->name . "</td><td>" . $key->last_name . "</td>
                   <td>" . $key->email . "</td></tr>";
        }
        $html = $html . "</tbody></table>";
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "teamsboard.php";
        header('Location: listall.php');
    }

    public static function insertEmployee($team)
    {
        $message = TeamsService::insertEmployee($team);
        $_SESSION['message'] = $message;
        header('Location: teamsboard.php');
        // echo 'ahlan';
        // session_start();
        // $_SESSION['message']='ah';
        // header('Location: employeesboard.php');
    }
    public static function insertAdmin($team)
    {
        $message = TeamsService::insertAdmin($team);
        $_SESSION['message'] = $message;
        header('Location: teamsboard.php');
        // echo 'ahlan';
        // session_start();
        // $_SESSION['message']='ah';
        // header('Location: employeesboard.php');
    }
    public static function getAdmin($teamid)
    {
        $team = new Team_Admin(null, $teamid);
        $message = TeamsService::getAdmin($team);
        $html = "<table class='zui-table'><thead><tr><th>Employee ID</th><th>First Name</th><th>Last Name</th>
        <th>Manager ID</th><th>Email</th></tr></thead><tbody>";
        if($message){
        $employee = new Employees($message);
        $message = EmployeesService::getEmployee($employee);
        $html = $html . "<tr><td>" . $message->id . "</td><td>" . $message->name . "</td><td>" . $message->last_name . "</td>
        <td>" . $message->manager_id . "</td><td>" . $message->email . "</td></tr>";
        
        $html = $html . "</tbody></table>";}
        else{

        }
        $_SESSION['list'] = $html;
        $_SESSION['url'] = "teamsboard.php";
        header('Location: listall.php');
    }

    public static function selectLists()
    {
        $message = TeamsService::listTeam();
        $message1 = RoomsService::getRooms();
        $message2 = StoresService::getStoresIds();

        $html1 = "";
        foreach ($message2 as $key) {
            $html2 =$html2 .  "<option value=" . $key. ">$key</option>";
        }
        $html1 = "<option value='' selected>Enter the room number</option>";
        foreach ($message1 as $key) {
            $html1 =$html1 .  "<option value=" . $key->room_number. ">$key->room_number</option>";
        }

        $html = "<option value='' selected>Enter the team id</option>";
        foreach ($message as $key) {
            $html =$html .  "<option value=" . $key->id. ">$key->id</option>";
        }
        $_SESSION['selectteamids'] = $html;
        $_SESSION['roomnumbers'] = $html1;
        $_SESSION['selectstoreids'] = $html2;
        header('Location: roomsboard.php');
    }

    public static function selectLists1()
    {
        $message = TeamsService::listTeam();
        $message1 = RoomsService::getRooms();
        $message2 = StoresService::getStoresIds();
        $message3 = EmployeesService::getEmployeeIds();
        $message4 =TeamsService::getAllTeamsEmployees();
        $html4="";
        foreach ($message4 as $key) {
            $html4 =$html4 .  "<option value=" . $key. ">$key</option>";}
        $html3="";
        foreach ($message3 as $key) {
            $html3 =$html3 .  "<option value=" . $key. ">$key</option>";}
        
        $html2 = "";
        foreach ($message2 as $key) {
            $html2 =$html2 .  "<option value=" . $key. ">$key</option>";
        }
        $html1 = "<option value='' selected>Enter the room number</option>";
        foreach ($message1 as $key) {
            $html1 =$html1 .  "<option value=" . $key->room_number. ">$key->room_number</option>";
        }

        $html = "<option value='' selected>Enter the team id</option>";
        foreach ($message as $key) {
            $html =$html .  "<option value=" . $key->id. ">$key->id</option>";
        }
        $_SESSION['selectteamids'] = $html;
        $_SESSION['roomnumbers'] = $html1;
        $_SESSION['selectstoreids'] = $html2;
        $_SESSION['selectemployeeids'] = $html3;
        $_SESSION['selectemployeeteamsids'] = $html4;
        header('Location: teamsboard.php');
    }
}
