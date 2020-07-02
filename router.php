<?php
session_start();
require_once 'AdminsController.php';
require_once 'EmployeesController.php';
require_once 'StoresController.php';
require_once 'TeamsController.php';
require_once 'RoomsController.php';
// require_once 'Employees.php';
// EmployeesService::getEmployeeManagerAncestors(14);
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
switch ($request) {
    case '/':
        require_once __DIR__ . '/login.php';
        break;}
// simplest routing
if ($method == 'POST') {
    if ($_POST['section'] == "roomsboard") {
        TeamsController::selectLists();

    }
    if ($_POST['section'] == "teamsboard") {
        TeamsController::selectLists1();
    }
    if ($_POST['section'] == "employeesboard") {
        EmployeesController::selectLists();
    }
    if ($_POST['section'] == "storesboard") {
        StoresController::selectLists();
    }
    if ($_POST['section'] == "login") {
        $admin = new Admins($_POST['uname'], $_POST['psw']);
        AdminsController::check($admin);
    }
    if ($_POST['section'] == "logout") {
        session_start();
        session_unset();
        session_destroy();
        header('Location: login.php');
    }
    if ($_POST['section'] == "employee") {
        header('Location: employeesboard.php');
    }
    if ($_POST['section'] == "addemployee") {
        $name = check_input($_POST['name']);
        $last_name = check_input($_POST['lastname']);
        $manager_id = check_input($_POST['managerid']);
        $email = check_input($_POST['email']);
        if ($manager_id) {
            $employee = new Employees(null, $name, $last_name, $manager_id, $email);} else {
            $employee = new Employees(null, $name, $last_name, null, $email);
        }

        EmployeesController::createEmployee($employee);
    }
    if ($_POST['section'] == "updateemployee") {
        $name = check_input($_POST['name']);
        $id = check_input($_POST['id']);
        $last_name = check_input($_POST['lastname']);
        $manager_id = check_input($_POST['managerid']);
        $email = check_input($_POST['email']);
        if ($manager_id) {
            $employee = new Employees($id, $name, $last_name, $manager_id, $email);} else {
            $employee = new Employees($id, $name, $last_name, null, $email);
        }

        EmployeesController::updateEmployee($employee);
    }
    if ($_POST['section'] == "deleteemployee") {
        $id = $_POST['id'];
        $employee = new Employees($id, null, null, null, null);
        EmployeesController::deleteEmployee($employee);

    }
    if ($_POST['section'] == "listemployee") {
        EmployeesController::listEmployee();

    }
    if ($_POST['section'] == "searchemployee") {
        EmployeesController::getEmployee($_POST['id']);

    }
    if ($_POST['section'] == "addstore") {
        $name = check_input($_POST['name']);
        $type = check_input($_POST['type']);
        $manager_id = check_input($_POST['managerid']);
        if ($manager_id) {
            $store = new Stores(null, $name, $type, $manager_id);} else {
            $store = new Stores(null, $name, $type, null);
        }
        StoresController::createStore($store);

    }
    if ($_POST['section'] == "updatestore") {
        $id = check_input($_POST['id']);
        $name = check_input($_POST['name']);
        $type = check_input($_POST['type']);
        $manager_id = check_input($_POST['managerid']);
        if ($manager_id) {
            $store = new Stores($id, $name, $type, $manager_id);} else {
            $store = new Stores($id, $name, $type, null);
        }
        StoresController::updateStore($store);

    }

    if ($_POST['section'] == "deletestore") {
        $id = $_POST['id'];
        $store = new Stores($id, null, null, null);
        StoresController::deleteStore($store);

    }
    if ($_POST['section'] == "searchstore") {
        StoresController::getStore($_POST['id']);

    }
    if ($_POST['section'] == "liststore") {
        StoresController::listStore();

    }
    if ($_POST['section'] == "addteam") {
        $name = check_input($_POST['name']);
        $type = check_input($_POST['type']);
        $team = new Teams(null, $name, $type);
        TeamsController::createTeam($team);
    }
    if ($_POST['section'] == "updateteam") {
        $id = check_input($_POST['id']);
        $name = check_input($_POST['name']);
        $type = check_input($_POST['type']);
        $team = new Teams($id, $name, $type);
        TeamsController::updateTeam($team);

    }

    if ($_POST['section'] == "deleteteam") {
        $id = $_POST['id'];
        $team = new Teams($id, null, null);
        TeamsController::deleteTeam($team);

    }
    if ($_POST['section'] == "searchteam") {
        TeamsController::getTeam($_POST['id']);

    }
    if ($_POST['section'] == "listteam") {
        TeamsController::listTeam();
    }
    if ($_POST['section'] == "insertemployee") {
        $teamid = check_input($_POST['id']);
        $employeeid = check_input($_POST['employeeid']);
        $team = new Employee_Team($employeeid, $teamid);
        TeamsController::insertEmployee($team);
    }
    if ($_POST['section'] == "insertadmin") {
        $teamid = check_input($_POST['id']);
        $employeeid = check_input($_POST['adminid']);
        $team = new Team_Admin($employeeid, $teamid);
        TeamsController::insertAdmin($team);
    }
    if ($_POST['section'] == "searchadmin") {
        TeamsController::getAdmin($_POST['id']);

    }
    if ($_POST['section'] == "addroom") {
        $room_number = check_input($_POST['roomnumber']);
        $room = new Rooms($room_number, null);
        RoomsController::createRoom($room);
    }
    if ($_POST['section'] == "updateroom") {
        $room_number = check_input($_POST['roomnumber']);
        $store_id = check_input($_POST['storeid']);
        $room = new Rooms($room_number, $store_id);
        RoomsController::updateRoom($room);

    }
    if ($_POST['section'] == "deleteroom") {
        $id = $_POST['roomnumber'];
        $room = new Rooms($id, null);
        RoomsController::deleteRoom($room);

    }
    if ($_POST['section'] == "listroom") {
        RoomsController::listRoom();
    }

    if ($_POST['section'] == "addroomteam") {
        $room_number = check_input($_POST['roomnumber']);
        $team_id = check_input($_POST['teamid']);
        $room = new Teams_Rooms($room_number, $team_id);
        RoomsController::addRoomTeam($room);
    }
    if ($_POST['section'] == "deleteteamroom") {
        $room_number = check_input($_POST['roomnumber']);
        $team_id = check_input($_POST['teamid']);
        $room = new Teams_Rooms($room_number, $team_id);
        RoomsController::deleteRoomTeam($room);
    }

    if ($_POST['section'] == "getemployeesteam") {
        $teamid = $_POST['id'];
        TeamsController::getAllTeamEmployees($teamid);
    }
    if ($_POST['section'] == "editemployee") {
        $_SESSION['name'] = check_input($_POST['name']);
        $_SESSION['id'] = check_input($_POST['id']);
        $_SESSION['lastname'] = check_input($_POST['lastname']);
        $_SESSION['managerid'] = check_input($_POST['managerid']);
        $_SESSION['email'] = check_input($_POST['email']);

        header('Location: editemployee.php');
    }
    if ($_POST['section'] == "editstore") {
        $_SESSION['name'] = check_input($_POST['name']);
        $_SESSION['id'] = check_input($_POST['id']);
        $_SESSION['type'] = check_input($_POST['type']);
        $_SESSION['managerid'] = check_input($_POST['managerid']);

        header('Location: editstore.php');
    }

    if ($_POST['section'] == "editteam") {
        $_SESSION['name'] = check_input($_POST['name']);
        $_SESSION['id'] = check_input($_POST['id']);
        $_SESSION['type'] = check_input($_POST['type']);

        header('Location: editteam.php');
    }
}
